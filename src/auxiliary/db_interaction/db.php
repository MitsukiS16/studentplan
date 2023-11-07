<?php
include_once('../routing/checkURI.php');

function connectToDB($db_path)
{
    if (!can_access_file($db_path)) {
        echo "Fatal server error - database file does not exist";
        exit;
    }
    return new PDO('sqlite:' . $db_path);
}

function can_access_file($file_path)
{
    return file_exists($file_path) && is_writable($file_path);
}
