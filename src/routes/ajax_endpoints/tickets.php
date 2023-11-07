<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once("../../auxiliary/session_interaction/session.php");
require_once("../../auxiliary/db_interaction/db.php");
require_once("../../auxiliary/db_interaction/tickets.php");
require_once('../../auxiliary/db_interaction/users.php');

startSession();

if ($_GET) {
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];
    if (!empty($limit) && !is_null($offset)) {

        $db_path = '../../../db/app.db';
        $pdo = connectToDB($db_path);

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

        foreach ($tickets as &$ticket) {
            $hashtags = getTicketHashtags($pdo, $ticket['id']);
            $snippets = array(
                "Status" => $ticket['ticket_status'],
                "Hashtags" => implode(" ", array_map('htmlspecialchars', $hashtags))
            );
            $ticket["snippets"] = $snippets;
        }

        // Encoding array in JSON format
        echo json_encode($tickets);

        http_response_code(200);
    }
} else {
    http_response_code(405);
}
