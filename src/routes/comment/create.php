<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('../../auxiliary/routing/redirect.php');
require_once("../../auxiliary/db_interaction/db.php");
require_once("../../auxiliary/db_interaction/tickets.php");
require_once('../../auxiliary/session_interaction/session.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('sign-in');
}

$user_id = getSessionUserID();
$ticket_id = $_POST["ticket_id"];
$content = $_POST["comment_content"];
$faq_answer = $_POST["faq-select"];

if (empty($ticket_id) || (empty($content) && empty($faq_answer))) {
    header('Error - missing fields');
    exit;
}

if (!empty($faq_answer)) {
    $content = $faq_answer;
}

$db_path = '../../../db/app.db';
$pdo = connectToDB($db_path);

createComment($pdo, $content, $ticket_id, $user_id);

redirectTo('ticket?id=' . $ticket_id);
