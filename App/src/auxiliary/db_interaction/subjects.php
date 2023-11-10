<?php
include_once('../routing/checkURI.php');




function getSubjectWithID($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM SUBJECTSTUDENT WHERE id_course=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}


