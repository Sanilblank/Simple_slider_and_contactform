<?php
    require_once 'includes/header.php';
?>
    <div class="slidershow middle">
        <div class="slides">
            <input type="radio" name="r" id="r1" checked>
            <input type="radio" name="r" id="r2">
            <input type="radio" name="r" id="r3">
            <input type="radio" name="r" id="r4">
            <input type="radio" name="r" id="r5">

            <div class="slide s1">
                <img src="images/1.jpg" alt="">
            </div>
            <div class="slide">
                <img src="images/2.jpg" alt="">
            </div>
            <div class="slide">
                <img src="images/3.jpg" alt="">
            </div>
            <div class="slide">
                <img src="images/4.jpg" alt="">
            </div>
            <div class="slide">
                <img src="images/5.jpg" alt="">
            </div>
        </div>
    </div>

    <div class="navigation">
        <label for="r1" class="bar"></label>
        <label for="r2" class="bar"></label>
        <label for="r3" class="bar"></label>
        <label for="r4" class="bar"></label>
        <label for="r5" class="bar"></label>
    </div>
    
<?php
    require_once 'includes/footer.php';
?>