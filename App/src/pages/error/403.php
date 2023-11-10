<?php
include_once('../../auxiliary/routing/checkURI.php');

$uri = $_SERVER['REQUEST_URI'];
$uri = ltrim($uri, $uri[0]);
?>
<main class="main-page-container main-container-size page-error">
    <h1>Sorry, you don't have the permission to access this page</h1>
</main>