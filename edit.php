<?php
    require 'includes/header.php';
    require 'includes/database.php';
?>

<?php
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM contact WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header('Location:messages.php?error=sqlerror');
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $email = $row['email'];
            $subject = $row['subject'];
        }
    }
?>

<h2>Edited form will only be saved in database</h2>

<div class="contactForm">
    <form action='edit.php' method="POST">
        <input type="text" name="name" value="<?php echo $name ?>" placeholder="Enter your name" maxlength="30" minlength="4" required>
        <input type="email" name="email" value="<?php echo $email ?>" placeholder="Enter your email" maxlength="30" minlength="10" required>
        <input type="text" name="subject" value="<?php echo $subject ?>" placeholder="Enter your subject" maxlength="30" minlength="5" required>
        <textarea name="msg" rows="5" cols="30" placeholder="Write your message here" required></textarea>
        <br>
        <button type="submit" name="submit">Submit</button>
    </form>
</div>

<?php
    if(isset($_POST['submit'])){
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $subject =trim($_POST['subject']);
        $msg = trim($_POST['msg']);

        $sql = "UPDATE contact SET msg = ? WHERE name = ? && email = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header('Location:edit.php?error=sqlerror');
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"sss",$msg,$name,$email);
            mysqli_stmt_execute($stmt);
            header('Location:messages.php?success=recordedited');
            exit();
        }
    }
?>

<?php
    require 'includes/footer.php';
?>