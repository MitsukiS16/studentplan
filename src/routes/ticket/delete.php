<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('../../auxiliary/routing/redirect.php');
require_once('../../auxiliary/db_interaction/db.php');
require_once('../../auxiliary/db_interaction/tickets.php');
require_once('../../auxiliary/session_interaction/session.php');

startSession();

$id = $_POST['id'];

if (!isUserLoggedIn()) {
    redirectTo('sign-in');
}

if (!is_null($id)) {
    $db_path = '../../../db/app.db';
    $pdo = connectToDB($db_path);

    $ticket = getTicketByID($pdo, $id);
    $ticket_hashtags = getTicketHashtagRelations($pdo, $id);

    if ($ticket['creator_id'] !== getSessionUserID()) {
        $session_role = getSessionUserRole();
        if ($session_role !== 'admin' && $session_role !== 'agent') {
            redirectTo('403');
        }
    }

    $delete_hashtag_success = deleteTicketHashtagRelations($pdo, $id);
    $delete_comments_success = deleteTicketCommentRelations($pdo, $id);
    $delete_success = deleteTicket($pdo, $id);

    if ($delete_success) {
        setSessionMessage("Ticket deleted successfully.");
    } else {
        setSessionMessage("Error deleting ticket.");
    }

    redirectToRoot();
} else {
    redirectTo('404');
}
