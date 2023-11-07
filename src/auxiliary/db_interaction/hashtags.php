<?php
include_once('../routing/checkURI.php');

function getHashtagsByTitle($pdo, $title)
{
    $query = $pdo->prepare("SELECT * FROM HASHTAGS WHERE title=?");
    $query->execute([$title]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function createHashtag($pdo, $title)
{
    $query = $pdo->prepare("INSERT INTO HASHTAGS (title) VALUES (?)");
    $query->execute([$title]);
}
