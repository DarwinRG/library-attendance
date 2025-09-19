<?php
include 'includes/session.php';

if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $is_active = $_POST['is_active'];

    $sql = "UPDATE purposes SET name = ?, description = ?, is_active = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $name, $description, $is_active, $id);
    
    if($stmt->execute()){
        $_SESSION['success'] = 'Purpose updated successfully';
    }
    else{
        $_SESSION['error'] = $conn->error;
    }
    $stmt->close();
}
else{
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: purposes.php');
?>
