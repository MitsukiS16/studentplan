<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/session_interaction/session.php');

startSession();

$nav_items = array();

if (isUserLoggedIn()) {
    // setup nav actions for each role
    switch (getSessionUserRole()) {
        case 'admin':
        case 'agent':
            $nav_items["/departments"] = "Departments";
        default:
            $nav_items = array_merge($nav_items, array(
                "/ticket/create" => "Create a ticket",
                "/tickets" => "Tickets",
                "/profile?id=" . getSessionUserID() => "Profile"
            ));
    }
    $nav_items['/sign-out'] = "Sign Out";
} else {
    $nav_items['/sign-in'] = "Sign In";
}
