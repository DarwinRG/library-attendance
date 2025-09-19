<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$reference_number = $_POST['reference_number'];
		$date = $_POST['date'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = !empty($_POST['time_out']) ? date('H:i:s', strtotime($_POST['time_out'])) : NULL;

		// Check if student exists
		$sql = "SELECT id FROM students WHERE reference_number = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $reference_number);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows == 0){
			$_SESSION['error'] = 'Student ID not found';
		} else {
			$student = $result->fetch_assoc();
			$student_id = $student['id'];

			// Check if attendance already exists for this student on this date
			$sql = "SELECT id FROM attendance WHERE reference_number = ? AND date = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("is", $student_id, $date);
			$stmt->execute();
			$result = $stmt->get_result();
			
			if($result->num_rows > 0){
				$_SESSION['error'] = 'Attendance already exists for this student on this date';
			} else {
				$sql = "INSERT INTO attendance (reference_number, date, time_in, time_out) VALUES (?, ?, ?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("isss", $student_id, $date, $time_in, $time_out);
				
				if($stmt->execute()){
					$_SESSION['success'] = 'Attendance added successfully';
				} else {
					$_SESSION['error'] = $conn->error;
				}
			}
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location:attendance.php');
?>
