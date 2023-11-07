<?php
$uri = $_SERVER['REQUEST_URI'];
$uri = strtok($uri, "?");  // strip GET parameters
if (str_starts_with($uri, '/src')) {
    // routes are designed to run outside of the router due to a limitation with html forms
    if (!str_starts_with($uri, '/src/routes')) {
        header('Location: /'); // redirect to /
        exit;
    }
}