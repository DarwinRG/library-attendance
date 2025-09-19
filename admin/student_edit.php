<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$reference_number = $_POST['reference_number'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$program = $_POST['program'];
		$year_level = $_POST['year_level'];

		// Check if student ID already exists for another student
		$sql = "SELECT id FROM students WHERE reference_number = ? AND id != ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("si", $reference_number, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows > 0){
			$_SESSION['error'] = 'Student ID already exists for another student';
		} else {
			$sql = "UPDATE students SET reference_number = ?, firstname = ?, lastname = ?, email = ?, phone = ?, address = ?, program = ?, year_level = ? WHERE id = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssssssssi", $reference_number, $firstname, $lastname, $email, $phone, $address, $program, $year_level, $id);
			
			if($stmt->execute()){
				$_SESSION['success'] = 'Student updated successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:students.php');
?>
