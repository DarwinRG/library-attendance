<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<h4 class="modal-title"><b>Add New Purpose</b></h4>
            	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="purpose_add.php">
          		  <div class="form-group">
                  	<label for="name" class="col-sm-3 control-label">Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="name" name="name" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="description" class="col-sm-3 control-label">Description</label>

                  	<div class="col-sm-9">
                    	<textarea class="form-control" id="description" name="description" rows="3"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="is_active" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="is_active" name="is_active" required>
                    		<option value="1">Active</option>
                    		<option value="0">Inactive</option>
                    	</select>
                  	</div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            	<button type="submit" class="btn btn-primary" name="add">Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit_purpose">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<h4 class="modal-title"><b>Edit Purpose</b></h4>
            	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          	</div>
          	<form class="form-horizontal" method="POST" action="purpose_edit.php">
          		<div class="modal-body">
            		<input type="hidden" id="purposeid" name="id">
          		  <div class="form-group">
                  	<label for="edit_name" class="col-sm-3 control-label">Name</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="edit_name" name="name" required>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_description" class="col-sm-3 control-label">Description</label>

                  	<div class="col-sm-9">
                    	<textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_is_active" class="col-sm-3 control-label">Status</label>

                  	<div class="col-sm-9">
                    	<select class="form-control" id="edit_is_active" name="is_active" required>
                    		<option value="1">Active</option>
                    		<option value="0">Inactive</option>
                    	</select>
                  	</div>
                </div>
          		</div>
          		<div class="modal-footer">
            		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            		<button type="submit" class="btn btn-success" name="edit">Update</button>
          		</div>
          	</form>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete_purpose">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<h4 class="modal-title"><b>Deleting...</b></h4>
            	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          	</div>
          	<form class="form-horizontal" method="POST" action="purpose_delete.php">
          		<div class="modal-body">
            		<input type="hidden" id="del_purposeid" name="id">
            		<div class="text-center">
	                	<p>DELETE PURPOSE</p>
	                    <h2 class="bold del_purpose_name"></h2>
	                </div>
          		</div>
          		<div class="modal-footer">
            		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            		<button type="submit" class="btn btn-danger" name="delete">Delete</button>
          		</div>
          	</form>
        </div>
    </div>
</div>
