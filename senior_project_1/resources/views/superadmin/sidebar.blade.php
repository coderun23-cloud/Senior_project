<nav id="sidebar" class="sidebar js-sidebar"><br>
    <br>
    
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='{{url('index')}}'>
            <span class="align-middle" style="text-decoration: underline;">SuperAdminDashboard</span>
        </a>
    
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
    
            <!-- Home -->
            <li class="sidebar-item {{ request()->is('/') || request()->is('index') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{url('index')}}'>
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
                </a>
            </li>
    
            <!-- Users -->
            <li class="sidebar-item {{ request()->is('add_user') ? 'active' : '' }}">
                <a class='sidebar-link' href="{{ url('/add_user') }}">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Users</span>
                </a>
            </li>
    
            <!-- Tariffs -->
            <li class="sidebar-item {{ request()->is('history_tariff') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ url('/history_tariff') }}'>
                    <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Tariffs</span>
                </a>
            </li>
    
            <!-- Notifications -->
            <li class="sidebar-item {{ request()->is('Notification') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{url('/Notification') }}'>
                    <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Notification</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('view_reports') ? 'active' : '' }}">
                <a class='sidebar-link' href="{{ url('view_reports') }}">
                    <i class="align-middle" data-feather="bar-chart"></i> <span class="align-middle">Reports</span>
                </a>
            </li>
    
            <!-- Performance Tracking -->
            <li class="sidebar-item {{ request()->is('Performance_Tracking') ? 'active' : '' }}">
                <a class='sidebar-link' href="{{ url('Performance_Tracking') }}">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Performance Tracking</span>
                </a>
            </li>
       
            <!-- Plugins & Addons -->
            <li class="sidebar-header">
                Plugins & Addons
            </li>
    
            <!-- Charts -->
            <li class="sidebar-item {{ request()->is('charts') ? 'active' : '' }}">
                    <a class='sidebar-link' href='#chart'>
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Charts</span>
                </a>
            </li>
    
            <!-- Maps -->
            <li class="sidebar-item {{ request()->is('maps') ? 'active' : '' }}">
                <a class='sidebar-link' href='#map'>
                    <i class="align-middle" data-feather="map-pin"></i> <span class="align-middle">Maps</span>
                </a>
            </li>
    
            <!-- Tables -->
            <li class="sidebar-item {{ request()->is('charts') ? 'active' : '' }}">
                <a class='sidebar-link' href='#table'>
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Tables</span>
                </a>
            </li>
    
        </ul>
    
        <!-- Upgrade to Pro Section -->
    </div>
    
</nav>
