<!-- Include FontAwesome for the message icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <!-- Notification Icon -->
         <!-- Notification Icon -->
<li class="nav-item">
    <a class="nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#notificationModal" id="notificationIcon">
        <div class="position-relative">
            <i class="align-middle" data-feather="bell"></i>
            <!-- Display notification count, only show if there are new notifications -->
            <span class="indicator" id="notificationCount" 
                  style="{{ count($notifications ?? []) > 0 ? '' : 'display: none;' }}      background-color: #2c3e50;">
                {{ count($notifications ?? []) > 0 ? count($notifications) : '' }}
            </span>
        </div>
    </a>
</li>


            <!-- Account Icon -->
            <li class="nav-item">
                <a class="nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#accountModal">
                    <div class="avatar-container" style="display: inline-block; position: relative;">
                        @if(Auth::user()->image)
                            <img src="images/{{ Auth::user()->image }}" class="avatar img-fluid rounded-circle" alt="{{ Auth::user()->name }}" style="width: 50px; height: 50px;">
                        @else
                            <div class="avatar-circle" style=" width: 50px; height: 50px; background-color: #043467;color: #fff; font-size: 20px; font-weight: bolder; text-align: center; line-height: 50px; border-radius: 50%; cursor: pointer;">
                                {{ strtoupper(Auth::user()->name[0]) }}
                            </div>
                        @endif
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Notification Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($notifications as $index => $notification)
                        @if($index >= 3) @break @endif
                        <a href="#" class="list-group-item" data-notification-id="{{ $notification->id }}">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-{{ $notification->status == 'unread' ? 'danger' : 'muted' }}" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">{{ $notification->message }}</div>
                                    <div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            
            <div class="modal-footer">
                <a href="{{ url('message') }}" class="btn btn-link">Show all messages</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Account Modal -->
<div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">Account Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to logout?')"><i class="align-middle me-1" data-feather="log-out"></i> Log Out</a></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (with Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    // JavaScript to handle the click event and hide the notification count once clicked
    document.getElementById('notificationIcon').addEventListener('click', function() {
        var notificationCount = document.getElementById('notificationCount');
        if (notificationCount && notificationCount.innerHTML) {
            // Hide the notification count when clicked
            notificationCount.style.display = 'none';
            
            // Optionally, you could also mark the notifications as read here (if backend supports)
            // For example, using AJAX to update the notifications as read in your database.
            // Example:
            /*
            fetch('/mark-notifications-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ notifications: [...list of notification IDs] })
            });
            */
        }
    });

    // Optional: If you want to ensure that the notification count is displayed when new notifications are available
    // For example, after reloading the page or after receiving new notifications dynamically
    function updateNotificationCount(newCount) {
        var notificationCount = document.getElementById('notificationCount');
        if (newCount > 0) {
            notificationCount.innerHTML = newCount;
            notificationCount.style.display = 'inline'; // Show the notification count if new notifications exist
        } else {
            notificationCount.style.display = 'none'; // Hide if there are no notifications
        }
    }
    

    // Example: Call the function when new notifications come
    // updateNotificationCount(5);  // Uncomment if using real-time updates for new notifications.
</script>

