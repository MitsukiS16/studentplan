<?php
include_once('../routing/checkURI.php');

function getFAQs($pdo)
{
    $query = $pdo->prepare("SELECT * FROM FAQS");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
