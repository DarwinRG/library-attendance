<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Students</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_add.php" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="reference_number" class="col-sm-3 control-label">Student ID</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="reference_number" name="reference_number" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mname" class="col-sm-3 control-label">Middle Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mname" name="mname">
                    </div>
                </div>
                <div class="form-group">
                  	<label for="lastname" class="col-sm-3 control-label">Lastname</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="lastname" name="lastname" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="email" class="col-sm-3 control-label">Email</label>

                  	<div class="col-sm-9">
                      <input type="email" class="form-control" id="email" name="email">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="phone" class="col-sm-3 control-label">Phone Number</label>

                  	<div class="col-sm-9">
                      <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="address" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="program" class="col-sm-3 control-label">Program</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="program" name="program" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="year_level" class="col-sm-3 control-label">Year Level</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="year_level" name="year_level" required>
                    </div>
                </div>
                
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="reference_number"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_edit.php">
            		<input type="hidden" class="empid" name="id">
                 <div class="form-group">
                    <label for="edit_reference_number" class="col-sm-3 control-label">Student ID</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_reference_number" name="reference_number" required>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="edit_firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_mname" class="col-sm-3 control-label">Middle Name</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_mname" name="mname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_phone" class="col-sm-3 control-label">Phone Number</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_phone" name="phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_address" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_program" class="col-sm-3 control-label">Program</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_program" name="program">
                    </div>
                </div>
                <div class="form-group">
                    <label for="edit_year_level" class="col-sm-3 control-label">Year Level</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_year_level" name="year_level">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="reference_number"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="employee_delete.php">
            		<input type="hidden" class="empid" name="id">
            		<div class="text-center">
	                	<p>DELETE STUDENT</p>
	                	<h2 class="bold del_student_name"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <!-- <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="employee_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div> -->
</div>    
</div>    