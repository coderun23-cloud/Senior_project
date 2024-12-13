<!DOCTYPE html>
<html>
<head>
    <title>Account Deleted</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>
    <p>We wanted to let you know that your account has been deleted from our system. If you have any questions or concerns, please contact our support team.</p>
    <p>Thank you,<br>The {{ config('app.name') }} Team</p>
</body>
</html>
