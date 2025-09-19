<?php
include 'includes/session.php';

if(isset($_POST['delete'])){
    $id = $_POST['id'];

    // Check if purpose is being used in attendance records
    $sql = "SELECT COUNT(*) as count FROM attendance WHERE purpose_id = '$id'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    
    if($row['count'] > 0){
        $_SESSION['error'] = 'Cannot delete purpose. It is being used in attendance records.';
    }
    else{
        $sql = "DELETE FROM purposes WHERE id = '$id'";
        if($conn->query($sql)){
            $_SESSION['success'] = 'Purpose deleted successfully';
        }
        else{
            $_SESSION['error'] = $conn->error;
        }
    }
}
else{
    $_SESSION['error'] = 'Select purpose to delete first';
}

header('location: purposes.php');
?>
