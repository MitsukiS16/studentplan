<?php
include_once('../../auxiliary/routing/checkURI.php');

/**
 * Wrapper for session_start, to make it look more consistent with the remainder of our code
 */
function startSession()
{
    session_start();
}

/**
 * Wrapper for session_destroy, to make it look more consistent with the remainder of our code
 */
function destroySession()
{
    session_destroy();
}

/**
 * Empties all data in the session variable
 */
function resetSessionValues()
{
    $_SESSION = array();
}

/**
 * Unsets the message value of the session variable
 */
function unsetMessage()
{
    unset($_SESSION['message']);
}

/**
 * Checks if the user is logged in
 * @return true if the user is logged in, false otherwise
 */
function isUserLoggedIn()
{
    return isset($_SESSION['id_user']);
}

/**
 * Checks if the message is set
 * @return true if the message is logged in, false otherwise
 */
function isMessageSet()
{
    return isset($_SESSION['message']);
}

/**
 * Sets the user-related data of the session variable
 * @param $id_user - the user's id
 * @param $username - the user's username
 * @param $role - the role of the user
 */
function setSessionUserData($id_user, $username, $role)
{
    $_SESSION['id_user'] = $id_user;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
}

/**
 * Sets the message data of the session variable
 * @param $msg - the message to bee set
 */
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

