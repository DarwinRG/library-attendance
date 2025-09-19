<?php
include 'includes/session.php';

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $is_active = $_POST['is_active'];

    $sql = "INSERT INTO purposes (name, description, is_active) VALUES ('$name', '$description', '$is_active')";
    if($conn->query($sql)){
        $_SESSION['success'] = 'Purpose added successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
}
else{
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: purposes.php');
?>
