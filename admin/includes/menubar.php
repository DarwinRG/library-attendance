<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">Admin Panel</div>
        <button class="sidebar-toggle" id="sidebarToggle">
            <span class="material-icons">menu</span>
        </button>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">
            <span class="material-icons">dashboard</span>
            <span>Dashboard</span>
        </li>
        <li>
            <a href="home.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">
                <span class="material-icons">dashboard</span>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="menu-header">
            <span class="material-icons">manage_accounts</span>
            <span>Management</span>
        </li>
        <li>
            <a href="attendance.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : ''; ?>">
                <span class="material-icons">event</span>
                <span>Attendance</span>
            </a>
        </li>
        <li>
            <a href="students.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'students.php' ? 'active' : ''; ?>">
                <span class="material-icons">people</span>
                <span>Students</span>
            </a>
        </li>
        <li>
            <a href="purposes.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'purposes.php' ? 'active' : ''; ?>">
                <span class="material-icons">category</span>
                <span>Purposes</span>
            </a>
        </li>
        
        <li class="menu-header">
            <span class="material-icons">settings</span>
            <span>System</span>
        </li>
        <li>
            <a href="settings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                <span class="material-icons">settings</span>
                <span>Settings</span>
            </a>
        </li>
    </ul>
</aside>