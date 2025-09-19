<?php
include 'conn.php';

$sql = "SELECT * FROM purposes WHERE is_active = 1 ORDER BY name ASC";
$query = $conn->query($sql);

$purposes = array();
while($row = $query->fetch_assoc()){
    $purposes[] = $row;
}

echo json_encode($purposes);
?>
