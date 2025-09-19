<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
            <span class="material-icons me-2">school</span>
            PanpacificU Library Admin
        </a>
        
        <div class="navbar-nav">
            <a class="nav-link text-white d-flex align-items-center me-3" href="../index.php">
                <span class="material-icons me-2">home</span>
                <span class="d-none d-md-inline">Home</span>
            </a>
        </div>
        
        <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <span class="material-icons me-2">access_time</span>
                    <span id="navbar-time"><?php echo date('g:i A'); ?></span>
                </a>
            </div>
            
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="rounded-circle me-2" width="32" height="32" alt="Profile">
                    <span class="d-none d-md-inline"><?php echo $user['firstname'].' '.$user['lastname']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="text-center">
                            <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="rounded-circle mb-2" width="60" height="60" alt="Profile">
                            <h6 class="mb-0"><?php echo $user['firstname'].' '.$user['lastname']; ?></h6>
                            <small class="text-muted">Member since <?php echo date('M. Y', strtotime($user['created_on'])); ?></small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#profile" data-bs-toggle="modal" id="admin_profile">
                            <span class="material-icons me-2">edit</span>
                            Update Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="logout.php">
                            <span class="material-icons me-2">logout</span>
                            Sign Out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php include 'includes/profile_modal.php'; ?>