<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$reference_number = $_POST['reference_number'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$mname = !empty($_POST['mname']) ? $_POST['mname'] : NULL;
		$email = !empty($_POST['email']) ? $_POST['email'] : NULL;
		$phone = !empty($_POST['phone']) ? $_POST['phone'] : NULL;
		$address = !empty($_POST['address']) ? $_POST['address'] : NULL;
		$program = $_POST['program'];
		$year_level = $_POST['year_level'];

		$sql = "INSERT INTO students (reference_number, firstname, mname, lastname, email, phone, address, program, year_level, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sssssssss", $reference_number, $firstname, $mname, $lastname, $email, $phone, $address, $program, $year_level);
		
		if($stmt->execute()){
			$_SESSION['success'] = 'Student added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: students.php');
?>