<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/auxiliary/session_interaction/session.php');

$id = $_GET['id'];

if (isMessageSet()) {
    echo "<script> window.addEventListener('DOMContentLoaded', () => {displayMessagePopUp('" . getSessionMessage() . "');}); </script>";
    unsetMessage();
}


if (!isUserLoggedIn()) {
    redirectTo('sign-in');
}

if (!is_null($id)) {

    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $user = getUserWithID($pdo, $id);

    if (!$user) {
        redirectTo('404');
    }

    if ($user['id_user'] !== getSessionUserID()) {
        if (getSessionUserRole() !== 'admin') {
            redirectTo('403');
        }
    }
}

$username = $user['username'];
$email = $user['email'];
$role_type = $user['role_type'];


?>

<main class="main-page-container main-container-size edit_form">
    <h1>Edit Profile</h1>
    <form method="POST" action="/src/routes/user/edit_profile.php">
        <input type="hidden" name="id" value="">
        <?php echo '<input type="hidden" name="id" value="' . $id . '">'; ?>
        <input type="text" id="username" name="username" placeholder="<?php echo htmlspecialchars($username) ?>"><br>
        <input type="email" id="email" name="email" placeholder="<?php echo htmlspecialchars($email) ?>"></textarea><br>
        <input type="url" id="picture" name="picture" placeholder="Profile Picture URL (jpg,jpeg,png)">


        <?php if (getSessionUserRole() === 'admin') : ?>
            <select id="role_type" name="role_type">
                <option value="admin">Admin</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>

            </select><br>
        <?php endif; ?>

        <input type="password" id="new_password" name="new_password" placeholder="Enter your new password"><br>

        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your new password"><br>

        <input type="password" id="current_password" name="current_password" placeholder="Enter your current password to confirm changes" required><br>


        <input type="submit" value="Submit">
    </form>
</main>