<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notification</title>
</head>
<body>
    <h2>You have a new notification!</h2>
    <p><strong>Notification Type:</strong> {{ $notification->notification_type }}</p>
    <p><strong>Message:</strong> {{ $notification->message }}</p>
    <p><strong>Sent At:</strong> {{ \Carbon\Carbon::parse($notification->sent_at)->format('Y-m-d') }}</p>
    <p><strong>Sent By:</strong> {{ $notification->user->email }}</p> <!-- Display sender's email -->
    <p><a href="{{ url('/notifications') }}">View Notifications</a></p>
</body>
</html>
