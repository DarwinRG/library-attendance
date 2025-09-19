<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, attendance.id as attid FROM attendance LEFT JOIN students ON students.id=attendance.reference_number WHERE attendance.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		// Format time for timepicker (convert from 24-hour to 12-hour format)
		if($row['time_in']) {
			$row['time_in'] = date('h:i A', strtotime($row['time_in']));
		}
		if($row['time_out']) {
			$row['time_out'] = date('h:i A', strtotime($row['time_out']));
		}

		echo json_encode($row);
	}
?>