<?php
	$conn = new mysqli('db', 'root', 'root', 'library');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>