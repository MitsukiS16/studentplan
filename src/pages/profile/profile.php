<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/profile_templates.php');

if (!isUserLoggedIn()) {
    redirectTo('sign-in');
}

if (isMessageSet()) {
    echo "<script> window.addEventListener('DOMContentLoaded', () => {displayMessagePopUp('" . getSessionMessage() . "');}); </script>";
    unsetMessage();
}

$id = $_GET['id'];

if (!is_null($id)) {
    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $user_data = getUserWithID($pdo, $id);

    if (!$user_data) {
        redirectTo('404');
    }

    if ($user_data['id_user'] !== getSessionUserID()) {
        $session_role = getSessionUserRole();
        if ($session_role !== 'admin' && $session_role  !== 'agent') {
            redirectTo('403');
        }
    }

    $picture = $user_data['picture'];


    $user_info = array(
        "Username" => $user_data['username'],
        "Email" => $user_data['email'],
        "Joined in" => $user_data['created_at'],
    );

}
?>

<main class="main-page-container main-container-size">
    <div class="profile-container">
        <div class="profile-info width-20">
            <?php if ($picture == null) : ?>
                <img class="profile-img" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png"></img>
            <?php else : ?>
                <img class="profile-img" src="<?php echo $picture ?>"></img>
            <?php endif; ?>
            <ul>
                <?php echo profileInfoTemplate($user_info) ?>
            </ul>
        </div>
        <div class="list-container">
            <div class="editable-header">
                <h1 class="page-header">Profile</h1>
                <?php if (isUserLoggedIn() && (getSessionUserID() == $_GET['id'] || getSessionUserRole() == 'admin')) : ?>
                    <a class="edit-button" href="/profile/edit?id=<?php echo htmlspecialchars($_GET['id']); ?>">Edit</a>
                <?php endif; ?>
            </div>
        
        </div>
    </div>
</main>