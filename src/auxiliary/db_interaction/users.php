<?php
include_once('../routing/checkURI.php');




function getUserWithID($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM USERS WHERE id_user=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUserWithUsername($pdo, $username)
{
    $query = $pdo->prepare('SELECT * FROM USERS WHERE username = ?');
    $query->execute([$username]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUserWithEmail($pdo, $email)
{
    $query = $pdo->prepare('SELECT * FROM USERS WHERE email = ?');
    $query->execute([$email]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUserSubjects($pdo, $id_user, $id_report_card)
{
    $query = $pdo->prepare('SELECT s.id_subject, s.name_subject
        FROM SUBJECTS s
        JOIN REPORTCARDSUBJECTS rs ON s.id_subject = rs.id_subject
        WHERE rs.id_report_card = ? AND rs.id_report_card IN (
            SELECT id_report_card FROM REPORTCARD WHERE id_user = ?
        )
    ');
    $query->execute([$id_report_card, $id_user]);
    return $query->fetchAll();
}

function getCurrentUsersSubjects($pdo, $id_user)
{
    $query = $pdo->prepare('SELECT s.id_subject, s.name_subject 
        FROM SUBJECTS s
        JOIN REPORTCARDSUBJECTS rs ON s.id_subject = rs.id_subject
        WHERE rs.subject_status = TRUE
        AND rs.id_report_card IN (
            SELECT id_report_card FROM REPORTCARD WHERE id_user = ?
        )
    ');
    $query->execute([$id_user]);
    return $query->fetchAll();
}



function insertNewUser($pdo, $username, $email, $role_type, $pw_hash)
{
    $query = $pdo->prepare('INSERT INTO USERS (username, email, role_type, pw_hash, created_at) VALUES (?, ?, ?, ?, ?)');
    $query->execute([$username, $email, $role_type, $pw_hash, date("Y-m-d")]);
}



function updateUserUsername($pdo, $id_user, $username)
{
    $query = $pdo->prepare("UPDATE USERS SET username=? WHERE id_user=?");
    $query->execute([$username, $id_user]);
}

function updateUserEmail($pdo, $id_user, $email)
{
    $query = $pdo->prepare("UPDATE USERS SET email=? WHERE id_user=?");
    $query->execute([$email, $id_user]);
}

function updateUserRole($pdo, $id_user, $role)
{
    $query = $pdo->prepare("UPDATE USERS SET role_type=? WHERE id_user=?");
    $query->execute([$role, $id_user]);
}

function updateUserPassword($pdo, $id_user, $new_password)
{
    $query = $pdo->prepare("UPDATE USERS SET pw_hash=? WHERE id_user=?");
    $query->execute([$new_password, $id_user]);
}

function updateUserPicture($pdo, $id_user, $pictureURL)
{
    $query = $pdo->prepare("UPDATE USERS SET picture=? WHERE id_user=?");
    $query->execute([$pictureURL, $id_user]);
}

function getAdminPassword($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM USERS WHERE ROLE_TYPE LIKE 'admin';");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}


function getCountUserSubjets($pdo, $id_user)
{
    $query = $pdo->prepare('
        SELECT COUNT(DISTINCT rs.id_subject) as count
        FROM REPORTCARDSUBJECTS rs
        INNER JOIN REPORTCARD rc ON rs.id_report_card = rc.id_report_card
        WHERE rc.id_user = ? AND rs.subject_status = TRUE
    ');
    $query->execute([$id_user]);
    $result = $query->fetch();
    return $result['count'];
}

function getReportsId($pdo, $userId) {
    $query = $pdo->prepare("SELECT id_report_card FROM REPORTCARD WHERE id_user=?");
    $query->execute([$userId]);
    return $query->fetchAll(PDO::FETCH_COLUMN);
}
