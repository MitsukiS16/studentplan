<?php
include_once('../../auxiliary/routing/checkURI.php');


/**
 * Builds a ticket's message
 * @param $user_id - id of the message's creator
 * @param $username - username of the message's creator
 * @param $user_img_src - image source of the message's creator
 * @param $registered_at - date when the message's creator registered in the website
 * @param $ticket_num - number of tickets created by the message's creator
 * @param $comment_num - number of comments made by the message's creator
 * @param $msg_content - content of the message
 * @param $msg_date - date the message was created in
 * @return HTML of the template
 */
function messageTemplate($user_id, $username, $user_img_src, $registered_at, $ticket_num, $comment_num, $msg_content, $msg_date)
{
    $user_id = htmlspecialchars($user_id);
    $username = htmlspecialchars($username);
    $user_img_src = htmlspecialchars($user_img_src);
    $registered_at = htmlspecialchars($registered_at);
    $ticket_num = htmlspecialchars($ticket_num);
    $comment_num = htmlspecialchars($comment_num);
    $msg_content = htmlspecialchars($msg_content);
    $msg_date = htmlspecialchars($msg_date);

    return <<<HTML
        <div class="ticket-message container-box">
            <div class="ticket-message-userinfo">
                <div class="header-user">
                    <img class="ticket-user-pic" src="{$user_img_src}" alt="User Picture"> <!-- get user picture -->
                    <a href = "/profile?id={$user_id}"> <p class="text-bold">{$username}</p> </a>
                </div>
                <div class="status-ticket">
                    <p><span class="light-gray-color">Registered: </span>{$registered_at}</p>
                    <p><span class="light-gray-color">Tickets: </span>{$ticket_num}</p>
                    <p><span class="light-gray-color">Comments: </span>{$comment_num}</p>
                </div>
            </div>
            <div class="ticket-main">
                <div class="ticket-content">
                    <p>{$msg_content}</p>
                </div>
                <div class="ticket-date">
                    <p>{$msg_date}</p>
                </div>
            </div>
        </div>
    HTML;
}
