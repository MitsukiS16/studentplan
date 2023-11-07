<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/templates/static/nav_items.php');
?>

<header>
    <div>
        <a class="header-logo centered-flex-row" href="/">
            <i class="fa-sharp fa-solid fa-graduation-cap"></i>
            <p>Classroom Student</p>
        </a>
    </div>

    <input id="menu-toggle" type="checkbox" />
    <label class='header-menu-button-container' for="menu-toggle">
        <div class='header-menu-button'></div>
    </label>

    <ul class="header-menu centered-flex-col">
        <?php
        foreach ($nav_items as $uri => $label) {
            echo '<li><a class="nav-button" href="' . $uri . '">' . $label . '</a></li>';
        }
        ?>
    </ul>
</header>