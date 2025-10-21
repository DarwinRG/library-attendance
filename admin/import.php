<?php
	include 'includes/session.php';
	include '../includes/simple_xlsx.php';

    // Accept both legacy and new submit names
    $submitted = isset($_POST['import']) || isset($_POST['submit']);

    if($submitted){
        // Accept both legacy and new file input names
        $fileArray = isset($_FILES['file']) ? $_FILES['file'] : (isset($_FILES['filename']) ? $_FILES['filename'] : null);

        if(!$fileArray || empty($fileArray['name'])){
            $_SESSION['error'] = 'Please select a CSV or Excel file to upload';
            header('location: students.php');
            exit();
        }

        $originalName = $fileArray['name'];
        $tmpPath      = $fileArray['tmp_name'];
        $ext          = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if($ext !== 'csv' && $ext !== 'xlsx'){
            $_SESSION['error'] = 'Please upload a CSV file (.csv) or Excel file (.xlsx)';
            header('location: students.php');
            exit();
        }

        if(!is_uploaded_file($tmpPath)){
            $_SESSION['error'] = 'Upload failed. Please try again';
            header('location: students.php');
            exit();
        }

        $rows = array();
        
        if($ext === 'csv'){
            $csvHandle = fopen($tmpPath, 'r');
            if($csvHandle === false){
                $_SESSION['error'] = 'Unable to open uploaded file';
                header('location: students.php');
                exit();
            }
            
            while(($line = fgetcsv($csvHandle)) !== false){
                $rows[] = $line;
            }
            fclose($csvHandle);
        } else if($ext === 'xlsx'){
            try {
                $xlsx = new SimpleXLSX($tmpPath);
                $rows = $xlsx->rows();
            } catch (Exception $e) {
                $_SESSION['error'] = 'Unable to read Excel file: ' . $e->getMessage() . 
                    '<br><br><strong>Alternative:</strong> Please use our <a href="excel_to_csv_converter.html" target="_blank">Excel to CSV Converter</a> to convert your Excel file to CSV format first.';
                header('location: students.php');
                exit();
            }
        }

        if(empty($rows)){
            $_SESSION['error'] = 'No data found in uploaded file';
            header('location: students.php');
            exit();
        }

        // Optionally skip header row if present
        $firstRow = $rows[0];
        $maybeHeader = is_array($firstRow) && count($firstRow) > 0 && preg_match('/reference|student/i', (string)$firstRow[0]);
        if(!$maybeHeader){
            // First row is real data; rewind interpretation
            if(is_array($firstRow)){
                // Process the first row as data by setting a flag
                $rewindFirstRow = $firstRow;
            }
        }

        $insertSql = "INSERT INTO students (reference_number, firstname, lastname, email, phone, address, program, year_level, created_on) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $insertStmt = $conn->prepare($insertSql);

        $existsSql = "SELECT id FROM students WHERE reference_number = ?";
        $existsStmt = $conn->prepare($existsSql);

        $insertedCount = 0;
        $skippedCount  = 0;
        $rowNum        = 0;

        // Helper to process a single CSV row array (supports 6-col or 9-col formats)
        $processRow = function($row) use ($conn, $insertStmt, $existsStmt, &$insertedCount, &$skippedCount, &$rowNum){
            $rowNum++;
            if(!is_array($row) || count($row) < 3){
                $skippedCount++;
                return; // insufficient columns
            }

            // Supported layouts:
            // 7-col: ID, FIRST NAME, LAST NAME, EMAIL, PHONE, PROGRAM, YEAR LEVEL
            // 6-col: ID, FIRST NAME, LAST NAME, EMAIL, PROGRAM, YEAR LEVEL
            // 8-col: ID, FIRST, LAST, EMAIL, PHONE, ADDRESS, PROGRAM, YEAR
            if(count($row) >= 8){
                $reference_number = trim((string)($row[0] ?? ''));
                $firstname        = trim((string)($row[1] ?? ''));
                $lastname         = trim((string)($row[2] ?? ''));
                $email            = isset($row[3]) && $row[3] !== '' ? trim((string)$row[3]) : NULL;
                $phone            = isset($row[4]) && $row[4] !== '' ? trim((string)$row[4]) : NULL;
                $address          = isset($row[5]) && $row[5] !== '' ? trim((string)$row[5]) : NULL;
                $program          = isset($row[6]) ? trim((string)$row[6]) : '';
                $year_level       = isset($row[7]) ? trim((string)$row[7]) : '';
            } else if(count($row) >= 7){
                // Simplified with phone
                $reference_number = trim((string)($row[0] ?? ''));
                $firstname        = trim((string)($row[1] ?? ''));
                $lastname         = trim((string)($row[2] ?? ''));
                $email            = isset($row[3]) && $row[3] !== '' ? trim((string)$row[3]) : NULL;
                $phone            = isset($row[4]) && $row[4] !== '' ? trim((string)$row[4]) : NULL;
                $program          = isset($row[5]) ? trim((string)$row[5]) : '';
                $year_level       = isset($row[6]) ? trim((string)$row[6]) : '';
                $address          = NULL;
            } else if(count($row) >= 6){
                $reference_number = trim((string)($row[0] ?? ''));
                $firstname        = trim((string)($row[1] ?? ''));
                $lastname         = trim((string)($row[2] ?? ''));
                $email            = isset($row[3]) && $row[3] !== '' ? trim((string)$row[3]) : NULL;
                $program          = isset($row[4]) ? trim((string)$row[4]) : '';
                $year_level       = isset($row[5]) ? trim((string)$row[5]) : '';
                $phone            = NULL;
                $address          = NULL;
            } else {
                $skippedCount++;
                return;
            }

            if($reference_number === '' || $firstname === '' || $lastname === ''){
                $skippedCount++;
                return; // required fields missing
            }

            // Enforce DB column length limits
            $reference_number = substr($reference_number, 0, 15); // varchar(15)
            $firstname        = substr($firstname, 0, 50);       // varchar(50)
            $lastname         = substr($lastname, 0, 50);        // varchar(50)
            // Email is TEXT; optional limit for safety (common 254)
            if($email !== NULL){ $email = substr($email, 0, 254); }
            if($phone !== NULL){
                // Keep digits and optional leading '+'; then truncate to varchar(20)
                $phone = preg_replace('/[^0-9+]/', '', $phone);
                $phone = substr($phone, 0, 20);
            }
            if($address !== NULL){ $address = substr($address, 0, 200); } // varchar(200)
            $program    = substr($program, 0, 100);   // varchar(100)
            $year_level = substr($year_level, 0, 10); // varchar(10)

            // Skip duplicates by reference_number
            $existsStmt->bind_param("s", $reference_number);
            $existsStmt->execute();
            $existsResult = $existsStmt->get_result();
            if($existsResult && $existsResult->num_rows > 0){
                $skippedCount++;
                return; // duplicate
            }

            $insertStmt->bind_param(
                "ssssssss",
                $reference_number,
                $firstname,
                $lastname,
                $email,
                $phone,
                $address,
                $program,
                $year_level
            );
            try{
                if($insertStmt->execute()){
                    $insertedCount++;
                } else {
                    $skippedCount++;
                }
            } catch (mysqli_sql_exception $e) {
                // Skip problematic rows (e.g., still too long or invalid data)
                $skippedCount++;
            }
        };

        if(isset($rewindFirstRow)){
            $processRow($rewindFirstRow);
        }

        // Process remaining rows (skip first if it was a header)
        $startIndex = $maybeHeader ? 1 : 0;
        for($i = $startIndex; $i < count($rows); $i++){
            $processRow($rows[$i]);
        }

        $message = $insertedCount . ' added';
        if($skippedCount > 0){
            $message .= ', ' . $skippedCount . ' skipped';
        }
        $_SESSION['success'] = 'Students import complete: ' . $message;
    } else {
		$_SESSION['error'] = 'Please select file to import';
	}

	header('location: students.php');
?>