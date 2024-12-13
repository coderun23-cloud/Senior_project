<!DOCTYPE html>
<html>
  <head> 
    <style>
      .sidebar-nav-item {
      margin-bottom: 15px; /* Adds space between each sidebar item */
  }
  
  .sidebar-nav-link {
      display: flex;
      align-items: center;
      padding: 10px 15px; /* Adds padding to the links for better spacing */
  }
  
  .sidebar-nav-link i {
      margin-right: 10px; /* Adds space between the icon and the text */
  }
  
  *{
    color: black;
  }
  .notification-table {
            width: 100%;
            border-collapse: collapse;
        }
        .notification-table th, .notification-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .notification-table th {
            background-color: #f4f4f4;
            color: #333;
        }
        .notification-table tr:hover {
            background-color: #f1f1f1;
        }
        .notification-status {
            font-weight: bold;
        }
        .read {
            color: green;
        }
        .unread {
            color: red;
        }

        .modal-header, .modal-footer {
            background-color: #f8f9fa;
        }

  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

   @include('superadmin.css')

  </head>
  <body class="dark-mode">
  @include('superadmin.header')
 <br>
  <div class="flex flex-col md:flex-row">
   @include('superadmin.sidebar')
   <div class="wrapper">
     <!-- Create Notification Button (plus sign) -->
     <div class="text-end mb-4 mt-2"><br>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createNotificationModal">
            <i style="color: white;" class="fas fa-plus"></i> Create New Notification
        </button>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Display all notifications -->
    <div class="card mt-3" style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
        <div class="card-header" style="font-size:25px;background-color: #f8f9fa; font-weight: bold; color: #333; text-align: center; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-bell" style="margin-right: 10px; color: green;"></i>
            All Notifications
        </div>
        

        <div class="card-body" style="height: 430px;">
            <table class="notification-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Message</th>
                        <th>Type</th>
                        <th>User role</th>
                        <th>Sent At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $notification->user->email }}</td> <!-- Display user email -->
                            <td>{{ $notification->message }}</td>
                            <td>{{ $notification->notification_type }}</td>
                            <td>{{$notification->user->role}}</td>
                            <td>{{ $notification->sent_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Modal to Create Notification -->
<div class="modal fade" id="createNotificationModal" tabindex="-1" aria-labelledby="createNotificationModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createNotificationModalLabel">Create New Notification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('notifications_store') }}" method="POST">
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

      @include('superadmin.footer')
  <script>
    
  </script>
  </body>
</html>