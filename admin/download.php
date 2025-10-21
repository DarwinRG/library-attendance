<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <style>
  /* Scoped fix: prevent sidebar overlap on this page */
  @media (min-width: 768px){
    .content-wrapper { margin-left: 280px; padding: 30px; }
  }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bulk Import Students
      </h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="students.php">Students</a></li>
          <li class="breadcrumb-item active" aria-current="page">Bulk Import</li>
        </ol>
      </nav>
    </section>
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
      <div class="panel-body">
            <div class="table-responsive">
                               
            <div class="col-md-6" id="form-login">
                <form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Import Bulk Students</legend>
						<div class="control-group">
							
								<label>CSV/Excel File:</label>
							
                            <div class="controls">
                                <input type="file" name="file" id="file" class="input-large" accept=".csv,.xlsx">
                                <p class="help-block" style="margin-top:6px;">
                                Supported formats: CSV (.csv) or Excel (.xlsx)<br>
                                <strong>Note:</strong> If Excel import fails, use our <a href="excel_to_csv_converter.html" target="_blank">Excel to CSV Converter</a><br>
                                CSV/Excel columns (either format):<br>
                                1) ID NUMBER, FIRST NAME, LAST NAME, EMAIL, PHONE, PROGRAM, YEAR LEVEL<br>
                                2) ID NUMBER, FIRST NAME, LAST NAME, EMAIL, PROGRAM, YEAR LEVEL<br>
                                3) ID NUMBER, FIRST NAME, LAST NAME, EMAIL, PHONE, ADDRESS, PROGRAM, YEAR LEVEL
                                </p>
                            </div>
						</div>
						<br/>	
						<div class="control-group">
                            <div class="controls">
                            <button type="submit" id="import" name="import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                            </div>
						</div>
					</fieldset>
				</form>
			</div>

		

								
								
								
								
								
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
