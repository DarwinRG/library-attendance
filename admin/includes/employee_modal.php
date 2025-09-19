<!-- Add New Student Modal -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Add New Student</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="form-horizontal" method="POST" action="student_add.php">
        <div class="modal-body">
          <div class="mb-3">
            <label for="reference_number" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="reference_number" name="reference_number" required>
          </div>
          <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone">
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="program" class="form-label">Program</label>
            <input type="text" class="form-control" id="program" name="program" required>
          </div>
          <div class="mb-3">
            <label for="year_level" class="form-label">Year Level</label>
            <select class="form-select" id="year_level" name="year_level" required>
              <option value="">Select Year Level</option>
              <option value="1st Year">1st Year</option>
              <option value="2nd Year">2nd Year</option>
              <option value="3rd Year">3rd Year</option>
              <option value="4th Year">4th Year</option>
              <option value="5th Year">5th Year</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="edit_student" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editStudentModalLabel">Edit Student</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="form-horizontal" method="POST" action="student_edit.php">
        <div class="modal-body">
          <input type="hidden" class="studid" name="id">
          <div class="mb-3">
            <label for="edit_reference_number" class="form-label">Student ID</label>
            <input type="text" class="form-control" id="edit_reference_number" name="reference_number" required>
          </div>
          <div class="mb-3">
            <label for="edit_firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
          </div>
          <div class="mb-3">
            <label for="edit_lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
          </div>
          <div class="mb-3">
            <label for="edit_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="edit_email" name="email">
          </div>
          <div class="mb-3">
            <label for="edit_phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="edit_phone" name="phone">
          </div>
          <div class="mb-3">
            <label for="edit_address" class="form-label">Address</label>
            <textarea class="form-control" id="edit_address" name="address" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="edit_program" class="form-label">Program</label>
            <input type="text" class="form-control" id="edit_program" name="program" required>
          </div>
          <div class="mb-3">
            <label for="edit_year_level" class="form-label">Year Level</label>
            <select class="form-select" id="edit_year_level" name="year_level" required>
              <option value="">Select Year Level</option>
              <option value="1st Year">1st Year</option>
              <option value="2nd Year">2nd Year</option>
              <option value="3rd Year">3rd Year</option>
              <option value="4th Year">4th Year</option>
              <option value="5th Year">5th Year</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" name="edit">Update Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Student Modal -->
<div class="modal fade" id="delete_student" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Delete Student</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="form-horizontal" method="POST" action="student_delete.php">
        <div class="modal-body">
          <input type="hidden" class="studid" name="id">
          <div class="text-center">
            <p>Are you sure you want to delete this student?</p>
            <h2 class="bold del_student_name"></h2>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
