<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$reference_number = $_POST['reference_number'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$program = $_POST['program'];
		$year_level = $_POST['year_level'];

		// Check if student ID already exists
		$sql = "SELECT id FROM students WHERE reference_number = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $reference_number);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows > 0){
			$_SESSION['error'] = 'Student ID already exists';
		} else {
			$sql = "INSERT INTO students (reference_number, firstname, lastname, email, phone, address, program, year_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssssssss", $reference_number, $firstname, $lastname, $email, $phone, $address, $program, $year_level);
			
			if($stmt->execute()){
				$_SESSION['success'] = 'Student added successfully';
			} else {
				$_SESSION['error'] = $conn->error;
			}
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location:students.php');
?>
