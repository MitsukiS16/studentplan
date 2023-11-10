<?php
include_once('../routing/checkURI.php');


function getCourseWithID($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM COURSE WHERE id_course=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

// function getCourseName($pdo, $id_report_card)
// {
//     $query = $pdo->prepare("
//         SELECT c.name_course
//         FROM REPORTCARD rc
//         JOIN COURSE c ON rc.id_course = c.id_course
//         WHERE rc.id_report_card = ?
//     ");
//     $query->execute([$id_report_card]);
//     return $query->fetchColumn();
// }




// function getCourseSubjects($pdo, $id)
// {
//     $query = $pdo->prepare("SELECT * FROM COURSESUBJECT WHERE id_course=?");
//     $query->execute([$id]);
//     return $query->fetchAll(PDO::FETCH_ASSOC);
// }

// function getCourseSubjectsCount($pdo, $id)
// {
//     $countquery = $pdo->prepare("SELECT COUNT(*) as SUBJECT_COUNT from COURSESUBJECT where id_course=?");
//     $countquery->execute([$id]);
//     $data = $countquery->fetch(PDO::FETCH_ASSOC);
//     return $data["SUBJECT_COUNT"];
// }
// function getCourseUsersCount($pdo, $id)
// {
//     $countquery = $pdo->prepare("SELECT COUNT(*) as USER_COUNT from USERS where id_course=?");
//     $countquery->execute([$id]);
//     $data = $countquery->fetch(PDO::FETCH_ASSOC);
//     return $data["USER_COUNT"];
// }
 

