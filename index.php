<?php session_start(); ?>
<?php include 'header.php'; ?>
<body>
<div class="container">
    <div class="admin-button">
        <a href="admin/index.php" class="btn-admin">
            <span class="material-icons">admin_panel_settings</span>
            <span class="admin-text">Admin</span>
        </a>
    </div>
    
    <div class="logo">
        <img src="images/panpacificu-logo.png" alt="PanpacificU Logo">
    </div>
    
    <div class="title">
        <h1>Library Attendance System</h1>
        <p>Panpacific University</p>
    </div>

    <form id="attendance">
        <div class="form-group">
            <select class="form-control" name="status" id="status">
                <option value="in">📥 Check In</option>
                <option value="out">📤 Check Out</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="text" class="form-control" id="employee" name="employee" placeholder="Enter Student ID" required>
        </div>
        
        <div class="form-group" id="purposeDiv" style="display: none;">
            <select class="form-control" name="purpose" id="purpose">
                <option value="">Select Purpose</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">
            <span class="material-icons">login</span>
            <span id="btnText">Check In</span>
        </button>
    </form>
    
    <div class="loading">
        <div class="spinner"></div>
    </div>
    
    <div class="alert alert-success" style="display:none;">
        <span class="material-icons">check_circle</span>
        <span class="message"></span>
    </div>
    
    <div class="alert alert-danger" style="display:none;">
        <span class="material-icons">error</span>
        <span class="message"></span>
    </div>

    <div class="datetime">
        <p id="date"></p>
        <p id="time"></p>
    </div>
</div>
	
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  // Load purposes when page loads
  loadPurposes();

  // Update button text based on status
  function updateButtonText() {
    var status = $('#status').val();
    var btnText = status === 'in' ? 'Check In' : 'Check Out';
    var icon = status === 'in' ? 'login' : 'logout';
    $('#btnText').text(btnText);
    $('.btn .material-icons').text(icon);
  }

  // Show purpose dropdown when student ID is entered and status is 'in'
  $('#employee').on('input keyup', function(){
    var status = $('#status').val();
    if($(this).val().length > 0 && status === 'in'){
      $('#purposeDiv').slideDown(300);
    } else {
      $('#purposeDiv').slideUp(300);
      $('#purpose').val('');
    }
  });

  // Show/hide purpose dropdown when status changes
  $('#status').on('change', function(){
    updateButtonText();
    var status = $(this).val();
    if(status === 'in' && $('#employee').val().length > 0){
      $('#purposeDiv').slideDown(300);
    } else {
      $('#purposeDiv').slideUp(300);
      $('#purpose').val('');
    }
  });

  $('#attendance').submit(function(e){
    e.preventDefault();
    
    // Show loading
    $('.loading').show();
    $('.alert').hide();
    
    // Validate form based on status
    var status = $('#status').val();
    var employee = $('#employee').val();
    var purpose = $('#purpose').val();
    
    if(!employee){
      $('.loading').hide();
      $('.alert-danger .message').text('Please enter Student ID');
      $('.alert-danger').show();
      return;
    }
    
    if(status === 'in' && !purpose){
      $('.loading').hide();
      $('.alert-danger .message').text('Please select a purpose for check in');
      $('.alert-danger').show();
      return;
    }
    
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        $('.loading').hide();
        if(response.error){
          $('.alert-danger .message').html(response.message);
          $('.alert-danger').show();
        }
        else{
          $('.alert-success .message').html(response.message);
          $('.alert-success').show();
        }
        
        // Clear form
        $('#employee').val('');
        $('#purpose').val('');
        $('#purposeDiv').slideUp(300);
        
        // Auto-hide alerts after 3 seconds
        setTimeout(function(){
          $('.alert').fadeOut();
        }, 3000);
      },
      error: function(){
        $('.loading').hide();
        $('.alert-danger .message').text('Connection error. Please try again.');
        $('.alert-danger').show();
      }
    });
  });

  function loadPurposes(){
    $.ajax({
      type: 'GET',
      url: 'get_purposes.php',
      dataType: 'json',
      success: function(response){
        var options = '<option value="">SELECT PURPOSE</option>';
        $.each(response, function(index, purpose){
          options += '<option value="' + purpose.id + '">' + purpose.name + '</option>';
        });
        $('#purpose').html(options);
      },
      error: function(xhr, status, error) {
        $('#purpose').html('<option value="">Error loading purposes</option>');
      }
    });
  }
    
});

</script>
<script type="text/javascript">
  function displayDiv(id, elementValue) {
    document.getElementById(id).style.display = elementValue.value === 'in' ? 'block' : 'none'
  }
</script>
<script type="text/javascript">
    $(function() {
       $( "#employee" ).autocomplete({
         source: 'search.php',
       });
    });
</script>
</body>
</html>