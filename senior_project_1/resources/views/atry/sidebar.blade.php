<div class="sidebar">
    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="{{ url('index') }}" class="sidebar-nav-link {{ request()->is('index') ? 'active' : '' }}">
                <div>
                    <i class="fas fa-home"></i> <!-- Home Icon -->
                </div>
                <span>Home</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ url('/add_user') }}"class="sidebar-nav-link {{ request()->is('add_user') ? 'active' : '' }}">
                <div>
                    <i class="fas fa-users"></i> <!-- Users Icon -->
                </div>
                <span>Users</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ url('/history_tariff') }}" class="sidebar-nav-link {{ request()->is('history_tariff') ? 'active' : '' }}">
                <div>
                    <i class="fas fa-money-bill-wave"></i> <!-- Tariff Icon -->
                </div>
                <span>Tariff</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href= "url('/Notification') }}" class="sidebar-nav-link {{ request()->is('Notification') ? 'active' : '' }}">
                <div>
                    <i class="fas fa-bell"></i> <!-- Notification Icon -->
                </div>
                <span>Notification</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ url('Performance_Tracking') }}" class="sidebar-nav-link {{ request()->is('Performance_Tracking') ? 'active' : '' }}">
                <div>
                    <i class="fas fa-chart-line"></i> <!-- Performance Tracking Icon -->
                </div>
                <span>Performance tracking</span>
            </a>
        </li>
    </ul>
</div>
