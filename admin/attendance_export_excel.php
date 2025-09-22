<?php
	include 'includes/session.php';

	function generateExcelData($from, $to, $conn){
		$data = array();
		
		$sql = "SELECT attendance.*, students.reference_number AS empid, students.firstname, students.lastname, students.program, attendance.id AS attid, purposes.name AS purpose_name FROM attendance LEFT JOIN students ON students.id=attendance.reference_number LEFT JOIN purposes ON purposes.id=attendance.purpose_id WHERE attendance.date BETWEEN '$from' AND '$to' ORDER BY attendance.date ASC, attendance.time_in ASC";

		$query = $conn->query($sql);
		if (!$query) {
			die('SQL Error: ' . $conn->error . '<br>Query: ' . $sql);
		}
		
		while($row = $query->fetch_assoc()){
			$data[] = array(
				date('M d, Y', strtotime($row['date'])),
				$row['firstname'].' '.$row['lastname'],
				$row['empid'],
				$row['program'] ? $row['program'] : '-',
				date('h:i A', strtotime($row['time_in'])),
				$row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : '-',
				$row['purpose_name'] ? $row['purpose_name'] : '-'
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

	$data = generateExcelData($from, $to, $conn);
	
	// Set headers for Excel download
	$filename = 'attendance_report_' . $from . '_to_' . $to . '.xls';
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Expires: 0');

	// Start Excel file
	echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">';
	echo '<head>';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	echo '<!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>Attendance Report</x:Name><x:WorksheetOptions><x:DefaultRowHeight>285</x:DefaultRowHeight></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->';
	echo '</head>';
	echo '<body>';
	
	// Add title
	echo '<h2>PanpacificU Library Attendance Sheet</h2>';
	echo '<h4>' . $from_title . ' - ' . $to_title . '</h4>';
	
	// Start table
	echo '<table border="1" cellspacing="0" cellpadding="3">';
	
	// Add headers
	echo '<tr style="background-color: #f0f0f0; font-weight: bold;">';
	echo '<td>Date</td>';
	echo '<td>Full Name</td>';
	echo '<td>Student ID</td>';
	echo '<td>Program</td>';
	echo '<td>Time In</td>';
	echo '<td>Time Out</td>';
	echo '<td>Purpose</td>';
	echo '</tr>';
	
	// Add data rows
	foreach($data as $row) {
		echo '<tr>';
		foreach($row as $cell) {
			echo '<td>' . htmlspecialchars($cell) . '</td>';
		}
		echo '</tr>';
	}
	
	echo '</table>';
	echo '</body>';
	echo '</html>';
	exit;
?>
