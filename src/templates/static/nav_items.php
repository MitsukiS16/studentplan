<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/session_interaction/session.php');

startSession();

$nav_items = array();

if (isUserLoggedIn()) {
    // setup nav actions for each role
    switch (getSessionUserRole()) {
        case 'admin':
        case 'teacher':
           //$nav_items["/subjects"] = "Subjectss";
        default:
            $nav_items = array_merge($nav_items, array(
                "/report" => "Report",
                "/profile?id=" . getSessionUserID() => "Profile"
            ));
    }
    $nav_items['/sign-out'] = "Sign Out";
} else {
    $nav_items['/sign-in'] = "Sign In";
}
