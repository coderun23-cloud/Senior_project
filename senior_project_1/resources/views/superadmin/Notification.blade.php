
<!DOCTYPE html>
<html lang="en">
@include('superadmin.css')
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<body>
	<div class="wrapper">
        @include('superadmin.sidebar')
        <div class="main">
            @include('superadmin.header')
            
            <!-- Content goes here -->
            <div class="content">
                <!-- Create Notification Button -->
                <div class="text-end mb-4 mt-2">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createNotificationModal">
                        <i style="color: white;" class="fas fa-plus"></i> Create New Notification
                    </button>
                </div>
                
                <!-- Notifications Table -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="mb-4 mt-2">
                    <form method="GET" action="{{ url('Notification') }}" class="d-flex align-items-center gap-3">
                        <!-- Role Filter -->
                        <div>
                            <label for="role" class="form-label">Filter by Role:</label>
                            <select name="role" id="role" class="form-control">
                                <option value="">All Roles</option>
                                <option value="Meter Reader" {{ request('role') == 'Meter Reader' ? 'selected' : '' }}>Meter Reader</option>
                                <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                
                        <!-- Sent At Filter -->
                        <div>
                            <label for="sent_at" class="form-label">Filter by Sent At:</label>
                            <input type="date" name="sent_at" id="sent_at" class="form-control" value="{{ request('sent_at') }}">
                        </div>
                
                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" style="background-color: green" class="btn btn-primary">
                                <i class=""></i> Apply Filters
                            </button>
                            <button class="btn btn-secondary" ><a style="color: white; text-decoration:none;" href="{{url('Notification')}}">Reset</a></button>
                        </div>
                    </form>
                </div><br>
                
                <div class="card mt-3 shadow-lg">
                    <div class="card-header" style="font-size:25px;background-color: #f8f9fa; font-weight: bold; color: #333; text-align: center; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bell" style="margin-right: 10px; color: green;"></i>
                        All Notifications
                    </div>
                    <div class="card-body max-h-[430px] overflow-auto">
                        <table class="notification-table w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="p-3 text-left border-b">#</th>
                                    <th class="p-3 text-left border-b">User Name</th>
                                    <th class="p-3 text-left border-b">Message</th>
                                    <th class="p-3 text-left border-b">Type</th>
                                    <th class="p-3 text-left border-b">User Role</th>
                                    <th class="p-3 text-left border-b">Sent At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($notifications as $notification)
                                    <tr class="hover:bg-gray-100">
                                        <td class="p-3 border-b">{{ $loop->iteration }}</td>
                                        <td class="p-3 border-b">{{ $notification->user->email }}</td>
                                        <td class="p-3 border-b">{{ $notification->message }}</td>
                                        <td class="p-3 border-b">{{ $notification->notification_type }}</td>
                                        <td class="p-3 border-b">{{ $notification->user->role }}</td>
                                        <td class="p-3 border-b">{{ $notification->sent_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-3 text-center">No notifications found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                
            </div>
            
            @include('superadmin.footer')
        </div>
    </div>
        <!-- Include Footer -->
     
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
            
    




</body>

</html>