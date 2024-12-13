<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Services</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fa;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        nav {
            background-color: #333;
            overflow: hidden;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #575757;
        }

        /* Section Styles */
        .section {
            padding: 20px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            border-radius: 8px;
        }

        .section h2 {
            color: #333;
            text-align: center;
        }

        .notification {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .notification h3 {
            margin: 0;
            color: #4CAF50;
        }

        .notification p {
            margin: 5px 0;
            color: #555;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Customer Services Portal</h1>
    </header>

    <nav>
        <ul>
            <li><a href="{{url('bill_show')}}">Bill Payment</a></li>
            <li><a href="#usage-tracking">Usage Tracking and History</a></li>
            <li><a href={{url('complaint_service')}}>Complaint Sending Service</a></li>
            <li><a href="#status-checking">Status Checking</a></li>
            <li><a href={{url('notifications')}}>Notification</a></li>
            <li><a href="{{route('profile.show')}}">Profile</a></li>
            <li><a href="{{route('logout')}}">Logout</a></li>
        </ul>
    </nav>

    <div class="section">
        <h2>Your Notifications</h2>
        @if($notifications->isEmpty())
            <p>No notifications have been sent to you yet.</p>
        @else
            @foreach($notifications as $notification)
                <div class="notification">
                    <h3>{{ $notification->type }}</h3>
                    <p>{{ $notification->message }}</p>

                    <small>Sent on: {{ $notification->created_at->format('d M Y, H:i') }}</small>
                </div>
            @endforeach
        @endif
    </div>

    <footer>
        <p>&copy; 2024 Customer Services Portal. All Rights Reserved.</p>
    </footer>
</body>
</html>