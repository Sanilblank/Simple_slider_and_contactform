<?php
    require 'includes/header.php';
?>

<form action=# method="POST">
    <input type="text" name="name" placeholder="Enter your name" maxlength="30" minlength="4">
    <input type="email" name="email" placeholder="Enter your email" maxlength="30" minlength="10">
    <textarea name="message" rows="5" cols="20" placeholder="Write your message here"></textarea>

    <button type="submit" name="submit">Submit</button>
</form>



<?php
    require 'includes/footer.php';
?>