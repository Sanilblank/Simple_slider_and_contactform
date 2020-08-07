<?php
    require 'includes/header.php';
    require 'includes/database.php';
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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $msg = $_POST['msg'];

        $captcha = $_POST["g-recaptcha-response"];
        $secretkey = "6LeoprsZAAAAALf5sxzvkTBwYV4dv-n-tPHW6n4t";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.urldecode($secretkey).'&response='.urldecode($captcha).'&remoteip'.$ip;
        $response = file_get_contents($url);
        $responseKey = json_decode($response,TRUE);
        
        if($responseKey["success"]){
            
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

            saveinDatabase($name, $email, $subject, $msg, $conn);

            }
        else{
                $result="Please perform the captcha test";
            }
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
        <input type="text" name="name" placeholder="Enter your name" maxlength="30" minlength="4" required>
        <input type="email" name="email" placeholder="Enter your email" maxlength="30" minlength="10" required>
        <input type="text" name="subject" placeholder="Enter your subject" maxlength="30" minlength="5" required>
        <textarea name="msg" rows="5" cols="30" placeholder="Write your message here" required></textarea>
        <div class="g-recaptcha" data-sitekey="6LeoprsZAAAAAHDD2xO0NEl4WHy9QMBWAUIIldrm"></div>
        <br/>

        <button type="submit" name="submit">Submit</button>
    </form>
</div>

<?php
    function saveinDatabase($name, $email, $subject, $msg, $conn){
        $sql = "INSERT INTO contact (name, email, subject, msg) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header('Location: contact.php?error=sqlerror');
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $msg);
            mysqli_stmt_execute($stmt);
        }

    }
?>



<?php
    require 'includes/footer.php';
?>