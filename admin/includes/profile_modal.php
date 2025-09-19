<!-- Admin Profile Modal -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          	<div class="modal-header">
            	<h5 class="modal-title" id="profileModalLabel">
                  <span class="material-icons me-2">person</span>
                  Admin Profile
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          	</div>
          	<div class="modal-body">
            	<form method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
                      </div>
                    </div>
                  </div>
                  
                  <div class="mb-3">
                    <label for="photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <div class="form-text">Leave blank to keep current photo</div>
                  </div>
                  
                  <hr>
                  
                  <div class="mb-3">
                    <label for="curr_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="Enter current password to save changes" required>
                    <div class="form-text">Required to save any changes</div>
                  </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  <span class="material-icons me-1">close</span>
                  Cancel
                </button>
            	<button type="submit" class="btn btn-primary" name="save">
                  <span class="material-icons me-1">save</span>
                  Save Changes
                </button>
            	</form>
          	</div>
        </div>
    </div>
</div>