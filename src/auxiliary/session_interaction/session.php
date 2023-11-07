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
    return isset($_SESSION['user_id']);
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
 * @param $user_id - the user's id
 * @param $username - the user's username
 * @param $role - the role of the user
 */
function setSessionUserData($user_id, $username, $role)
{
    $_SESSION['user_id'] = $user_id;
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

/**
 * Gets the currently logged-in user's id
 * @return the logged-in user's id
 */
function getSessionUserID()
{
    return intval($_SESSION['user_id']);
}

/**
 * Gets the currently logged-in user's username
 * @return the logged-in user's username
 */
function getSessionUsername()
{
    return $_SESSION['username'];
}

/**
 * Gets the currently logged-in user's role
 * @return the logged-in user's role
 */
function getSessionUserRole()
{
    return $_SESSION['role'];
}

/**
 * Gets the currently logged-in user's full data
 * @return an array with the user id, username and role, in that order
 */
function getSessionUserData()
{
    return array(intval($_SESSION['user_id']), $_SESSION['username'], $_SESSION['role']);
}

/**
 * Gets the currently set session message
 * @return the session message value
 */
function getSessionMessage()
{
    return $_SESSION['message'];
}