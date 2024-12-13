<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Notifications</title>
    @include('admin.css')
    <style>
       /* General Styles */
  body {
      font-family: 'Roboto', sans-serif;
      background-color: #f3f4f6;
      margin: 0;
      padding: 0;
  }

  /* Header Section */
  h1 {
      text-align: center;
      font-size: 2.5rem;
      color: #000000;
      margin-bottom: 1rem;
      
  }

  h1 i {
    color: #3498db;
      margin-right: 0.5rem;
  }

 

  /* Table Styles */
  .static-table {
      width: 100%;
      max-width: 90%;
      margin: 0 auto;
      border-collapse: collapse;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  }

  .static-table th {
      background-color: #2c3e50;
      color: #ffffff;
      padding: 15px;
      font-size: 1rem;
      text-align: left;
  }

  .static-table td {
        padding: 15px;
        font-size: 0.95rem;
        color: #000000;  /* Light text color for table cells */
        border-bottom: none; 
        background-color: #f3f4f6;

      
        /* Light border for table rows */
    }

  .static-table tr:hover {
      background-color: #f9f9f9;
  }

  .static-table tbody tr:last-child td {
      border-bottom: none;
  }

  /* Pagination Styles */
  .pagination {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 20px;
  }

  .pagination a,
  .pagination span {
      padding: 10px 15px;
      font-size: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      color: #27ae60;
      text-decoration: none;
      transition: background-color 0.3s ease, color 0.3s ease;
  }

  .pagination a:hover {
      background-color: #2c3e50;
      color: #fff;
  }

  .pagination .active {
      background-color: #2c3e50;
      color: #fff;
      pointer-events: none;
  }

  .pagination .disabled {
      color: #aaa;
      background-color: #f1f1f1;
      pointer-events: none;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
      .filter-form input,
      .filter-form select,
      .filter-form button {
          width: 100%;
          margin: 5px;
      }

      .static-table th,
      .static-table td {
          padding: 10px;
          font-size: 0.9rem;
      }
  }
    </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main">
            @include('admin.header')

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="content">
                <h1 style="font-weight: bolder;"><i class="fas fa-bell" style="margin-right: 15px;"></i>Notification Sending Page</h1><br>

                <div class="filter-form"></div>

                <table class="static-table" id="customerTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->user->name }}</td>
                                <td>{{ $customer->user->email }}</td>
                                <td>
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createNotificationModal" onclick="fillEmail('{{ $customer->user->email }}')">
                                        <i style="color: white;" class="fas fa-mail"></i> Send Notification
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><br><br>

                <nav class="pagination">
                    @if ($customers->onFirstPage())
                        <span class="disabled">Previous</span>
                    @else
                        <a href="{{ $customers->previousPageUrl() }}">Previous</a>
                    @endif
      
                    @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="{{ $page == $customers->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach
      
                    @if ($customers->hasMorePages())
                        <a href="{{ $customers->nextPageUrl() }}">Next</a>
                    @else
                        <span class="disabled">Next</span>
                    @endif
                </nav>
                <br>
            </div>

            @include('admin.footer')
        </div>
    </div>

    <!-- Modal to send notification -->
    <div class="modal fade" id="createNotificationModal" tabindex="-1" aria-labelledby="createNotificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNotificationModalLabel">Create New Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('send_notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="user_email">User Email (Receiver)</label>
                            <input type="email" name="user_email" id="user_email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="notification_type">Notification Type</label>
                            <input type="text" name="notification_type" id="notification_type" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Notification</button>
                </div>
                    </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript function to fill the email

        // JavaScript function to fill the email field in the modal
        function fillEmail(email) {
            document.getElementById('user_email').value = email;
        }
    </script>

</body>
</html>
