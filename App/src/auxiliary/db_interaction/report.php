<?php
include_once('../routing/checkURI.php');

function getReportCycleName($pdo, $reportId) {
    $query = $pdo->prepare('SELECT c.name_cycle
        FROM CYCLE c
        JOIN ENROLLED e ON c.id_cycle = e.id_cycle
        JOIN REPORTCARD rc ON e.id_enrolled = rc.id_enrolled
        WHERE rc.id_report_card = :reportId');
    $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC)['name_cycle'];
}


function getReportYear($pdo, $reportId) 
{
    $query = $pdo->prepare('SELECT e.year
        FROM ENROLLED e
        INNER JOIN REPORTCARD rc ON e.id_enrolled = rc.id_enrolled
        WHERE rc.id_report_card = :reportId
    ');
    $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['year']; 
};

function getSchoolName($pdo, $reportId) 
{
    $query = $pdo->prepare('SELECT s.name_school
        FROM SCHOOL s
        INNER JOIN ENROLLED e ON s.id_school = e.id_school
        INNER JOIN REPORTCARD rc ON e.id_enrolled = rc.id_enrolled
        WHERE rc.id_report_card = :reportId
    ');
    $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['name_school']; 
}



function getReportCountSubjects($pdo, $reportId) {
    $query = $pdo->prepare('SELECT COUNT(rs.id_subject) as num_subjects
        FROM REPORTCARDSUBJECTS rs
        WHERE rs.id_report_card = :reportId
    ');
    $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['num_subjects']; 
}



function getReportAverage($pdo, $reportId) {

    return null;

}


function getReportLastUpdated($pdo, $reportId) {
    $query = $pdo->prepare('SELECT updated_at
        FROM REPORTCARD
        WHERE id_report_card = :reportId
    ');
    $query->bindParam(':reportId', $reportId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result['updated_at']; 
}

