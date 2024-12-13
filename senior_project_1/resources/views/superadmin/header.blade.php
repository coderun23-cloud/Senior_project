<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
<i class="hamburger align-self-center"></i>
</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
       
            
       

  <li class="nav-item">
    <a class="nav-icon" href="#" data-bs-toggle="modal" data-bs-target="#accountModal">
        <div class="avatar-container" style="display: inline-block; position: relative;">
       
                <div class="avatar-circle" style="width: 50px; height: 50px; background-color: #043467;color: #fff; font-size: 20px; font-weight: bold; text-align: center; line-height: 50px; border-radius: 50%; cursor: pointer;">
                    {{ strtoupper(Auth::user()->name[0]) }}
                </div>
        
        </a>
    </div>
</li>
                    
            </li>
        </ul>
    </div>
</nav>
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


