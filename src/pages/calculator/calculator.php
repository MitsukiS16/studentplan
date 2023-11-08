<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/courses.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/error_templates.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$db_path = 'db/app.db';
$pdo = connectToDB($db_path);

switch (getSessionUserRole()) {
    case 'admin':
        //$tickets = getTicketsChunk($pdo, $limit, $offset);
        break;
    case 'teacher':
        // agent has access to tickets of department's he's assigned to
        // $department_ids = getUserDepartmentIDs($pdo, getSessionUserID());
        // $tickets = array();
        // foreach ($department_ids as $department_id) {
        //     $tickets = array_merge($tickets, getDepartmentTickets($pdo, $department_id));
        // }
        // $tickets = array_merge($tickets, getUserTickets($pdo, getSessionUserID()));
        // $tickets = array_slice($tickets, $offset, $limit);
        break;
    case 'student':
    default:
        // for additional roles that may be created (functionally equivalent to a client, when it comes to permissions)
        //$subjects = getUserSubjectsChunk($pdo, getSessionUserID(), $limit, $offset);
        break;
}

?>

<main class="main-page-container main-container-size">
<h1>Calculadora</h1>
</main>