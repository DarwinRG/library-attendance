<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<!-- Bootstrap Daterangepicker -->
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Bootstrap Timepicker -->
<script src="../plugins/timepicker/bootstrap-timepicker.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTables
    $('#example1').DataTable({
        responsive: true,
        pageLength: 25,
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        }
    });
    
    // Sidebar toggle functionality
    $('#sidebarToggle').click(function() {
        $('#sidebar').toggleClass('collapsed');
        $('.main-content').toggleClass('expanded');
        $('.footer').toggleClass('expanded');
        $('.navbar').toggleClass('expanded');
        
        // Save sidebar state to localStorage
        var isCollapsed = $('#sidebar').hasClass('collapsed');
        localStorage.setItem('sidebarCollapsed', isCollapsed);
    });
    
    // Restore sidebar state from localStorage
    var sidebarCollapsed = localStorage.getItem('sidebarCollapsed');
    if (sidebarCollapsed === 'true') {
        $('#sidebar').addClass('collapsed');
        $('.main-content').addClass('expanded');
        $('.footer').addClass('expanded');
        $('.navbar').addClass('expanded');
    }
    
    // Close sidebar when clicking outside on mobile
    $(document).click(function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('#sidebar, #sidebarToggle').length) {
                $('#sidebar').removeClass('show');
            }
        }
    });
    
    // Handle window resize
    $(window).resize(function() {
        if ($(window).width() > 768) {
            $('#sidebar').removeClass('show');
        }
    });
    
    // Date picker initialization
    $('#datepicker_add, #datepicker_edit').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    });
    
    // Time picker initialization
    $('.timepicker').timepicker({
        showInputs: false,
        showMeridian: true,
        defaultTime: false
    });
    
    // Date range picker initialization
    $('#reservation').daterangepicker({
        startDate: moment().subtract(30, 'days'),
        endDate: moment(),
        autoUpdateInput: false,
        locale: {
            format: 'MM/DD/YYYY'
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, function(start, end, label) {
        $('#reservation').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);
});
</script>

<script>
// Live clock update for navbar
function updateNavbarTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
    document.getElementById('navbar-time').textContent = timeString;
}

// Update navbar time every second
setInterval(updateNavbarTime, 1000);
</script>
