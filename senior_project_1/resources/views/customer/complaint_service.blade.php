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
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
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
            font-size: 16px;
        }

        nav ul li a:hover {
            background-color: #575757;
        }

        .section {
            padding: 30px;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            border-radius: 10px;
        }

        .section h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .complaints-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .complaints-table th,
        .complaints-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .complaints-table th {
            background-color: #f4f4f4;
            color: #333;
        }

        .complaints-table tr:hover {
            background-color: #f1f1f1;
        }

        .add-btn {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-btn:hover {
            background-color: #45a049;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .close-btn {
            float: right;
            font-size: 20px;
            cursor: pointer;
            color: #333;
        }

        .close-btn:hover {
            color: red;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #333;
            color: white;
            font-size: 14px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
         /* Modal Styles */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1000; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
        backdrop-filter: blur(5px); /* Adds a blur effect */
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto; /* 10% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 100%; /* Full-width on smaller screens */
        max-width: 600px; /* Limit width */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.5s;
    }

    .modal-header {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
        color: #333;
    }

    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: #000;
        text-decoration: none;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 14px;
        color: #555;
        background-color: #f9f9f9;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-group textarea {
        height: 120px;
        resize: none;
    }

    .form-group button {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-group button:hover {
        background-color: #45a049;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    </style>
</head>
<body>
    <header>
        Customer Services Portal
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
    @if(session('success'))
    <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
  @endif
    <!-- Complaint Table Section -->
    <div class="section" id="complaint-service">
        <h2>Complaints</h2>
        <button class="add-btn" onclick="openModal()">Add Complaint</button>

        <table class="complaints-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Rows (replace with dynamic data) -->
                @foreach ($data as $data )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->subject}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->created_at}}</td>
                    </tr>
                @endforeach
        
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding Complaint -->
    <div class="modal" id="complaintModal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div class="modal-header">Submit a Complaint</div>
            <form action="{{ route('complaints.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter complaint subject" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" placeholder="Enter complaint details" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Submit Complaint</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        &copy; 2024 Customer Services Portal. All Rights Reserved.
    </footer>

    <script>
        const modal = document.getElementById("complaintModal");

        function openModal() {
            modal.style.display = "flex";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        };
    </script>
</body>
</html>
