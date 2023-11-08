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

function getUserSubjects($pdo, $id_user)
{
    $query = $pdo->prepare('SELECT * FROM SUBJECTUSER WHERE id_user = ?');
    $query->execute([$id_user]);
    return $query->fetchAll();
}

function getUserSubjectsChunk($pdo, $id_user, $limit, $offset)
{
    $query = $pdo->prepare('SELECT * FROM SUBJECTUSER WHERE id_user = ? LIMIT ? OFFSET ?');
    $query->execute([$id_user, $limit, $offset]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// // function getUserDepartmentIDs($pdo, $id_user)
// // {
// //     $query = $pdo->prepare('SELECT UDPT.department_id AS department_id FROM USER_DEPARTMENTS UDPT JOIN USERS U ON UDPT.id_user=U.id_user WHERE U.id_user = ?');
// //     $query->execute([$id_user]);
// //     return $query->fetchAll(PDO::FETCH_COLUMN);
// // }

function insertNewUser($pdo, $username, $email, $role_type, $pw_hash)
{
    $query = $pdo->prepare('INSERT INTO USERS (username, email, role_type, pw_hash, created_at) VALUES (?, ?, ?, ?, ?)');
    $query->execute([$username, $email, $role_type, $pw_hash, date("Y-m-d")]);
}


// // function insertNewUserDepartment($pdo, $id_user, $department_id)
// // {
// //     $query = $pdo->prepare('INSERT INTO USER_DEPARTMENTS VALUES (?, ?)');
// //     $query->execute([$id_user, $department_id]);
// // }

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

// // function deleteUserDepartment($pdo, $id_user, $department_id)
// // {
// //     $query = $pdo->prepare("DELETE FROM USER_DEPARTMENTS WHERE id_user=? AND department_id=?");
// //     return $query->execute([$id_user, $department_id]);
// // }


function getStudentReportCards($pdo, $id) {
    $query = $pdo->prepare("SELECT * FROM STUDENTREPORTCARD WHERE id_user=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}