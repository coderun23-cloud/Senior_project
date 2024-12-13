<nav id="sidebar" class="sidebar js-sidebar"><br>

<div class="sidebar-content js-simplebar">
    <a class='sidebar-brand' href='{{url('index')}}'>
        <span  style="text-decoration: underline;" class="align-middle">MeterReaderDashboard</span>
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

        <!-- Customer Status -->
        <li class="sidebar-item {{ request()->is('readings') ? 'active' : '' }}">
            <a class='sidebar-link' href='/readings'>
                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Readings</span>
            </a>
        </li>

        <!-- Bills -->
        <li class="sidebar-item {{ request()->is('service_cutoff') ? 'active' : '' }}">
            <a class='sidebar-link' href='{{url('service_cutoff')}}'>
                <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Service CutOff</span>
            </a>
        </li>

    

        <!-- Reports -->
        <li class="sidebar-item {{ request()->is('reports_reader') ? 'active' : '' }}">
            <a class='sidebar-link' href={{url('reports_reader')}}>
                <i class="align-middle" data-feather="bar-chart"></i> <span class="align-middle">Reports</span>
            </a>
        </li>

        <!-- Notifications -->
        <li class="sidebar-item {{ request()->is('Messages_reader') ? 'active' : '' }}">
            <a class='sidebar-link' href={{url('Messages_reader')}}>
                <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Messages</span>
            </a>
        </li>

        <!-- Messages -->
       

        <li class="sidebar-header">
            Plugins & Addons
        </li>

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
