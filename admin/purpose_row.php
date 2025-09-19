<?php
include 'includes/session.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM purposes WHERE id = '$id'";
    $query = $conn->query($sql);
    
    if (!$query) {
        echo json_encode(['error' => 'Query failed: ' . $conn->error]);
        exit;
    }
    
    $row = $query->fetch_assoc();
    
    if (!$row) {
        echo json_encode(['error' => 'No purpose found with ID: ' . $id]);
        exit;
    }

    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No ID provided']);
}
?>
