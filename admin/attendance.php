<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body>
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <?php
    include '../timezone.php';
    
    // Handle date range from URL parameter
    if(isset($_GET['range'])){
      $range = $_GET['range'];
      $ex = explode(' - ', $range);
      $range_from = $ex[0];
      $range_to = $ex[1];
    } else {
      $range_to = date('m/d/Y');
      $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
    }
  ?>

  <!-- Main content -->
  <div class="main-content">
    <!-- Content Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-0">Attendance Management</h1>
        <p class="text-muted mb-0">View and manage student attendance records</p>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              ".$_SESSION['error']."
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
              ".$_SESSION['success']."
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">Attendance List</h5>
              <div class="d-flex align-items-center gap-2">
                <form method="POST" class="d-flex align-items-center" id="payForm">
                  <div class="input-group me-2" style="min-width: 300px;">
                    <span class="input-group-text bg-white border-end-0">
                      <span class="material-icons text-muted">date_range</span>
                    </span>
                    <input type="text" class="form-control border-start-0" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>" placeholder="Select date range">
                  </div>
                  <select class="form-select me-2" name="export_format" id="export_format" style="width: auto;">
                    <option value="pdf">PDF</option>
                    <option value="csv">CSV</option>
                    <option value="excel">Excel</option>
                  </select>
                  <button type="button" class="btn btn-success btn-sm d-flex align-items-center" id="print_attend">
                    <span class="material-icons me-1">download</span>
                    Export Report
                  </button>
                </form>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Student ID</th>
                      <th>Full Name</th>
                      <th>Program</th>
                      <th>Time In</th>
                      <th>Time Out</th>
                      <th>Purpose</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      // Convert date range to proper format for SQL
                      $from_date = date('Y-m-d', strtotime($range_from));
                      $to_date = date('Y-m-d', strtotime($range_to));
                      
                      $sql = "SELECT *, students.reference_number AS empid, students.program, attendance.id AS attid, purposes.name AS purpose_name FROM attendance LEFT JOIN students ON students.id=attendance.reference_number LEFT JOIN purposes ON purposes.id=attendance.purpose_id WHERE attendance.date BETWEEN '$from_date' AND '$to_date' ORDER BY attendance.date DESC, attendance.time_in DESC";
                      $query = $conn->query($sql);
                      while($row = $query->fetch_assoc()){
                        $status = ($row['status']) ? '<span class="badge bg-warning">Checked Out</span>' : '<span class="badge bg-success">Checked In</span>';
                        echo "
                          <tr>
                            <td>".date('M d, Y', strtotime($row['date']))."</td>
                            <td>".$row['empid']."</td>
                            <td>".$row['firstname'].' '.$row['lastname']."</td>
                            <td>".($row['program'] ? $row['program'] : '-')."</td>
                            <td>".date('h:i A', strtotime($row['time_in']))."</td>
                            <td>".($row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : '-')."</td>
                            <td>".($row['purpose_name'] ? $row['purpose_name'] : '-')."</td>
                            <td>".$status."</td>
                            <td>
                              <button class='btn btn-primary btn-sm edit' data-id='".$row['attid']."'>
                                <span class='material-icons'>edit</span>
                              </button>
                              <button class='btn btn-danger btn-sm delete' data-id='".$row['attid']."'>
                                <span class='material-icons'>delete</span>
                              </button>
                            </td>
                          </tr>
                        ";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
</body>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    var editModal = new bootstrap.Modal(document.getElementById('edit_attendance'));
    editModal.show();
  });

  $('.delete').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    var deleteModal = new bootstrap.Modal(document.getElementById('delete_attendance'));
    deleteModal.show();
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').val(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out || '');
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    },
    error: function(xhr, status, error) {
      alert('Error loading attendance data. Please try again.');
    }
  });
}

$("#reservation").on('apply.daterangepicker', function(ev, picker){
    var range = encodeURI($(this).val());
    window.location = 'attendance.php?range='+range;
});

  $('#print_attend').click(function(e){
    e.preventDefault();
    var exportFormat = $('#export_format').val();
    
    if(exportFormat === 'pdf') {
      $('#payForm').attr('action', 'attendance_generate.php');
    } else if(exportFormat === 'csv') {
      $('#payForm').attr('action', 'attendance_export_csv.php');
    } else if(exportFormat === 'excel') {
      $('#payForm').attr('action', 'attendance_export_excel.php');
    }
    
    $('#payForm').submit();
  });
</script>
</body>
</html>
