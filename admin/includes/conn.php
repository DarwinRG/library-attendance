<?php
	$conn = new mysqli('localhost', 'library', 'Baseplate11', 'library');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>