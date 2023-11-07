<?php
include_once('../routing/checkURI.php');

function getUserWithID($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM USERS WHERE user_id=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getAllAgents($pdo)
{
    return $pdo->query("SELECT * FROM USERS WHERE ROLE_TYPE LIKE 'agent' OR ROLE_TYPE LIKE 'admin';")->fetchAll(PDO::FETCH_ASSOC);
}

function getUserWithUsername($pdo, $username)
{
    $query = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $query->execute([$username]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUserWithEmail($pdo, $email)
{
    $query = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $query->execute([$email]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUserTickets($pdo, $user_id)
{
    $query = $pdo->prepare('SELECT * FROM tickets WHERE creator_id = ?');
    $query->execute([$user_id]);
    return $query->fetchAll();
}

function getUserTicketsChunk($pdo, $user_id, $limit, $offset)
{
    $query = $pdo->prepare('SELECT * FROM tickets WHERE creator_id = ? LIMIT ? OFFSET ?');
    $query->execute([$user_id, $limit, $offset]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getUserDepartmentIDs($pdo, $user_id)
{
    $query = $pdo->prepare('SELECT UDPT.department_id AS department_id FROM USER_DEPARTMENTS UDPT JOIN USERS U ON UDPT.user_id=U.user_id WHERE U.user_id = ?');
    $query->execute([$user_id]);
    return $query->fetchAll(PDO::FETCH_COLUMN);
}

function insertNewUser($pdo, $username, $email, $role_type, $pw_hash)
{
    $query = $pdo->prepare('INSERT INTO USERS(username, email, role_type, pw_hash,created_at) VALUES (?, ?, ?,?,?)');
    $query->execute([$username, $email, $role_type, $pw_hash, date("Y-m-d")]);
}

function insertNewUserDepartment($pdo, $user_id, $department_id)
{
    $query = $pdo->prepare('INSERT INTO USER_DEPARTMENTS VALUES (?, ?)');
    $query->execute([$user_id, $department_id]);
}

function updateUserUsername($pdo, $user_id, $username)
{
    $query = $pdo->prepare("UPDATE USERS SET username=? WHERE user_id=?");
    $query->execute([$username, $user_id]);
}

function updateUserEmail($pdo, $user_id, $email)
{
    $query = $pdo->prepare("UPDATE USERS SET email=? WHERE user_id=?");
    $query->execute([$email, $user_id]);
}

function updateUserRole($pdo, $user_id, $role)
{
    $query = $pdo->prepare("UPDATE USERS SET role_type=? WHERE user_id=?");
    $query->execute([$role, $user_id]);
}

function updateUserPassword($pdo, $user_id, $new_password)
{
    $query = $pdo->prepare("UPDATE USERS SET pw_hash=? WHERE user_id=?");
    $query->execute([$new_password, $user_id]);
}
function updateUserPicture($pdo, $user_id, $pictureURL)
{
    $query = $pdo->prepare("UPDATE USERS SET picture=? WHERE user_id=?");
    $query->execute([$pictureURL, $user_id]);
}

function getAdminPassword($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM USERS WHERE ROLE_TYPE LIKE 'admin';");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function deleteUserDepartment($pdo, $user_id, $department_id)
{
    $query = $pdo->prepare("DELETE FROM USER_DEPARTMENTS WHERE user_id=? AND department_id=?");
    return $query->execute([$user_id, $department_id]);
}