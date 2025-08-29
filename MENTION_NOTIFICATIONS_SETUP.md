# Mention Notifications Setup Guide

## Overview
The mention notification system has been implemented with Laravel Events and Broadcasting to send real-time push notifications when users are mentioned in task comments.

## Features Implemented

### 1. Laravel Event System
- **Event**: `UserMentioned` - Triggered when a user is mentioned
- **Listener**: `SendMentionNotification` - Handles the notification sending
- **Broadcasting**: Real-time notifications via WebSocket/Pusher

### 2. Notification Types
- **Database Notifications**: Stored in the `notificattions` table
- **Real-time Notifications**: Broadcasted to user's private channel
- **Browser Notifications**: Native browser push notifications
- **Toast Notifications**: In-app notification popups

## Setup Instructions

### Step 1: Configure Broadcasting (Optional for Real-time)

#### Option A: Using Pusher (Recommended)
1. Sign up at [pusher.com](https://pusher.com)
2. Create a new app and get your credentials
3. Add to your `.env` file:
```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
```

#### Option B: Using Laravel WebSockets
1. Install Laravel WebSockets:
```bash
composer require beyondcode/laravel-websockets
php artisan websockets:install
```

2. Configure in `.env`:
```env
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=local
PUSHER_APP_KEY=local
PUSHER_APP_SECRET=local
PUSHER_APP_CLUSTER=mt1
```

### Step 2: Install Laravel Echo (Frontend)
1. Install Echo and Pusher JS:
```bash
npm install --save laravel-echo pusher-js
```

2. Configure in your main JavaScript file:
```javascript
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});
```

### Step 3: Set up Queue Worker (Important!)
The notifications are queued for better performance:

```bash
# Run queue worker
php artisan queue:work

# Or set up supervisor for production
```

### Step 4: Configure Authentication for Broadcasting
Add to your `routes/channels.php`:
```php
Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
```

## How It Works

### 1. User Types @mention
- User types `@username` in a task comment
- Frontend shows autocomplete dropdown with available users
- User selects and submits comment

### 2. Backend Processing
- `TaskController::handleMentions()` extracts mentioned usernames
- `UserMentioned` event is dispatched for each mentioned user
- `SendMentionNotification` listener handles the event

### 3. Notifications Sent
- Database notification created
- Real-time notification broadcasted (if broadcasting configured)
- Browser notification shown (if permissions granted)

## Testing the System

### 1. Basic Testing (Without Broadcasting)
1. Create a task comment with `@username`
2. Check the `notificattions` table for new records
3. Check Laravel logs for mention events

### 2. Real-time Testing (With Broadcasting)
1. Set up broadcasting as described above
2. Open task page in two browser windows (different users)
3. Mention the other user and see real-time notification

### 3. Browser Notifications
1. Allow notifications when prompted
2. Mention yourself or another user
3. See native browser notification popup

## Troubleshooting

### Notifications Not Working
1. Check queue worker is running: `php artisan queue:work`
2. Check Laravel logs: `storage/logs/laravel.log`
3. Verify event listener is registered in `EventServiceProvider`

### Real-time Not Working
1. Check broadcasting driver in `.env`
2. Verify Pusher/WebSocket credentials
3. Check browser console for Echo connection errors
4. Ensure authentication routes are set up

### Browser Notifications Not Showing
1. Check notification permissions in browser settings
2. Ensure HTTPS (required for most browsers)
3. Check console for permission errors

## Extending the System

### Add Email Notifications
Uncomment the email notification code in `SendMentionNotification.php` and create a Mailable:
```bash
php artisan make:mail MentionNotificationMail
```

### Add SMS Notifications
Install a SMS service like Twilio and add SMS sending logic to the listener.

### Add Mobile Push Notifications
Integrate with Firebase Cloud Messaging (FCM) for mobile app notifications.

## File Structure
```
app/
├── Events/
│   └── UserMentioned.php
├── Listeners/
│   └── SendMentionNotification.php
├── Http/Controllers/
│   └── TaskController.php (updated)
└── Providers/
    └── EventServiceProvider.php (updated)

resources/views/task/
└── show.blade.php (updated with mention UI)

routes/
└── api.php (mention users endpoint)
```

## Performance Considerations
- Notifications are queued to avoid blocking requests
- Mention lookups are limited to task's employer organization
- Real-time notifications use private channels for security
- Browser notifications are cached to avoid duplicates

The system is now ready to send push notifications when users are mentioned in task comments! 