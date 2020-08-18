<?php
    require 'includes/header.php';
    require 'includes/database.php';
?>
<h2>All entered form are present here</h2>

<?php
    $sql = 'SELECT * FROM contact';
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('Location: messages.php?Sqlerror');
        exit;
    }
    else{
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rowCount = mysqli_stmt_num_rows($stmt);
        if($rowCount==0){
            echo "<div class='noResult'>";
            echo "<h2>No items entered. <a href = 'addItem.php'>Click here</a></h2>";
            echo "</div>";
        }
        else{
            $sql = 'SELECT * FROM contact';
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header('Location: messages.php?Sqlerror');
                exit;
            }
            else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                ?>
                        <div class="forTable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>

                        <?php
                            while($row = mysqli_fetch_assoc($result)){  ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['subject']; ?></td>
                                    <td><?php echo $row['msg']; ?></td>
                                    <td>
                                        <div class="editDelete">
                                            <a href="edit.php?edit=<?php echo $row['id']; ?>">Edit</a>
                                            <a href="delete.php?delete=<?php echo $row['id']; ?>">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                        <?php } ?>
                        
                            </table>
                        </div>
                    <?php
            }
        }
    }

?>

<?php
    require 'includes/footer.php';
?>