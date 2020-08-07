<?php
    require 'includes/header.php';
?>

<?php
    if(isset($_POST['submit'])){

    }
?>

<h1>
    Please fill the form below
</h1>

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