<?php
include_once('../../auxiliary/routing/checkURI.php');

$uri = $_SERVER['REQUEST_URI'];
$uri = ltrim($uri, $uri[0]);
?>
<main class="main-page-container main-container-size page-error">
    <h1>Sorry, the page you are looking for does not exist.</h1>
</main>