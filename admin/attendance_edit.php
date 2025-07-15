<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['edit_date'];
		$time_in = $_POST['edit_time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = !empty($_POST['edit_time_out']) ? date('H:i:s', strtotime($_POST['edit_time_out'])) : NULL;

		$sql = "UPDATE attendance SET date = ?, time_in = ?, time_out = ? WHERE id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sssi", $date, $time_in, $time_out, $id);
		
		if($stmt->execute()){
			$_SESSION['success'] = 'Attendance updated successfully';

			// Calculate hours only if time_out is not NULL
			if($time_out !== NULL){
				$sql = "SELECT * FROM attendance WHERE id = ?";
				$stmt2 = $conn->prepare($sql);
				$stmt2->bind_param("i", $id);
				$stmt2->execute();
				$result = $stmt2->get_result();
				$row = $result->fetch_assoc();
				$stmt2->close();

				$time_in_obj = new DateTime($time_in);
				$time_out_obj = new DateTime($time_out);
				$interval = $time_in_obj->diff($time_out_obj);
				$hrs = $interval->format('%h');
				$mins = $interval->format('%i');
				$mins = $mins/60;
				$int = $hrs + $mins;
				if($int > 4){
					$int = $int - 1;
				}

				$logstatus = 1; // Checked out
				$sql = "UPDATE attendance SET num_hr = ?, status = ? WHERE id = ?";
				$stmt3 = $conn->prepare($sql);
				$stmt3->bind_param("dii", $int, $logstatus, $id);
				$stmt3->execute();
				$stmt3->close();
			} else {
				// If no time_out, set status to 0 (checked in) and num_hr to NULL
				$logstatus = 0;
				$sql = "UPDATE attendance SET num_hr = NULL, status = ? WHERE id = ?";
				$stmt3 = $conn->prepare($sql);
				$stmt3->bind_param("ii", $logstatus, $id);
				$stmt3->execute();
				$stmt3->close();
			}
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance.php');

?>