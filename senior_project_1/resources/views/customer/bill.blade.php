<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Services</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 1.5em;
        }

        nav {
            background-color: #333;
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
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            display: block;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #575757;
        }

        .section {
            padding: 30px;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            text-align: center;
            color: #4CAF50;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 20px;
        }

        form label {
            font-size: 0.9em;
            color: #555;
        }

        form input, form select, form button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9em;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s ease;
        }

        form button:hover {
            background-color: #45a049;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            color: #555;
        }

        .no-results {
            text-align: center;
            color: #555;
            margin: 20px 0;
            font-size: 1.1em;
        }

        footer {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 10px;
            font-size: 0.9em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Customer Services Portal</h1>
    </header>
    <nav>
        <ul>
            <li><a href="{{ url('bill_show') }}">Bill Payment</a></li>
            <li><a href="#usage-tracking">Usage Tracking and History</a></li>
            <li><a href="{{ url('complaint_service') }}">Complaint Sending Service</a></li>
            <li><a href="#status-checking">Status Checking</a></li>
            <li><a href="{{ url('notifications') }}">Notification</a></li>
            <li><a href="{{ route('profile.show') }}">Profile</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </nav>
    <section class="section">
        <h2>My Bills</h2>

        <!-- Filter Form -->
        <form action="{{ url('bill_show') }}" method="GET">
            <label for="from">From:</label>
            <input type="date" id="from" name="from" value="{{ request('from') }}">

            <label for="to">To:</label>
            <input type="date" id="to" name="to" value="{{ request('to') }}">

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="{{ request('amount') }}"><br>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="">--All--</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            </select>

            <button type="submit">Filter</button>
            <button><a href="{{url('bill_show')}}">RESET</a></button>
        </form>

        <!-- Table or No-Results Message -->
        <div class="table-container">
            @if($bills->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bill ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date Generated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bill->id }}</td>
                                <td>{{ $bill->amount }}</td>
                                <td>{{ ucfirst($bill->status) }}</td>
                                <td>{{ $bill->created_at->format('Y-m-d') }}</td>
                                <td><button class="btn btn-secondary">Pay Bill</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-results">No bills found for the selected filters. Please try again with different criteria.</p>
            @endif
        </div>

        <!-- Pagination Links -->
        <div style="margin-top: 20px;">
            {{ $bills->links() }}
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Customer Services Portal. All Rights Reserved.</p>
    </footer>
</body>
</html>
