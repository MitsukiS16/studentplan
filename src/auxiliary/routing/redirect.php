<?php
include_once('./checkURI.php');

function redirectToRoot()
{
    header('Location: /');
    exit;
}

function redirectTo($path)
{
    header('Location: /' . $path);
    exit;
}
