<?php
include_once('../../auxiliary/routing/checkURI.php');

/**
 * Builds a simple error message
 * @param $msg - message to be displayed
 * @return HTML of the template
 */
function simpleErrorTemplate($msg)
{
    return <<<HTML
        <h1>{$msg}</h1>
    HTML;
}