<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/courses.php');
require_once('src/auxiliary/db_interaction/subjects.php');
require_once('src/templates/injectable/profile_templates.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/error_templates.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$session_role = getSessionUserRole();
if ($session_role !== 'admin' && $session_role !== 'teacher' && $session_role !== 'student') {
    redirectTo('403');
}

// fetch subjects id if set
$id = isset($_GET['id']) ? $_GET['id'] : null;

// if a parameter was passed, we try to get that ticket from the database
if (!is_null($id)) {
    //connect to db (path starts in root, since we're importing ticket.php there)

    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $course = getCourseWithID($pdo, $id);

    if ($department) {
        $subjects = getCourseSubjects($pdo, $id);

        $course_info = array(
            "Subjects" => getCourseSubjectsCount($pdo, $id),
            "Users" => getCourseUsersCount($pdo, $id)
        );
    }
}


?>

<main class="list-container main-page-container">
    <div class="editable-header">
        <h1 class="page-header"><?php echo $department['department_name'] ?></h1>
    </div>
    <ul class="profile-info width-100">
        <?php echo profileInfoTemplate($department_info) ?>
    </ul>
    <div>
        <h2>My Report Cards</h2>
        
    </div>
</main>