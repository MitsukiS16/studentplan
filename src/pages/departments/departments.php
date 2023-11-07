<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/departments.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/error_templates.php');

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$db_path = 'db/app.db';
$pdo = connectToDB($db_path);

switch (getSessionUserRole()) {
    case 'admin':
        $departments = getAllDepartments($pdo);
        break;
    case 'agent':
        $department_ids = getUserDepartmentIDs($pdo, getSessionUserID());
        $departments = array();
        foreach ($department_ids as $department_id) {
            array_push($departments, getDepartmentByID($pdo, $department_id));
        }
        break;
    case 'client':
    default:
        // for additional roles that may be created (functionally equivalent to a client, when it comes to permissions)
        redirectTo('403');
}

?>

<main class="main-page-container main-container-size">
    <section>
        <h1>Departments</h1>
        <hr>
        <ul class="list-container">
            <?php
            if (count($departments) === 0) {
                echo simpleErrorTemplate("Error accessing departments: you don't have access to any departments.");
            } else {
                foreach ($departments as $department) {
                    $department_id = $department['department_id'];
                    $department_name = $department['department_name'];
                    $department_ticket_count = getDepartmentTicketCount($pdo, $department_id);
                    $department_user_count = getDepartmentUserCount($pdo, $department_id);

                    $snippets = array(
                        'Tickets' => $department_ticket_count,
                        'Users' => $department_user_count
                    );

                    $url = "/department";

                    echo "<li>";
                    echo listEntry($url, $department_id, $department_name, $snippets);
                    echo "</li>";
                }
            }
            ?>
        </ul>
    </section>
</main>