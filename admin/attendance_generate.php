<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn){
		$contents = '';
	 	
	 	// 
		$sql = "SELECT attendance.*, students.reference_number AS empid, students.firstname, students.lastname, students.program, attendance.id AS attid, purposes.name AS purpose_name FROM attendance LEFT JOIN students ON students.id=attendance.reference_number LEFT JOIN purposes ON purposes.id=attendance.purpose_id WHERE attendance.date BETWEEN '$from' AND '$to' ORDER BY attendance.date ASC, attendance.time_in ASC";

		$query = $conn->query($sql);
		if (!$query) {
			die('SQL Error: ' . $conn->error . '<br>Query: ' . $sql);
		}
		$total = 0;
		while($row = $query->fetch_assoc()){
			$empid = $row['empid'];
           
			$contents .= '
			<tr>
				<td>'.date('M d, Y', strtotime($row['date'])).'</td>
                <td>'.$row['firstname'].' '.$row['lastname'].'</td>
                <td>'.$row['empid'].'</td>
                <td>'.($row['program'] ? $row['program'] : '-').'</td>
                <td>'.date('h:i A', strtotime($row['time_in'])).'</td>
                <td>'.($row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : '-').'</td>
                <td>'.($row['purpose_name'] ? $row['purpose_name'] : '-').'</td>
				
			</tr>
			';
		}

		return $contents;
	}
		
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../TCPDF-main/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('PanpacificU Library Attendance: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $pdf->Image('../images/panpacificu-logo.jpg', 10, 10, 20, 0, 'JPG'); // Add logo to top left
    $pdf->SetY(20); // Move down to avoid overlapping the logo
    $content = '';  
    $content .= '
      	<h2 align="center">PanpacificU Library Attendance Sheet</h2>
      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
				  <th width="12%"><b>Date</b></th>
                  <th width="25%"><b>Full Name</b></th>
                  <th width="12%"><b>Student ID</b></th>
                  <th width="18%"><b>Program</b></th>
                  <th width="10%"><b>Time In</b></th>
                  <th width="10%"><b>Time Out</b></th>
                  <th width="13%"><b>Purpose</b></th>
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('attendance.pdf', 'I');

?>