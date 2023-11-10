<?php
include_once('../../auxiliary/routing/checkURI.php');

function startSession()
{
    session_start();
}

function destroySession()
{
    session_destroy();
}

function resetSessionValues()
{
    $_SESSION = array();
}


function unsetMessage()
{
    unset($_SESSION['message']);
}

function isUserLoggedIn()
{
    return isset($_SESSION['id_user']);
}

function isMessageSet()
{
    return isset($_SESSION['message']);
}

function setSessionUserData($id_user, $username, $role)
{
    $_SESSION['id_user'] = $id_user;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
}


function setSessionMessage($msg)
{
    $_SESSION['message'] = $msg;
}


function getSessionUserID()
{
    return $_SESSION['id_user'];
}

function getSessionUsername()
{
    return $_SESSION['username'];
}


function getSessionUserRole()
{
    return $_SESSION['role'];
}

function getSessionUserData()
{
    return array($_SESSION['id_user'], $_SESSION['username'], $_SESSION['role']);
}

function getSessionMessage()
{
    return $_SESSION['message'];
}

