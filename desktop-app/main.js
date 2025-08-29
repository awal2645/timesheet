const { app, BrowserWindow, ipcMain } = require('electron');
const path = require('path');
const screenshot = require('screenshot-desktop');
const axios = require('axios');
const fs = require('fs');
const sqlite3 = require('sqlite3').verbose();
const activeWin = require('active-win');

// Initialize SQLite database
const db = new sqlite3.Database('activity_data.db', (err) => {
    if (err) {
        console.error('Error opening database:', err);
    } else {
        console.log('Connected to SQLite database');
        db.run(`CREATE TABLE IF NOT EXISTS screenshots (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            file_path TEXT,
            taken_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )`);
    }
});


function createWindow() {
    const win = new BrowserWindow({
        width: 800,
        height: 600,
        webPreferences: {
            preload: path.join(__dirname, 'preload.js')
        }
    });

    win.loadFile('index.html');
}

function startScreenshotCapture() {
    setInterval(() => {
        screenshot({ format: 'png' }).then((img) => {
            const filePath = `screenshots/screenshot_${Date.now()}.png`;
            fs.writeFileSync(filePath, img);
            console.log('Screenshot saved:', filePath);

            // Insert metadata into the database
            db.run(`INSERT INTO screenshots (file_path) VALUES (?)`, [filePath], (err) => {
                if (err) {
                    console.error('Error inserting into database:', err);
                } else {
                    console.log('Screenshot metadata saved to database');
                }
            });
        }).catch((err) => {
            console.error('Error capturing screenshot:', err);
        });
    }, 5 * 60 * 1000); // Every 5 minutes
}

ipcMain.on('login', async (event, credentials) => {
    try {
        const response = await axios.post('http://your-laravel-backend.com/api/login', credentials);
        if (response.data.success) {
            console.log('Login successful');
            // Handle successful login
        } else {
            console.log('Login failed');
            // Handle login failure
        }
    } catch (error) {
        console.error('Error during login:', error);
    }
});

// Create a table for activity tracking
function initializeDatabase() {
    db.run(`CREATE TABLE IF NOT EXISTS activity (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        app_name TEXT,
        title TEXT,
        started_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )`);
}

function startActivityTracking() {
    setInterval(async () => {
        try {
            const activeWindow = await activeWin();
            if (activeWindow) {
                const { owner, title } = activeWindow;
                const appName = owner.name;
                console.log(`Active window: ${appName} - ${title}`);

                // Insert activity data into the database
                db.run(`INSERT INTO activity (app_name, title) VALUES (?, ?)`, [appName, title], (err) => {
                    if (err) {
                        console.error('Error inserting activity data into database:', err);
                    } else {
                        console.log('Activity data saved to database');
                    }
                });
            }
        } catch (error) {
            console.error('Error getting active window:', error);
        }
    }, 60 * 1000); // Every minute
}

app.whenReady().then(() => {
    initializeDatabase();
    createWindow();
    startScreenshotCapture();
    startActivityTracking();

    app.on('activate', () => {
        if (BrowserWindow.getAllWindows().length === 0) createWindow();
    });
});

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') app.quit();
}); 