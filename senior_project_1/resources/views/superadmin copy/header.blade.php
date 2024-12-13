<div class="navbar">
  <!-- nav left -->
  <ul class="navbar-nav" style="margin-left: 25px;">
      <li class="nav-item">
          <a class="nav-link">
              <i class="fas fa-bars" onclick="collapseSidebar()"></i>
          </a>
      </li>
   
  </ul>
  <!-- end nav left -->
  <!-- form -->
  <form class="navbar-search" method="GET" action="{{ url('search') }}" style="display: flex; align-items: center; gap: 8px;">
    <!-- Dropdown to Select Search Category -->
    <select name="category" class="navbar-search-category" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All</option>
        <option value="tariffs" {{ request('category') == 'tariffs' ? 'selected' : '' }}>Tariffs</option>
        <option value="users" {{ request('category') == 'users' ? 'selected' : '' }}>Users</option>
        <option value="notifications" {{ request('category') == 'notifications' ? 'selected' : '' }}>Notifications</option>
    </select>

    <!-- Search Input -->
    <input type="text" name="query" class="navbar-search-input" placeholder="What are you looking for..." value="{{ request('query') }}" style="padding: 8px; flex: 1; border: 1px solid #ccc; border-radius: 4px;">
    
    <!-- Search Icon -->
    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0; margin: 0;">
        <i class="fas fa-search" style="color: #007bff; font-size: 18px;"></i>
    </button>
</form>

  <!-- end form -->
  <!-- nav right -->
  <ul class="navbar-nav nav-right">
      <li class="nav-item mode">
          <a class="nav-link" href="#" onclick="switchTheme()">
              <i class="fas fa-moon dark-icon"></i>
              <i class="fas fa-sun light-icon"></i>
          </a>
      </li>
      <li class="nav-item dropdown">
        
         
      </li>
      <li class="nav-item avt-wrapper">
          <div class="avt dropdown">
              <img src="at-pro-admin-template-master/assets/tuat.jpg" alt="User image" class="dropdown-toggle" data-toggle="user-menu">
              <ul id="user-menu" class="dropdown-menu">
                  <li  class="dropdown-menu-item">
                      <a class="dropdown-menu-link" href="{{route('profile.show')}}">
                          <div>
                              <i class="fas fa-user-tie"></i>
                          </div>
                          <span>Profile</span>
                      </a>
                  </li>
              
                  <li class="dropdown-menu-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="dropdown-menu-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div>
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span>Logout</span>
                    </a>
                </li>
                
              </ul>
          </div>
      </li>
  </ul>
  <!-- end nav right -->
</div>