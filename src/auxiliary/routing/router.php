<?php
include_once('./checkURI.php');

// Get request URI
$uri = $_SERVER['REQUEST_URI'];
$uri = strtok($uri, "?"); // strip get parameters

// routes
switch ($uri) {
    case '/':
        include_once('src/pages/home/home.php');
        break;
    case '/browse':
        include_once('src/pages/browse.php');
        break;
    case '/ticket':
        include_once('src/pages/ticket/ticket.php');
        break;
    case '/tickets':
        include_once('src/pages/ticket/tickets.php');
        break;
    case '/ticket/create':
        include_once('src/pages/ticket/create_ticket.php');
        break;
    case '/departments':
        include_once('src/pages/departments/departments.php');
        break;
    case '/department':
        include_once('src/pages/departments/department.php');
        break;
    case '/sign-in':
        include_once('src/pages/authentication/login.php');
        break;
    case '/sign-up':
        include_once('src/pages/authentication/register.php');
        break;
    case '/sign-out':
        include_once('src/routes/authentication/logout.php');
        break;
    case '/ticket/edit':
        include_once('src/pages/ticket/edit_ticket.php');
        break;
    case '/403':
        include_once('src/pages/error/403.php');
        break;
    case '/404':
        include_once('src/pages/error/404.php');
        break;
    case '/profile':
        include_once('src/pages/profile/profile.php');
        break;
    case '/profile/edit':
        include_once('src/pages/profile/edit.php');
        break;
    default:
        include_once('src/pages/error/404.php');
        break;
}
