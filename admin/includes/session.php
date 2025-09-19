<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include 'includes/conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM admin WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $_SESSION['admin']);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	$stmt->close();
	
?>