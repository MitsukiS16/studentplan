<?php
include_once('../../auxiliary/routing/checkURI.php');

function simpleErrorTemplate($msg): string
{
    return <<<HTML
        <h1>{$msg}</h1>
    HTML;
}