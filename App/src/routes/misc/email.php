<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('../../auxiliary/routing/redirect.php');

if ($_POST && $_POST['email']) {
    $msg = "Thank you for using Classroom Student!";
    mail($_POST['email'], "Classroom Teacher", $msg);
}

redirectToRoot();
