<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('src/auxiliary/routing/redirect.php');
require_once('src/auxiliary/session_interaction/session.php');
require_once('src/auxiliary/db_interaction/db.php');
require_once('src/auxiliary/db_interaction/tickets.php');
require_once('src/auxiliary/db_interaction/departments.php');
require_once('src/auxiliary/db_interaction/users.php');
require_once('src/templates/injectable/list_templates.php');
require_once('src/templates/injectable/error_templates.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('403');
}

$db_path = 'db/app.db';
$pdo = connectToDB($db_path);

$offset = 0;
$limit = 2;

switch (getSessionUserRole()) {
    case 'admin':
        $tickets = getTicketsChunk($pdo, $limit, $offset);
        break;
    case 'agent':
        // agent has access to tickets of department's he's assigned to
        $department_ids = getUserDepartmentIDs($pdo, getSessionUserID());
        $tickets = array();
        foreach ($department_ids as $department_id) {
            $tickets = array_merge($tickets, getDepartmentTickets($pdo, $department_id));
        }
        $tickets = array_merge($tickets, getUserTickets($pdo, getSessionUserID()));
        $tickets = array_slice($tickets, $offset, $limit);
        break;
    case 'client':
    default:
        // for additional roles that may be created (functionally equivalent to a client, when it comes to permissions)
        $tickets = getUserTicketsChunk($pdo, getSessionUserID(), $limit, $offset);
        break;
}

?>

<main class="main-page-container main-container-size">
    <section class="list-container">
        <h1>Tickets</h1>
        <hr>
        <ul id="ticket-unordered-list">
            <?php
            if (count($tickets) === 0) {
                echo simpleErrorTemplate("Error accessing tickets: you don't have access to any tickets.");
            } else {
                foreach ($tickets as $ticket) {
                    $ticket_id = htmlspecialchars($ticket['id']);
                    $ticket_name = htmlspecialchars($ticket['title']);
                    $hashtags = getTicketHashtags($pdo, $ticket_id);

                    $snippets = array(
                        "Status" => $ticket['ticket_status'],
                        "Hashtags" => implode(" ", array_map('htmlspecialchars', $hashtags))
                    );

                    $url = "/ticket";

                    echo "<li>";
                    echo listEntry($url, $ticket_id, $ticket_name, $snippets);
                    echo "</li>";
                }
            }
            ?>
        </ul>
        <div class="centered-flex-row w-full py-medium">
            <input class="edit-button" type="button" id="ticket-fetch-button" value="Fetch more tickets!" />
        </div>
    </section>
</main>