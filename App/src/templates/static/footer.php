<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/templates/static/nav_items.php');
// require_once('src/templates/injectable/subjects_templates.php');


?>
<footer>
    <section class="col-1">
        <h3>Funcionalidades</h3>
        <ul class="height-80 centered-flex-col">
            <?php
            foreach ($nav_items as $uri => $label) {
                echo '<li><a class="nav-button" href="' . $uri . '">' . $label . '</a></li>';
            }
            ?>
        </ul>
    </section>

    <section class="col-2 centered-flex-col">
        <h3>Disciplinas</h3>
        <ul class="centered-flex-col">
        <li><a class="nav-button" href="#">Português</a></li>
        <li><a class="nav-button" href="#">Matemática</a></li>
        </ul>

    </section>

    <section class="col-3 centered-flex-col">
    <h3>Contactos</h3>
    <p>Porto, Portugal</p>
    <div class="footer-icons">
        <a href="https://www.google.com" target="_blank">
            <i class="fa fa-brands fa-facebook-square"></i>
        </a>
        <a href="https://www.google.com" target="_blank">
            <i class="fa fa-brands fa-twitter-square"></i>
        </a>
        <a href="https://www.google.com" target="_blank">
            <i class="fa fa-brands fa-instagram"></i>
        </a>
    </div>
    </section>

</footer>