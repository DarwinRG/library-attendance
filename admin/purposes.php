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
        <h1 class="h3 mb-0">Purposes Management</h1>
        <p class="text-muted mb-0">Manage library visit purposes</p>
      </div>
      <div>
        <a href="#addnew" data-bs-toggle="modal" class="btn btn-primary d-flex align-items-center">
          <span class="material-icons me-1">add</span>
          Add New Purpose
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
              <h5 class="card-title mb-0">Purposes List</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Created</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM purposes ORDER BY name ASC";
                      $query = $conn->query($sql);
                      while($row = $query->fetch_assoc()){
                        $status = $row['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
                        echo "
                          <tr>
                            <td><strong>".$row['name']."</strong></td>
                            <td>".$row['description']."</td>
                            <td>".$status."</td>
                            <td>".date('M d, Y', strtotime($row['created_on']))."</td>
                            <td>
                              <button class='btn btn-primary btn-sm edit' data-id='".$row['id']."'>
                                <span class='material-icons'>edit</span>
                              </button>
                              <button class='btn btn-danger btn-sm delete' data-id='".$row['id']."'>
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
  <?php include 'includes/purpose_modal.php'; ?>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id, function() {
      var editModal = new bootstrap.Modal(document.getElementById('edit_purpose'));
      editModal.show();
    });
  });

  $('.delete').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
    var deleteModal = new bootstrap.Modal(document.getElementById('delete_purpose'));
    deleteModal.show();
  });
});

function getRow(id, callback){
  $.ajax({
    type: 'POST',
    url: 'purpose_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      if(response.error) {
        alert('Error: ' + response.error);
        return;
      }
      
      $('#purposeid').val(response.id);
      $('#edit_name').val(response.name);
      $('#edit_description').val(response.description);
      $('#edit_is_active').val(response.is_active);
      $('#del_purposeid').val(response.id);
      $('#del_purpose_name').html(response.name);
      if(callback) callback();
    },
    error: function(xhr, status, error) {
      alert('Error loading purpose data. Please try again.');
    }
  });
}
</script>
</body>
</html>
