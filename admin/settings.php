<?php
	include 'includes/session.php';
	include '../conn.php';
	include 'includes/timezone_helper.php';

	// Get current timezone setting
	$current_timezone = getCurrentTimezone($conn);

	// Handle form submission
	if(isset($_POST['update_timezone'])){
		$new_timezone = $_POST['timezone'];
		
		if(updateTimezoneSetting($conn, $new_timezone)){
			$_SESSION['success'] = 'Timezone updated successfully';
			$current_timezone = $new_timezone;
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}

	// Set timezone for display
	setTimezoneFromDatabase($conn);
	$current_time = date('Y-m-d H:i:s');
	$current_time_formatted = getCurrentTimeFormatted($conn);
	$timezone_name = getCurrentTimezoneName($conn);

	include 'includes/header.php';
?>

<body>
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Main content -->
  <div class="main-content">
    <!-- Content Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-0">System Settings</h1>
        <p class="text-muted mb-0">Configure system preferences and timezone</p>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible fade show'>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible fade show'>
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">
                <span class="material-icons me-2">schedule</span>
                Timezone Settings
              </h5>
            </div>
            <div class="card-body">
              <form method="POST">
                <div class="mb-3">
                  <label for="timezone" class="form-label">Select Timezone:</label>
                  <select class="form-select" name="timezone" id="timezone" required>
                            <option value="Asia/Manila" <?php echo ($current_timezone == 'Asia/Manila') ? 'selected' : ''; ?>>Asia/Manila (Philippines)</option>
                            <option value="Asia/Tokyo" <?php echo ($current_timezone == 'Asia/Tokyo') ? 'selected' : ''; ?>>Asia/Tokyo (Japan)</option>
                            <option value="Asia/Seoul" <?php echo ($current_timezone == 'Asia/Seoul') ? 'selected' : ''; ?>>Asia/Seoul (South Korea)</option>
                            <option value="Asia/Shanghai" <?php echo ($current_timezone == 'Asia/Shanghai') ? 'selected' : ''; ?>>Asia/Shanghai (China)</option>
                            <option value="Asia/Singapore" <?php echo ($current_timezone == 'Asia/Singapore') ? 'selected' : ''; ?>>Asia/Singapore</option>
                            <option value="Asia/Bangkok" <?php echo ($current_timezone == 'Asia/Bangkok') ? 'selected' : ''; ?>>Asia/Bangkok (Thailand)</option>
                            <option value="Asia/Kuala_Lumpur" <?php echo ($current_timezone == 'Asia/Kuala_Lumpur') ? 'selected' : ''; ?>>Asia/Kuala Lumpur (Malaysia)</option>
                            <option value="Asia/Jakarta" <?php echo ($current_timezone == 'Asia/Jakarta') ? 'selected' : ''; ?>>Asia/Jakarta (Indonesia)</option>
                            <option value="Asia/Ho_Chi_Minh" <?php echo ($current_timezone == 'Asia/Ho_Chi_Minh') ? 'selected' : ''; ?>>Asia/Ho Chi Minh (Vietnam)</option>
                            <option value="Asia/Dhaka" <?php echo ($current_timezone == 'Asia/Dhaka') ? 'selected' : ''; ?>>Asia/Dhaka (Bangladesh)</option>
                            <option value="Asia/Kolkata" <?php echo ($current_timezone == 'Asia/Kolkata') ? 'selected' : ''; ?>>Asia/Kolkata (India)</option>
                            <option value="Asia/Dubai" <?php echo ($current_timezone == 'Asia/Dubai') ? 'selected' : ''; ?>>Asia/Dubai (UAE)</option>
                            <option value="Europe/London" <?php echo ($current_timezone == 'Europe/London') ? 'selected' : ''; ?>>Europe/London (UK)</option>
                            <option value="Europe/Paris" <?php echo ($current_timezone == 'Europe/Paris') ? 'selected' : ''; ?>>Europe/Paris (France)</option>
                            <option value="Europe/Berlin" <?php echo ($current_timezone == 'Europe/Berlin') ? 'selected' : ''; ?>>Europe/Berlin (Germany)</option>
                            <option value="America/New_York" <?php echo ($current_timezone == 'America/New_York') ? 'selected' : ''; ?>>America/New York (USA)</option>
                            <option value="America/Los_Angeles" <?php echo ($current_timezone == 'America/Los_Angeles') ? 'selected' : ''; ?>>America/Los Angeles (USA)</option>
                            <option value="America/Toronto" <?php echo ($current_timezone == 'America/Toronto') ? 'selected' : ''; ?>>America/Toronto (Canada)</option>
                            <option value="Australia/Sydney" <?php echo ($current_timezone == 'Australia/Sydney') ? 'selected' : ''; ?>>Australia/Sydney</option>
                            <option value="Pacific/Auckland" <?php echo ($current_timezone == 'Pacific/Auckland') ? 'selected' : ''; ?>>Pacific/Auckland (New Zealand)</option>
                          </select>
                </div>
                <button type="submit" name="update_timezone" class="btn btn-primary d-flex align-items-center">
                  <span class="material-icons me-1">save</span>
                  Update Timezone
                </button>
              </form>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4">
          <div class="card mb-3">
            <div class="card-header">
              <h5 class="card-title mb-0">
                <span class="material-icons me-2">access_time</span>
                Current Time
              </h5>
            </div>
            <div class="card-body text-center">
              <h2 id="current-time" class="text-primary"><?php echo $current_time_formatted; ?></h2>
              <p class="text-muted">
                <strong>Timezone:</strong> <?php echo $timezone_name; ?><br>
                <strong>Date:</strong> <?php echo date('l, F j, Y'); ?><br>
                <strong>Time:</strong> <span id="live-time"><?php echo date('g:i:s A'); ?></span>
              </p>
            </div>
          </div>
          
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">
                <span class="material-icons me-2">info</span>
                System Information
              </h5>
            </div>
            <div class="card-body">
              <p><strong>Server Time:</strong> <?php echo $current_time; ?></p>
              <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
              <p><strong>Database:</strong> MySQL</p>
              <p><strong>System:</strong> PanpacificU Library Attendance System</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>
</body>
<?php include 'includes/scripts.php'; ?>

<script>
// Live clock update
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', {
        hour12: true,
        hour: 'numeric',
        minute: '2-digit',
        second: '2-digit'
    });
    document.getElementById('live-time').textContent = timeString;
}

// Update time every second
setInterval(updateTime, 1000);

// Update full date/time display every minute
function updateFullTime() {
    const now = new Date();
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    };
    const fullTimeString = now.toLocaleDateString('en-US', options);
    document.getElementById('current-time').textContent = fullTimeString;
}

// Update full time every minute
setInterval(updateFullTime, 60000);
</script>

</body>
</html> 