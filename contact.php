<?php
    require 'includes/header.php';
?>
<?php
    $result="";
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';
    require 'phpmailer/Exception.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    if(isset($_POST['submit'])){
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = "blancmanandhar@gmail.com";
        $mail->Password = "sabitashakyamanandhar";
        $mail->Subject='Form Submission: ' . $_POST['subject'];
        $mail->setFrom($_POST['email'],$_POST['name']);
        $mail->isHTML(true);
        $mail->Body='<p>Name: '. $_POST['name']. '<br>Email: ' .$_POST['email'].'<br>
        Message: ' . $_POST['msg'] . '</p>';
        $mail->addAddress('blancmanandhar@gmail.com');
        
        //$mail->addReplyTo($_POST['email'],$_POST['name']);        

        if(!$mail->send()){
            $result="Something went wrong. Please try again.";
        }
        else{
            $result="Thanks " . $_POST['name']." for contacting us.";
        }
        $mail->smtpClose();
        
    }
?>

<h1>
    Please fill the form below
</h1>
<h5>
    <?=$result; ?>
</h5>

<div class="contactForm">
    <form action='contact.php' method="POST">
        <input type="text" name="name" placeholder="Enter your name" maxlength="30" minlength="4">
        <input type="email" name="email" placeholder="Enter your email" maxlength="30" minlength="10">
        <input type="text" name="subject" placeholder="Enter your subject" maxlength="20" minlength="5">
        <textarea name="msg" rows="5" cols="30" placeholder="Write your message here"></textarea>

        <button type="submit" name="submit">Submit</button>
    </form>
</div>



<?php
    require 'includes/footer.php';
?>