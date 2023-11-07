<?php
include_once('../../auxiliary/routing/checkURI.php');

require_once('../../auxiliary/routing/redirect.php');
require_once('../../auxiliary/db_interaction/db.php');
require_once('../../auxiliary/db_interaction/tickets.php');
require_once('../../auxiliary/db_interaction/hashtags.php');
require_once('../../auxiliary/session_interaction/session.php');

startSession();

if (!isUserLoggedIn()) {
    redirectTo('sign-in');
}

$user_id = getSessionUserID();
$title = $_POST['title'];
$content = $_POST['content'];
$department_id = $_POST['department'];
// if no hashtags are passed, the hashtags value is an empty string
// explode would return an array with 1 element containing an empty string
$hashtags = empty($_POST['hashtags']) ? array() : explode(',', $_POST['hashtags']);

if (empty($title) || empty($content) || empty($department_id)) {
    header('Error - missing fields');
    exit;
}

$db_path = '../../../db/app.db';
$pdo = connectToDB($db_path);

createTicket($pdo, $title, $content, $user_id, $department_id);
$ticket_id = $pdo->lastInsertId();

foreach ($hashtags as $ht) {
    $hashtag = getHashtagsByTitle($pdo, $ht);

    if (!$hashtag) {
        createHashtag($pdo, $ht);
        $hashtag_id = $pdo->lastInsertId();
    } else {
        $hashtag_id = $hashtag['id'];
    }

    addTicketHashtagRelation($pdo, $ticket_id, $hashtag_id);
}

redirectTo('ticket?id=' . $ticket_id);
