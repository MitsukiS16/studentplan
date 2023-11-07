<?php

include_once('../../auxiliary/routing/checkURI.php');

require_once('../../auxiliary/routing/redirect.php');
require_once("../../auxiliary/db_interaction/db.php");
require_once('../../auxiliary/db_interaction/tickets.php');
require_once('../../auxiliary/db_interaction/hashtags.php');

date_default_timezone_set('Europe/Lisbon');

if (($_POST)) {
    if (!$_POST["id"]) {
        exit;
    }

    $id = $_POST['id'];

    $db_path = '../../../db/app.db';
    $pdo = connectToDB($db_path);

    $ticket = getTicketByID($pdo, $id);

    $db_hashtags = getTicketHashtags($pdo, $id);

    if (!empty($_POST['title']) && !($title == $ticket['title'])) {
        updateTicketVar($pdo, $id, 'title', $_POST['title']);
        updateTicketVar($pdo, $id, 'updated_at', date('Y-m-d H:i:s'));
    }

    if (!empty($_POST['content']) && !($content == $ticket['content'])) {
        updateTicketVar($pdo, $id, 'content', $_POST['content']);
        updateTicketVar($pdo, $id, 'updated_at', date('Y-m-d H:i:s'));
    }

    if (!empty($_POST['department']) && $ticket['department_id'] != $_POST['department']) {
        updateTicketVar($pdo, $id, 'department_id', $_POST['department']);
        updateTicketVar($pdo, $id, 'updated_at', date('Y-m-d H:i:s'));
    }

    $new_status = $_POST['status'];
    if (!empty($new_status)) {
        if ($new_status === 'assigned') {
            $new_agent = $_POST['agent'];
            if (!empty($new_agent)) {
                updateTicketVar($pdo, $id, 'ticket_status', $new_status);
                updateTicketVar($pdo, $id, 'assign_id', $new_agent);
                updateTicketVar($pdo, $id, 'updated_at', date('Y-m-d H:i:s'));
            }
        } else {
            if ($ticket['ticket_status'] !== $new_status) {
                updateTicketVar($pdo, $id, 'ticket_status', $new_status);
                updateTicketVar($pdo, $id, 'assign_id', "NULL");
                updateTicketVar($pdo, $id, 'updated_at', date('Y-m-d H:i:s'));
            }
        }
    }

    // if no hashtags are passed, the hashtags value is an empty string
    // explode would return an array with 1 element containing an empty string
    $hashtags = empty($_POST['hashtags']) ? array() : explode(',', $_POST['hashtags']);
    if ($db_hashtags != $hashtags) {
        deleteTicketHashtagRelations($pdo, $id);

        // insert new hashtags
        foreach ($hashtags as $ht) {
            if (empty($ht)) {
                continue;
            }
            $hashtag = getHashtagsByTitle($pdo, $ht);

            if (!$hashtag) {
                createHashtag($pdo, $ht);
                $hashtag_id = $pdo->lastInsertId();
            } else {
                $hashtag_id = $hashtag['id'];
            }

            addTicketHashtagRelation($pdo, $id, $hashtag_id);
        }
    }
}


redirectTo('ticket?id=' . $id);
