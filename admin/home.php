<?php include 'includes/session.php'; ?>
<?php 
  include '../timezone.php'; 
  include 'includes/timezone_helper.php';
  
  // Set timezone for display
  setTimezoneFromDatabase($conn);
  $current_timezone = getCurrentTimezone($conn);
  
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>
<?php include 'includes/header.php'; ?>
<body>
  	<?php include 'includes/navbar.php'; ?>
  	<?php include 'includes/menubar.php'; ?>
 
  <!-- Main content -->
  <div class="main-content">
    <!-- Content Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-0">Dashboard</h1>
        <p class="text-muted mb-0">Welcome to PanpacificU Library Admin Panel</p>
      </div>
      <div>
        <span id="dashboard-time" class="text-muted"></span>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
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
      <!-- Stats Cards -->
      <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stats-card">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <?php
                  $sql = "SELECT * FROM students";
                  $query = $conn->query($sql);
                  echo "<h3>".$query->num_rows."</h3>";
                ?>
                <p>Total Students</p>
              </div>
              <div class="ms-3">
                <span class="material-icons" style="font-size: 3rem; opacity: 0.3;">people</span>
              </div>
            </div>
            <a href="students.php" class="btn btn-light btn-sm mt-2">
              <span class="material-icons me-1">arrow_forward</span>
              View Details
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stats-card" style="background: linear-gradient(135deg, #34a853, #0f9d58);">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <?php
                  $sql = "SELECT * FROM students";
                  $query = $conn->query($sql);
                  $total = $query->num_rows;

                  $sql = "SELECT * FROM attendance";
                  $query = $conn->query($sql);
                  $early = $query->num_rows;
                  
                  if($total > 0) {
                      $percentage = ($early/$total)*100;
                      echo "<h3>".number_format($percentage, 2)."<sup style='font-size: 20px'>%</sup></h3>";
                  } else {
                      echo "<h3>0.00<sup style='font-size: 20px'>%</sup></h3>";
                  }
                ?>
                <p>Attendance Percentage</p>
              </div>
              <div class="ms-3">
                <span class="material-icons" style="font-size: 3rem; opacity: 0.3;">pie_chart</span>
              </div>
            </div>
            <a href="attendance.php" class="btn btn-light btn-sm mt-2">
              <span class="material-icons me-1">arrow_forward</span>
              View Details
            </a>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stats-card" style="background: linear-gradient(135deg, #ea4335, #d33b2c);">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <?php
                  $sql = "SELECT * FROM attendance WHERE date = '$today' AND status = 0";
                  $query = $conn->query($sql);
                  echo "<h3>".$query->num_rows."</h3>";
                ?>
                <p>Checked In Today</p>
              </div>
              <div class="ms-3">
                <span class="material-icons" style="font-size: 3rem; opacity: 0.3;">login</span>
              </div>
            </div>
            <a href="attendance.php" class="btn btn-light btn-sm mt-2">
              <span class="material-icons me-1">arrow_forward</span>
              View Details
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
          <div class="stats-card" style="background: linear-gradient(135deg, #fbbc05, #f9ab00);">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1">
                <?php
                  $sql = "SELECT * FROM attendance WHERE date = '$today' AND status = 1";
                  $query = $conn->query($sql);
                  echo "<h3>".$query->num_rows."</h3>";
                ?>
                <p>Checked Out Today</p>
              </div>
              <div class="ms-3">
                <span class="material-icons" style="font-size: 3rem; opacity: 0.3;">logout</span>
              </div>
            </div>
            <a href="attendance.php" class="btn btn-light btn-sm mt-2">
              <span class="material-icons me-1">arrow_forward</span>
              View Details
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">Monthly Attendance Report</h5>
              <form class="d-flex align-items-center">
                <label class="form-label me-2 mb-0">Select Year:</label>
                <select class="form-select form-select-sm" id="select_year" style="width: auto;">
                  <?php
                    for($i=2065; $i>=2015; $i--){
                      $selected = ($i==$year)?'selected':'';
                      echo "<option value='".$i."' ".$selected.">".$i."</option>";
                    }
                  ?>
                </select>
              </form>
            </div>
            <div class="card-body">
              <div class="chart-container" style="position: relative; height: 400px;">
                <canvas id="barChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  	<?php include 'includes/footer.php'; ?>
</body>

<!-- Chart Data -->
<?php
  $and = 'AND YEAR(date) = '.$year;
  $months = array();
  $ontime = array();
  $late = array();
  for( $m = 1; $m <= 12; $m++ ) {
    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 1 $and";
    $oquery = $conn->query($sql);
    array_push($ontime, $oquery->num_rows);

    $sql = "SELECT * FROM attendance WHERE MONTH(date) = '$m' AND status = 0 $and";
    $lquery = $conn->query($sql);
    array_push($late, $lquery->num_rows);

    $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
  }

  $months = json_encode($months);
  $late = json_encode($late);
  $ontime = json_encode($ontime);

?>
<!-- End Chart Data -->
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  const ctx = document.getElementById('barChart').getContext('2d');
  const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo $months; ?>,
      datasets: [
        {
          label: 'Checked In',
          data: <?php echo $late; ?>,
          backgroundColor: 'rgba(66, 133, 244, 0.8)',
          borderColor: 'rgba(66, 133, 244, 1)',
          borderWidth: 1
        },
        {
          label: 'Checked Out',
          data: <?php echo $ontime; ?>,
          backgroundColor: 'rgba(52, 168, 83, 0.8)',
          borderColor: 'rgba(52, 168, 83, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            color: 'rgba(0,0,0,0.05)'
          }
        },
        x: {
          grid: {
            color: 'rgba(0,0,0,0.05)'
          }
        }
      },
      plugins: {
        legend: {
          position: 'top',
        }
      }
    }
  });
});
</script>
<script>
$(function(){
  $('#select_year').change(function(){
    window.location.href = 'home.php?year='+$(this).val();
  });
});
</script>

<script>
// Live clock update for dashboard
function updateDashboardTime() {
    const now = new Date();
    const timeString = now.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });
    document.getElementById('dashboard-time').textContent = timeString;
}

// Update time every second
setInterval(updateDashboardTime, 1000);
</script>
</body>
</html>
