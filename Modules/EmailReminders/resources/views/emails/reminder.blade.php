<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px 20px;
        }
        .reminder-type {
            display: inline-block;
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
            text-transform: capitalize;
            margin-bottom: 20px;
        }
        .reminder-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        .reminder-description {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.7;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }
        .info-box h3 {
            margin: 0 0 10px 0;
            color: #007bff;
            font-size: 16px;
        }
        .info-box p {
            margin: 0;
            color: #666;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #e9ecef;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .timestamp {
            color: #999;
            font-size: 12px;
            margin-top: 20px;
            text-align: center;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 4px;
            }
            .header, .content {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📧 Reminder Notification</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Reminder Type Badge -->
            <span class="reminder-type">
                {{ str_replace('_', ' ', $type) }}
            </span>

            <!-- Reminder Title -->
            <div class="reminder-title">
                {{ $title }}
            </div>

            <!-- Description -->
            @if($description)
            <div class="reminder-description">
                {{ $description }}
            </div>
            @endif

            <!-- Info Box -->
            <div class="info-box">
                <h3>📅 Reminder Details</h3>
                <p><strong>Type:</strong> {{ ucwords(str_replace('_', ' ', $type)) }}</p>
                <p><strong>Frequency:</strong> {{ ucfirst($reminder->frequency) }}</p>
                @if($reminder->reminder_days_before > 0)
                <p><strong>Notice Period:</strong> {{ $reminder->reminder_days_before }} day(s) in advance</p>
                @endif
                <p><strong>Scheduled Time:</strong> {{ $reminder->reminder_time }}</p>
            </div>

            <!-- Action Required -->
            @if($type === 'timesheet_submission')
            <div class="info-box" style="border-left-color: #28a745;">
                <h3 style="color: #28a745;">⏰ Action Required</h3>
                <p>Please ensure your timesheet is submitted on time to avoid any delays in processing.</p>
            </div>
            @elseif($type === 'task_deadline')
            <div class="info-box" style="border-left-color: #ffc107;">
                <h3 style="color: #e67e22;">🎯 Task Deadline Approaching</h3>
                <p>This is a reminder that you have an upcoming task deadline. Please review and complete your assigned tasks.</p>
            </div>
            @elseif($type === 'meeting')
            <div class="info-box" style="border-left-color: #17a2b8;">
                <h3 style="color: #17a2b8;">🤝 Meeting Reminder</h3>
                <p>You have an upcoming meeting. Please prepare accordingly and join on time.</p>
            </div>
            @elseif($type === 'project_milestone')
            <div class="info-box" style="border-left-color: #6f42c1;">
                <h3 style="color: #6f42c1;">🏆 Project Milestone</h3>
                <p>This is a reminder about an important project milestone. Please ensure all deliverables are on track.</p>
            </div>
            @endif

            <!-- Timestamp -->
            <div class="timestamp">
                📅 Sent on {{ now()->format('M d, Y \a\t g:i A') }}
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>This is an automated reminder from your Timesheet Management System.</p>
            <p>If you have any questions, please contact your system administrator.</p>
            <p style="margin-top: 15px;">
                <a href="{{ config('app.url') }}">Visit Dashboard</a> | 
                <a href="mailto:{{ config('mail.from.address') }}">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html> 