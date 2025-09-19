<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body>
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Main content -->
  <div class="main-content">
    <!-- Content Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h3 mb-0">Students Management</h1>
        <p class="text-muted mb-0">Manage student information and records</p>
      </div>
      <div class="d-flex gap-2">
        <a href="#addnew" data-bs-toggle="modal" class="btn btn-primary d-flex align-items-center">
          <span class="material-icons me-1">add</span>
          Add New Student
        </a>
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
              <h5 class="card-title mb-0">Students List</h5>
              <div class="d-flex gap-2">
                <a href="download.php" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                  <span class="material-icons me-1">upload</span>
                  Bulk Import
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Program</th>
                      <th>Year Level</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM students";
                      $query = $conn->query($sql);
                      while($row = $query->fetch_assoc()){
                        ?>
                          <tr>
                            <td><strong><?php echo $row['reference_number']; ?></strong></td>
                            <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                            <td><?php echo $row['email'] ? $row['email'] : '-'; ?></td>
                            <td><?php echo $row['phone'] ? $row['phone'] : '-'; ?></td>
                            <td><?php echo $row['address'] ? $row['address'] : '-'; ?></td>
                            <td><span class="badge bg-info"><?php echo $row['program']; ?></span></td>
                            <td><span class="badge bg-secondary"><?php echo $row['year_level']; ?></span></td>
                            <td>
                              <button class="btn btn-primary btn-sm edit" data-id="<?php echo $row['id']; ?>">
                                <span class="material-icons">edit</span>
                              </button>
                              <button class="btn btn-danger btn-sm delete" data-id="<?php echo $row['id']; ?>">
                                <span class="material-icons">delete</span>
                              </button>
                            </td>
                          </tr>
                        <?php
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
  <?php include 'includes/employee_modal.php'; ?>
<?php include 'includes/scripts.php'; ?>
<script>
$(document).ready(function(){
  
  $('.edit').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    
    var modalElement = document.getElementById('edit_student');
    
    if (!modalElement) {
      alert('Modal element not found!');
      return;
    }
    
    getRow(id, function() {
      try {
        var editModal = new bootstrap.Modal(modalElement);
        editModal.show();
      } catch (error) {
        alert('Error showing modal: ' + error.message);
      }
    });
  });

  $('.delete').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    var deleteModal = new bootstrap.Modal(document.getElementById('delete_student'));
    deleteModal.show();
  });

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id, callback){
  $.ajax({
    type: 'POST',
    url: 'employee_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      if(response.error) {
        alert('Error: ' + response.error);
        return;
      }
      
      $('.studid').val(response.id);
      $('.reference_number').html(response.reference_number);
      $('.del_student_name').html(response.firstname+' '+response.lastname);
      $('#student_name').html(response.firstname+' '+response.lastname);
      $('#edit_reference_number').val(response.reference_number);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      // $('#edit_mname').val(response.mname || ''); // Middle name field not present in modal
      $('#edit_email').val(response.email || '');
      $('#edit_phone').val(response.phone || '');
      $('#edit_address').val(response.address || '');
      $('#edit_program').val(response.program);
      $('#edit_year_level').val(response.year_level);
      if(callback) callback();
    },
    error: function(xhr, status, error) {
      alert('Error loading student data. Please try again.');
    }
  });
}
</script>
</body>
</html>
