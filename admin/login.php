<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Use prepared statement to prevent SQL injection
		$sql = "SELECT * FROM admin WHERE username = ?";
		$stmt = $conn->prepare($sql);
		
		if (!$stmt) {
			$_SESSION['error'] = 'Database error: ' . $conn->error;
		} else {
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$result = $stmt->get_result();

			if($result->num_rows < 1){
				$_SESSION['error'] = 'Cannot find account with the username';
			}
			else{
				$row = $result->fetch_assoc();
				
				// Check if password matches
				if($password == $row['password']){
					$_SESSION['admin'] = $row['id'];
					$_SESSION['success'] = 'Login successful';
					
					// Handle remember me functionality
					if(isset($_POST['remember'])){
						setcookie('admin_remember', $row['id'], time() + (30 * 24 * 60 * 60), '/');
					}
					
					// Clear any previous errors
					unset($_SESSION['error']);
					
					header('location: home.php');
					exit();
				}
				else{
					$_SESSION['error'] = 'Incorrect password';
				}
			}
			$stmt->close();
		}
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: index.php');
	exit();
?>