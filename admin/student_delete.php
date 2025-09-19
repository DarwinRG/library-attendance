<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];

		// Check if student has attendance records
		$sql = "SELECT COUNT(*) as count FROM attendance WHERE reference_number = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		
		if($row['count'] > 0){
			$_SESSION['error'] = 'Cannot delete student with existing attendance records';
		} else {
			$sql = "DELETE FROM students WHERE id = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $id);
			
			if($stmt->execute()){
				$_SESSION['success'] = 'Student deleted successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Select student to delete first';
	}

	header('location:students.php');
?>
