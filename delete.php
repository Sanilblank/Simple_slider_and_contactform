<?php
    require 'includes/database.php';

    if($_GET['delete']){
        $id = $_GET['delete'];
        $sql = "DELETE FROM contact WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header('Location:messages.php?error=sqlerror');
            exit;
        }
        else{
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);

            header('Location:messages.php?success=RecordDeleted');
            exit();
        }
    }
?>