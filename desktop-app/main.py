import sys
import webbrowser
import requests
import json
import time
from datetime import datetime
from PyQt5.QtWidgets import QApplication, QWidget, QVBoxLayout, QPushButton, QLabel, QMessageBox, QHBoxLayout
from PyQt5.QtGui import QPixmap
from PyQt5.QtCore import Qt, QTimer, QObject, pyqtSignal, QThread  # Import additional Qt components
from http.server import BaseHTTPRequestHandler, HTTPServer
import threading
import os
import psutil  # Add this import at the top

class ActivityWorker(QObject):
    finished = pyqtSignal()
    error = pyqtSignal(str)
    
    def __init__(self, api_url, token):
        super().__init__()
        self.api_url = api_url
        self.token = token.strip()  # Remove any whitespace
        print(f"ActivityWorker initialized with API URL: {api_url}")
        print(f"Token (first 10 chars): {self.token[:10]}...")
        self.start_time = datetime.now()
        self.total_time = 0
        self.productive_time = 0
        self.idle_time = 0
        self.applications = {}
        self.status = 'online'
        self.last_activity = datetime.now()
        self.idle_threshold = 300  # 5 minutes in seconds
        self.time_report_id = None
        
    def get_or_create_time_report(self):
        try:
            headers = {
                'Authorization': f'Bearer {self.token}',
                'Content-Type': 'application/json'
            }
            
            print("\n=== Trying to get current time report ===")
            print(f"URL: {self.api_url}/api/desktop/time-report/current")
            print("Headers:", {'Authorization': f'Bearer {self.token[:10]}...', 'Content-Type': 'application/json'})
            
            # Try to get today's time report
            response = requests.get(
                f"{self.api_url}/api/desktop/time-report/current",
                headers=headers
            )
            
            print("\n=== Response from get time report ===")
            print(f"Status Code: {response.status_code}")
            print(f"Response Headers: {response.headers}")
            print(f"Response Body: {response.text}")
            
            if response.status_code == 200:
                data = response.json()
                self.time_report_id = data['time_report_id']
                print(f"Successfully got time report: {self.time_report_id}")
            elif response.status_code == 404:
                # Create new time report
                create_data = {
                    'start_time': self.start_time.isoformat(),
                    'status': 'online'
                }
                
                print("\n=== Creating new time report ===")
                print(f"URL: {self.api_url}/api/desktop/time-report")
                print("Headers:", headers)
                print("Data:", json.dumps(create_data, indent=2))
                
                response = requests.post(
                    f"{self.api_url}/api/desktop/time-report",
                    headers=headers,
                    json=create_data
                )
                
                print("\n=== Response from create time report ===")
                print(f"Status Code: {response.status_code}")
                print(f"Response Headers: {response.headers}")
                print(f"Response Body: {response.text}")
                
                if response.status_code == 201:
                    data = response.json()
                    self.time_report_id = data['time_report_id']
                    print(f"Successfully created time report: {self.time_report_id}")
                else:
                    raise Exception(f"Failed to create time report. Status: {response.status_code}, Body: {response.text}")
            else:
                raise Exception(f"Unexpected response getting time report. Status: {response.status_code}, Body: {response.text}")
                    
        except requests.exceptions.RequestException as e:
            print(f"\nNetwork error in get_or_create_time_report: {str(e)}")
            self.error.emit(str(e))
            return None
        except json.JSONDecodeError as e:
            print(f"\nJSON decode error in get_or_create_time_report: {str(e)}")
            print(f"Response text that failed to decode: {response.text}")
            self.error.emit(str(e))
            return None
        except Exception as e:
            print(f"\nUnexpected error in get_or_create_time_report: {str(e)}")
            self.error.emit(str(e))
            return None
            
    def get_active_window_info(self):
        try:
            process_list = []
            total_cpu = psutil.cpu_percent()
            total_memory = psutil.virtual_memory()
            
            # Get all running processes
            for proc in psutil.process_iter(['pid', 'name', 'username', 'memory_info', 'cpu_percent', 'create_time', 'status']):
                try:
                    # Get process info
                    proc_info = proc.as_dict(attrs=['pid', 'name', 'username', 'memory_info', 'cpu_percent', 'create_time', 'status'])
                    
                    # Add process to list if it's using resources
                    if proc_info['cpu_percent'] > 0 or proc_info['memory_info'].rss > 1024 * 1024:  # Using CPU or more than 1MB RAM
                        process_list.append({
                            'name': proc_info['name'],
                            'pid': proc_info['pid'],
                            'username': proc_info['username'],
                            'cpu_percent': proc_info['cpu_percent'],
                            'memory_mb': proc_info['memory_info'].rss / (1024 * 1024),  # Convert to MB
                            'status': proc_info['status'],
                            'start_time': datetime.fromtimestamp(proc_info['create_time']).isoformat()
                        })
                except (psutil.NoSuchProcess, psutil.AccessDenied, psutil.ZombieProcess):
                    continue

            # Sort processes by CPU usage
            process_list.sort(key=lambda x: x['cpu_percent'], reverse=True)
            
            # Get top 10 processes by CPU usage
            top_processes = process_list[:10]
            
            # Prepare system metrics
            system_metrics = {
                'cpu': {
                    'total_percent': total_cpu,
                    'count': psutil.cpu_count(),
                    'frequency': psutil.cpu_freq().current if psutil.cpu_freq() else 0
                },
                'memory': {
                    'total_gb': total_memory.total / (1024**3),  # Convert to GB
                    'available_gb': total_memory.available / (1024**3),
                    'percent_used': total_memory.percent
                },
                'disk': {
                    'total_gb': psutil.disk_usage('/').total / (1024**3),
                    'free_gb': psutil.disk_usage('/').free / (1024**3),
                    'percent_used': psutil.disk_usage('/').percent
                }
            }
            
            return {
                'top_processes': top_processes,
                'system_metrics': system_metrics,
                'timestamp': datetime.now().isoformat()
            }
            
        except Exception as e:
            self.error.emit(f"Error getting task manager info: {str(e)}")
            return None

    def track_activity(self):
        try:
            if self.time_report_id is None:
                print("\nNo time report ID, attempting to get/create one...")
                self.get_or_create_time_report()
                if self.time_report_id is None:
                    print("Failed to get/create time report, skipping activity tracking")
                    return

            # Get task manager information
            task_info = self.get_active_window_info()
            if not task_info:
                print("\nNo task manager info available")
                return
                
            current_time = datetime.now()
            
            # Update application usage from top processes
            for process in task_info['top_processes']:
                app_name = process['name']
                if app_name not in self.applications:
                    self.applications[app_name] = {
                        'time': 0,
                        'last_seen': current_time.isoformat(),
                        'cpu_usage': process['cpu_percent'],
                        'memory_usage': process['memory_mb'],
                        'pid': process['pid'],
                        'status': process['status']
                    }
                self.applications[app_name]['time'] += 10
                
            # Calculate times
            self.total_time = (current_time - self.start_time).seconds
            
            # Update productive time based on process names
            productive_apps = ['code', 'chrome', 'firefox', 'terminal', 'postman', 'studio', 'vscode']
            if any(app.lower() in task_info['top_processes'][0]['name'].lower() for app in productive_apps):
                self.productive_time += 10
            
            # Prepare activity data
            activity_data = {
                'time_report_id': self.time_report_id,
                'total_time': self.total_time,
                'productive_time': self.productive_time,
                'idle_time': self.idle_time,
                'activity_data': json.dumps({
                    'applications': self.applications,
                    'system_metrics': task_info['system_metrics'],
                    'top_processes': task_info['top_processes'],
                    'last_update': current_time.isoformat()
                }),
                'status': 'idle' if self.idle_time > self.idle_threshold else 'online'
            }
            
            print("\n=== Sending Activity Data ===")
            print(f"URL: {self.api_url}/api/desktop/activity")
            print("Headers:", {
                'Authorization': 'Bearer [HIDDEN]',
                'Content-Type': 'application/json'
            })
            print("Data:", json.dumps(activity_data, indent=2))
            
            # Send data to server
            headers = {
                'Authorization': f'Bearer {self.token}',
                'Content-Type': 'application/json'
            }
            
            response = requests.post(
                f"{self.api_url}/api/desktop/activity",
                json=activity_data,
                headers=headers,
                timeout=5
            )
            
            print("\n=== Response ===")
            print(f"Status Code: {response.status_code}")
            print(f"Response Body: {response.text}")
            
            if response.status_code != 200:
                raise Exception(f"Server error: {response.status_code} - {response.text}")
            
        except requests.exceptions.RequestException as e:
            print(f"\nNetwork error in track_activity: {str(e)}")
            self.error.emit(f"Network error: {str(e)}")
        except Exception as e:
            print(f"\nUnexpected error in track_activity: {str(e)}")
            self.error.emit(f"Error: {str(e)}")
        finally:
            self.finished.emit()

class LoginWindow(QWidget):
    token_received = pyqtSignal(str)
    
    def __init__(self):
        super().__init__()
        self.token = None
        self.activity_thread = None
        self.activity_worker = None
        self.running = False  # Add flag to control the tracking loop
        self.initUI()
        self.token_received.connect(self.handle_token)

    def closeEvent(self, event):
        self.running = False  # Stop the tracking loop
        if self.activity_thread and self.activity_thread.isRunning():
            self.activity_thread.quit()
            self.activity_thread.wait()
        event.accept()

    def initUI(self):
        self.setWindowTitle('ZenX Timesheet')
        self.setGeometry(100, 100, 400, 300)

        layout = QVBoxLayout()

        # Add logo
        logo_label = QLabel(self)
        logo_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'logo-inv.png')
        pixmap = QPixmap(logo_path)
        if pixmap.isNull():
            print(f"Failed to load logo from: {logo_path}")
            # Set a default text instead
            logo_label.setText('ZenX')
            logo_label.setStyleSheet('font-size: 32px; font-weight: bold; color: #333;')
        else:
            logo_label.setPixmap(pixmap)
        logo_label.setAlignment(Qt.AlignCenter)
        layout.addWidget(logo_label)

        # Add app name
        app_name_label = QLabel('ZenX Timesheet')
        app_name_label.setAlignment(Qt.AlignCenter)
        app_name_label.setStyleSheet('font-size: 24px; font-weight: bold;')
        layout.addWidget(app_name_label)

        self.login_button = QPushButton('Login via Web')
        self.login_button.clicked.connect(self.open_web_login)
        layout.addWidget(self.login_button)

        self.welcome_label = QLabel('')
        layout.addWidget(self.welcome_label)

        self.setLayout(layout)
        
        # Initialize timer for activity tracking
        self.activity_timer = QTimer(self)
        self.activity_timer.timeout.connect(self.start_activity_tracking)
        
    def start_activity_tracking(self):
        if self.activity_worker and not self.activity_thread:
            print("\n=== Starting Activity Tracking ===")
            self.running = True  # Set running flag
            # Create a new thread for activity tracking
            self.activity_thread = QThread()
            self.activity_worker.moveToThread(self.activity_thread)
            
            # Connect the thread's started signal to the track_activity method
            self.activity_thread.started.connect(self.track_activity_loop)
            
            # Start the thread
            self.activity_thread.start()
            print("Activity tracking thread started!")
            
    def track_activity_loop(self):
        print("Activity tracking loop started")
        while self.running:
            try:
                if self.activity_worker:
                    self.activity_worker.track_activity()
                    # Print a simple heartbeat message
                    print(".", end="", flush=True)
                time.sleep(10)  # Wait for 10 seconds before next tracking
            except KeyboardInterrupt:
                print("\nStopping activity tracking...")
                self.running = False
                break
            except Exception as e:
                print(f"\nError in activity tracking: {str(e)}")
                time.sleep(10)  # Wait before retrying
        print("\nActivity tracking stopped")

    def open_web_login(self):
        webbrowser.open('http://localhost:8000/desktop/login?callback_url=http://localhost:8765')

    def handle_token(self, token):
        print("Handling received token...")
        self.token = token
        QMessageBox.information(self, 'Success', 'Login successful!')
        self.update_ui_after_login()
        
        # Initialize activity worker after successful login
        self.activity_worker = ActivityWorker('http://localhost:8000', token)
        self.activity_worker.error.connect(self.handle_activity_error)
        
        # Start activity tracking
        self.start_activity_tracking()
        
        webbrowser.open('http://localhost:8000/dashboard')

    def update_ui_after_login(self):
        self.login_button.hide()
        self.welcome_label.setText('Welcome! You are logged in.')

    def open_main_application(self):
        QMessageBox.information(self, 'Main App', 'Redirecting to main application...')
        self.close()

    def handle_activity_error(self, error_message):
        print(f"\nActivity error: {error_message}")
        # Optionally show error to user if critical
        if "Network error" in error_message:
            QMessageBox.warning(self, 'Connection Error', 
                              'Unable to connect to server. Will retry automatically.')

class RedirectHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        try:
            # Extract token from URL query parameters properly
            from urllib.parse import parse_qs, urlparse
            query_components = parse_qs(urlparse(self.path).query)
            token = query_components.get('token', [None])[0]
            
            if not token:
                print("No token received in callback")
                self.send_response(400)
                self.end_headers()
                self.wfile.write(b'No token received')
                return
                
            print(f"Token received: {token[:10]}...")  # Print first 10 chars for verification
            self.server.app.token_received.emit(token)
            self.send_response(200)
            self.end_headers()
            self.wfile.write(b'Login successful! You can close this window.')
        except Exception as e:
            print(f"Error in RedirectHandler: {e}")
            self.send_response(500)
            self.end_headers()
            self.wfile.write(str(e).encode())

def run_server(app):
    try:
        server = HTTPServer(('localhost', 8765), RedirectHandler)
        server.app = app
        server.serve_forever()
    except Exception as e:
        print(f"Error in server: {e}")

if __name__ == '__main__':
    app = QApplication(sys.argv)
    login_window = LoginWindow()
    threading.Thread(target=run_server, args=(login_window,), daemon=True).start()
    login_window.show()
    sys.exit(app.exec_()) 