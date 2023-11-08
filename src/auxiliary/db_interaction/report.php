<?php
include_once('../routing/checkURI.php');


function getReportCycle($pdo, $reportId) 
{
    // $query = $pdo->prepare('SELECT e.id_cycle
    //     FROM ENROLLED e
    //     INNER JOIN REPORTCARD rc ON e.id_enrolled = rc.id_enrolled
    //     WHERE rc.id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;
}

function getReportYear($pdo, $reportId) 
{
    // $query = $pdo->prepare('SELECT e.year
    //     FROM ENROLLED e
    //     INNER JOIN REPORTCARD rc ON e.id_enrolled = rc.id_enrolled
    //     WHERE rc.id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;

};

function getSchoolName($pdo, $reportId) 
{
    // $query = $pdo->prepare('SELECT s.name_school
    //     FROM SCHOOL s
    //     INNER JOIN ENROLLED e ON s.id_school = e.id_school
    //     INNER JOIN REPORTCARD rc ON e.id_enrolled = rc.id_enrolled
    //     WHERE rc.id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;

}


function getReportCountSubjects($pdo, $reportId) {
    // $query = $pdo->prepare('SELECT COUNT(rs.id_subject) as num_subjects
    //     FROM REPORTCARDSUBJECTS rs
    //     WHERE rs.id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;

}


function getReportAverage($pdo, $reportId) {
    // $query = $pdo->prepare('SELECT AVG(g.score) as average_score
    //     FROM EVALUATIONGRADE eg
    //     INNER JOIN GRADE g ON eg.id_grade = g.id_grade
    //     INNER JOIN REPORTCARD rc ON eg.id_evaluation = rc.id_report_card
    //     WHERE rc.id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;

}


function getReportLastUpdated($pdo, $reportId) {
    // $query = $pdo->prepare('SELECT updated_at
    //     FROM REPORTCARD
    //     WHERE id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;

}

function getReportDescription($pdo, $reportId) {
    // $query = $pdo->prepare('SELECT description_report_card
    //     FROM REPORTCARD
    //     WHERE id_report_card = :reportId
    // ');
    // $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    // $query->execute();
    // return $query->fetch(PDO::FETCH_ASSOC);
    return null;

}
