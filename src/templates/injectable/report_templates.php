<?php
include_once('../../auxiliary/routing/checkURI.php');


function messageTemplate($user_id, $username, $user_img_src, $registered_at, $ticket_num, $comment_num, $msg_content, $msg_date)
{
    $user_id = htmlspecialchars($user_id);
    $username = htmlspecialchars($username);
    
    return <<<HTML
        <div class="ticket-message container-box">
            <div class="ticket-message-userinfo">
                <div class="header-user">
                    <a href = "/profile?id={$user_id}"> <p class="text-bold">{$username}</p> </a>
                </div>
            </div>
        </div>
    HTML;
}