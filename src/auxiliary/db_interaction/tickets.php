<?php
include_once('../routing/checkURI.php');

function getAllTickets($pdo)
{
    return $pdo->query("SELECT * FROM TICKETS;")->fetchAll(PDO::FETCH_ASSOC);
}

function getTicketsChunk($pdo, $limit, $offset)
{
    $query = $pdo->prepare("SELECT * FROM TICKETS LIMIT ? OFFSET ?");
    $query->execute([$limit, $offset]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTicketByID($pdo, $id)
{
    $query = $pdo->prepare("SELECT * FROM TICKETS WHERE id=?");
    $query->execute([$id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getTicketHashtagRelations($pdo, $ticket_id)
{
    $query = $pdo->prepare("SELECT * FROM TICKET_HASHTAGS WHERE ticket_id=?");
    $query->execute([$ticket_id]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTicketHashtags($pdo, $ticket_id)
{
    $stmt = $pdo->prepare('SELECT title FROM HASHTAGS JOIN TICKET_HASHTAGS ON HASHTAGS.id = TICKET_HASHTAGS.hashtag_id WHERE TICKET_HASHTAGS.ticket_id = ?');
    $stmt->execute([$ticket_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getTicketUserCount($pdo, $user_id)
{
    $countquery = $pdo->prepare("SELECT COUNT(*) as TICKET_COUNT 
                                FROM TICKETS
                                 WHERE creator_id = ?");
    $countquery->execute([$user_id]);
    $data = $countquery->fetch(PDO::FETCH_ASSOC);

    return $data["TICKET_COUNT"];
}

function getCommentUserCount($pdo, $user_id)
{
    $countquery = $pdo->prepare("SELECT COUNT(*) as COMMENT_COUNT 
                                FROM COMMENTS
                                 WHERE user_id = ?");
    $countquery->execute([$user_id]);
    $data = $countquery->fetch(PDO::FETCH_ASSOC);

    return $data["COMMENT_COUNT"];
}

function getTicketAndCreatorData($pdo, $ticket_id)
{
    $query = $pdo->prepare("SELECT t.*, u.username AS creator_username, u.picture AS creator_picture, u.created_at AS creator_created_at
                                    FROM TICKETS t
                                    JOIN USERS u ON t.creator_id = u.user_id
                                    WHERE t.id = ?");
    $query->execute([$ticket_id]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getTicketCommentsAndCreatorData($pdo, $ticket_id)
{
    $query = $pdo->prepare("SELECT c.*, u.picture AS commenter_picture, u.user_id AS commenter_id, u.username AS commenter_username, u.created_at AS commenter_created_at
    FROM COMMENTS c
    JOIN USERS u ON c.user_id = u.user_id
    WHERE c.ticket_id = ?");
    $query->execute([$ticket_id]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function createTicket($pdo, $title, $content, $user_id, $department_id)
{
    $stmt = $pdo->prepare('INSERT INTO TICKETS (title, content, creator_id, department_id) VALUES (:title, :content, :creator_id, :department_id)');
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':content', $content);
    $stmt->bindValue(':creator_id', $user_id);
    $stmt->bindValue(':department_id', $department_id);
    $stmt->execute();
}

function updateTicketVar($pdo, $id, $var, $value)
{
    $query = $pdo->prepare("UPDATE TICKETS SET $var = ? WHERE id = ?");
    $query->execute([$value, $id]);
}

function createComment($pdo, $content, $ticket_id, $user_id)
{
    $create_comment_query = $pdo->prepare('INSERT INTO COMMENTS (content, ticket_id, user_id) VALUES (:content, :ticket_id, :user_id)');
    $create_comment_query->bindValue(":content", $content);
    $create_comment_query->bindValue(":ticket_id", $ticket_id);
    $create_comment_query->bindValue(":user_id", $user_id);
    $create_comment_query->execute();
}

function addTicketHashtagRelation($pdo, $ticket_id, $hashtag_id)
{
    $query = $pdo->prepare("INSERT INTO TICKET_HASHTAGS (ticket_id, hashtag_id) VALUES (?, ?)");
    $query->execute([$ticket_id, $hashtag_id]);
}

function deleteTicketHashtagRelations($pdo, $ticket_id)
{
    $query = $pdo->prepare("DELETE FROM TICKET_HASHTAGS WHERE ticket_id=?");
    return $query->execute([$ticket_id]);
}

function deleteTicketCommentRelations($pdo, $ticket_id)
{
    $query = $pdo->prepare("DELETE FROM COMMENTS WHERE ticket_id=?");
    return $query->execute([$ticket_id]);
}

function deleteTicket($pdo, $ticket_id)
{
    $query = $pdo->prepare("DELETE FROM TICKETS WHERE id=?");
    return $query->execute([$ticket_id]);
}
