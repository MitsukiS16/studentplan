<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/templates/static/nav_items.php');
?>
<footer>
    <section class="col-1">
        <ul class="height-100 centered-flex-col">
            <?php
            foreach ($nav_items as $uri => $label) {
                echo '<li><a class="nav-button" href="' . $uri . '">' . $label . '</a></li>';
            }
            ?>
        </ul>
    </section>

    <section class="col-2 centered-flex-col">
        <h3>Join our Network</h3>
        <form action="src/routes/misc/email.php" method="POST">
            <input type="email" placeholder="Your Email Address" name="email" required>
            <br>
            <button type="submit">SUBSCRIBE NOW</button>
        </form>
    </section>

    <section class="col-3 centered-flex-col">
        <h3>Contact</h3>
        <p> FEUP <br>Porto, Portugal</p>
        <div class="footer-icons">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
        </div>
    </section>

</footer>