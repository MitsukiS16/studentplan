<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('../../auxiliary/routing/redirect.php');
require_once("../../auxiliary/db_interaction/db.php");
require_once("../../auxiliary/db_interaction/users.php");
require_once("../../auxiliary/db_interaction/departments.php");
require_once('../../auxiliary/session_interaction/session.php');

startSession();

// update user in db with new values from form
if (($_POST)) {
    if (!$_POST["id"]) {
        redirectTo('404');
    }

    $id = $_POST['id'];

    $db_path = '../../../db/app.db';
    $pdo = connectToDB($db_path);

    $user = getUserWithID($pdo, $id);

    if (!$user) {
        redirectTo('404');
    }

    if ($user['user_id'] !== getSessionUserID()) {
        if (getSessionUserRole() !== 'admin') {
            redirectTo('403');
        }
    }
    if (getSessionUserRole() == 'admin') {
        $admin_user = getUserWithID($pdo, getSessionUserID());
        $correctpassword = $admin_user['pw_hash'];
    } else {
        $correctpassword = $user['pw_hash'];
    }

    if (password_verify($_POST['current_password'], $correctpassword)) {


        if (!empty($_POST['username'])) {
            $username = $_POST['username'];
            updateUserUsername($pdo, $id, $username);
        }

        if (!empty($_POST['picture'])) {
            $picture = $_POST['picture'];

            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            $image_info = getimagesize($picture);

            if (in_array($image_info['mime'], $allowed_types)) {
                updateUserPicture($pdo, $id, $picture);
            } else {
                $error_message = "Error: Image type not allowed.";
            }
        }

        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            updateUserEmail($pdo, $id, $email);
        }
        if ($user['role_type'] != $_POST['role_type'] && getSessionUserRole() === 'admin' && !empty($_POST['role_type'])) {
            $role_type = $_POST['role_type'];
            updateUserRole($pdo, $id, $role_type);
        }
        if (!empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                updateUserPassword($pdo, $id, $new_password);
            } else {
                $error_message = "New passwords do not match";
            }
        } else if (!empty($_POST['new_password']) && empty($_POST['confirm_password'])) {
            $error_message = "You need to enter a new password and confirm it";
        } else if (empty($_POST['new_password']) && !empty($_POST['confirm_password'])) {
            $error_message = "You need to enter a new password and confirm it";
        }

        $departments = getAllDepartments($pdo);
        $user_departments = getUserDepartmentIDs($pdo, $id);
        // var_dump($user_departments);
        // echo "<br />";
        // var_dump($_POST);
        foreach ($departments as $department) {
            $department_name = $department['department_name'];
            $post_department = $_POST[$department_name];
            if (!empty($post_department) && $post_department === 'on') {
                if (in_array($department['department_id'], $user_departments)) {
                    continue;
                }
                // echo $department_id 
                insertNewUserDepartment($pdo, $id, $department['department_id']);
            } else {
                if (in_array($department['department_id'], $user_departments)) {
                    deleteUserDepartment($pdo, $id, $department['department_id']);
                }
            }
        }
    } else {
        $error_message = "Current password is incorrect";
    }

    if (!$error_message)
        redirectTo('profile?id=' . $id);
    else
    if (isset($error_message)) {
        setSessionMessage($error_message);
        redirectTo('profile/edit?id=' . $id);
    }
}
