<?php
include_once('../routing/checkURI.php');

function getAllDepartments($pdo)
{
    return $pdo->query("SELECT * FROM DEPARTMENTS;")->fetchAll(PDO::FETCH_ASSOC);
}

function getDepartmentByID($pdo, $id)
{
    $departmentquery = $pdo->prepare("SELECT * FROM DEPARTMENTS WHERE department_id = ?");
    $departmentquery->execute([$id]);
    return $departmentquery->fetch(PDO::FETCH_ASSOC);
}

function getDepartmentUserCount($pdo, $id)
{
    $countquery = $pdo->prepare("SELECT COUNT(*) as USER_COUNT from USER_DEPARTMENTS where department_id=?");
    $countquery->execute([$id]);
    $data = $countquery->fetch(PDO::FETCH_ASSOC);
    return $data["USER_COUNT"];
}

function getDepartmentTickets($pdo, $department_id)
{
    $ticketsquery = $pdo->prepare("SELECT * FROM TICKETS WHERE department_id = ?");
    $ticketsquery->execute([$department_id]);
    return $ticketsquery->fetchAll(PDO::FETCH_ASSOC);
}

function getDepartmentTicketCount($pdo, $id)
{
    $countquery = $pdo->prepare("SELECT COUNT(*) as TICKET_COUNT FROM TICKETS WHERE department_id=?;");
    $countquery->execute([$id]);
    $data = $countquery->fetch(PDO::FETCH_ASSOC);
    return $data["TICKET_COUNT"];
}
