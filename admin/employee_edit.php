<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$reference_number = $_POST['reference_number'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$mname = !empty($_POST['mname']) ? $_POST['mname'] : NULL;
		$email = !empty($_POST['email']) ? $_POST['email'] : NULL;
		$phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
		$address = !empty($_POST['address']) ? $_POST['address'] : NULL;
		$program = $_POST['program'];
		$year_level = $_POST['year_level'];

		$sql = "UPDATE students SET reference_number = ?, firstname = ?, mname = ?, lastname = ?, email = ?, phone = ?, address = ?, program = ?, year_level = ? WHERE id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sssssssssi", $reference_number, $firstname, $mname, $lastname, $email, $phone, $address, $program, $year_level, $id);
		
		if($stmt->execute()){
			$_SESSION['success'] = 'Student updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: students.php');
?>