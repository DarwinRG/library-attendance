<?php
	include 'includes/session.php';

	if(isset($_POST['import'])){
		$filename = $_FILES['file']['name'];
		$filetmp = $_FILES['file']['tmp_name'];
		$filetype = $_FILES['file']['type'];
		$filesize = $_FILES['file']['size'];

		$allowed = array('csv');
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		if(in_array($ext, $allowed)){
			if(is_uploaded_file($_FILES['file']['tmp_name'])){
				$csvfile = fopen($_FILES['file']['tmp_name'], 'r');
				fgetcsv($csvfile);
				while(($line = fgetcsv($csvfile)) !== FALSE){
					$reference_number = $line[0];
					$firstname = $line[1];
					$lastname = $line[2];
					$mname = !empty($line[3]) ? $line[3] : NULL;
					$email = !empty($line[4]) ? $line[4] : NULL;
					$phone = !empty($line[5]) ? $line[5] : NULL;
					$address = !empty($line[6]) ? $line[6] : NULL;
					$program = $line[7];
					$year_level = $line[8];

					$sql = "INSERT INTO students (reference_number, firstname, mname, lastname, email, phone, address, program, year_level, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("sssssssss", $reference_number, $firstname, $mname, $lastname, $email, $phone, $address, $program, $year_level);
					$stmt->execute();
					$stmt->close();
				}
				fclose($csvfile);
				$_SESSION['success'] = 'Students imported successfully';
			}
		}
		else{
			$_SESSION['error'] = 'Please upload CSV file';
		}
	}
	else{
		$_SESSION['error'] = 'Please select file to import';
	}

	header('location: students.php');
?>