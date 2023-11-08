<?php
include_once('../../auxiliary/routing/checkURI.php');


function messageTemplate($user_id, $username, $user_img_src, $subject)
{
    $user_id = htmlspecialchars($user_id);
    $username = htmlspecialchars($username);
    $user_img_src = htmlspecialchars($user_img_src);
    $subject = htmlspecialchars($subject);


    return <<<HTML
        <div class="ticket-message container-box">
            <div class="ticket-message-userinfo">
                <div class="header-user">
                    <img class="ticket-user-pic" src="{$user_img_src}" alt="User Picture"> <!-- get user picture -->
                    <a href = "/profile?id={$user_id}"> <p class="text-bold">{$username}</p> </a>
                </div>
                <div class="status-ticket">
                    <p><span class="light-gray-color">Registered: </span>{$subject}</p>
                </div>
            </div>
        </div>
    HTML;
}