<?php
	include 'includes/session.php';

	function generateCSVData($from, $to, $conn){
		$data = array();
		
		$sql = "SELECT attendance.*, students.reference_number AS empid, students.firstname, students.lastname, students.program, attendance.id AS attid, purposes.name AS purpose_name FROM attendance LEFT JOIN students ON students.id=attendance.reference_number LEFT JOIN purposes ON purposes.id=attendance.purpose_id WHERE attendance.date BETWEEN '$from' AND '$to' ORDER BY attendance.date ASC, attendance.time_in ASC";

		$query = $conn->query($sql);
		if (!$query) {
			die('SQL Error: ' . $conn->error . '<br>Query: ' . $sql);
		}
		
		while($row = $query->fetch_assoc()){
			$data[] = array(
				'Date' => date('M d, Y', strtotime($row['date'])),
				'Full Name' => $row['firstname'].' '.$row['lastname'],
				'Student ID' => $row['empid'],
				'Program' => $row['program'] ? $row['program'] : '-',
				'Time In' => date('h:i A', strtotime($row['time_in'])),
				'Time Out' => $row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : '-',
				'Purpose' => $row['purpose_name'] ? $row['purpose_name'] : '-'
			);
		}

		return $data;
	}
		
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	$data = generateCSVData($from, $to, $conn);
	
	// Set headers for CSV download
	$filename = 'attendance_report_' . $from . '_to_' . $to . '.csv';
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Expires: 0');

	// Create file pointer
	$output = fopen('php://output', 'w');

	// Add BOM for UTF-8
	fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

	// Add CSV headers
	fputcsv($output, array('Date', 'Full Name', 'Student ID', 'Program', 'Time In', 'Time Out', 'Purpose'));

	// Add data rows
	foreach($data as $row) {
		fputcsv($output, $row);
	}

	fclose($output);
	exit;
?>
