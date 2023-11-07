<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/departments.php');
require_once('src/auxiliary/db_interaction/tickets.php');
require_once('src/templates/injectable/profile_templates.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/error_templates.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$session_role = getSessionUserRole();
if ($session_role !== 'admin' && $session_role !== 'agent') {
    redirectTo('403');
}

// fetch ticket id if set
$id = isset($_GET['id']) ? $_GET['id'] : null;

// if a parameter was passed, we try to get that ticket from the database
if (!is_null($id)) {
    //connect to db (path starts in root, since we're importing ticket.php there)

    $db_path = 'db/app.db';
    $pdo = connectToDB($db_path);

    $department = getDepartmentByID($pdo, $id);

    if ($department) {
        $tickets = getDepartmentTickets($pdo, $id);

        $department_info = array(
            "Tickets" => getDepartmentTicketCount($pdo, $id),
            "Users" => getDepartmentUserCount($pdo, $id)
        );

        foreach ($tickets as $ticket) {
            $hashtags[$ticket['id']] = getTicketHashtags($pdo, $ticket['id']);
        }
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
        <h2>My Tickets</h2>
        <hr>
        <ul>
            <?php
            if (count($tickets) === 0) {
                echo simpleErrorTemplate("Error accessing tickets: you don't have access to any tickets.");
            } else {
                foreach ($tickets as $ticket) {
                    $ticket_id = $ticket['id'];
                    $ticket_name = $ticket['title'];

                    $snippets = array(
                        "Hashtags" => implode(" ", $hashtags[$ticket_id])
                    );

                    $url = "/ticket";

                    echo "<li>";
                    echo listEntry($url, $ticket_id, $ticket_name, $snippets);
                    echo "</li>";
                }
            }
            ?>
        </ul>
    </div>
</main>