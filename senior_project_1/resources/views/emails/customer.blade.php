<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #e3e6ef;
        }
        .email-header {
            background: linear-gradient(90deg, #1D976C, #93F9B9);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            font-size: 28px;
            margin: 0;
            font-weight: 600;
        }
        .email-body {
            padding: 30px 20px;
        }
        .email-body h1 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #1D976C;
            font-weight: 700;
        }
        .email-body p {
            font-size: 16px;
            margin: 10px 0;
            color: #555;
            line-height: 1.8;
        }
        .email-body .highlight {
            font-weight: bold;
            color: #1D976C;
        }
        .email-footer {
            background: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #777;
            border-top: 1px solid #e3e6ef;
        }
        .email-footer a {
            color: #1D976C;
            text-decoration: none;
            font-weight: 600;
        }
        .button {
            display: inline-block;
            padding: 12px 20px;
            font-size: 16px;
            color: #ffffff;
            background: #1D976C;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 20px;
        }
        .button:hover {
            background: #159A5C;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h1>📩 Notification Alert</h1>
        </div>
        
        <!-- Body Section -->
        <div class="email-body">
            <h1>Dear <span class="highlight">{{$notification->user->name}}</span>,</h1>
            <p>We hope this message finds you well.</p>
            <p>We wanted to share an important notification:</p>
            <p class="highlight">"{{ $notification->message }}"</p>
            <p>We appreciate your attention to this matter. If you have any questions, our support team is here to assist you.</p>
            <a href="#" class="button">Contact Support</a>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>If you have further queries, feel free to <a href="#">reach out</a>.</p>
            <p>&copy; {{ date('Y') }} Ethiopia Billing System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
