<?php
include_once('../../auxiliary/routing/checkURI.php');

function buildSnippets($snippets)
{
    $htmlStr = "";
    foreach ($snippets as $label => $value) {
        if (!empty($value)) {
            switch ($label) {
                case 'Status':
                    $htmlStr .= <<<HTML
                        <div class="{$value}-bubble status-bubble">
                            <p>{$value}</p>
                        </div>
                    HTML;
                    break;
                case 'Hashtags':
                    $htmlStr .= <<<HTML
                        <div class="hashtag-bubble status-bubble">
                            <p>{$label}: {$value}</p>
                        </div>
                    HTML;
                    break;
                default:
                    $htmlStr .= <<<HTML
                        <p class="mx-small">{$label}: {$value}</p>
                    HTML;
                    break;
            }
        }
    }
    return $htmlStr;
}

/**
 * Builds a department's entry on the departments list
 * @param $id - id of the department
 * @param $name - name of the department
 * @param $ticket_num - number of tickets in the department
 * @param $user_num - number of users associated with the department
 * @return HTML of the template
 */
function listEntry($url, $id, $name, $snippets)
{
    $snippetGetter = 'buildSnippets';
    return <<<HTML
    <a class="w-full" href="{$url}?id={$id}">
        <div class="list-item-card container-box container-box-interactable">
            <h3>{$name}</h3>
            <div class="simple-flex-row items-center">
                {$snippetGetter($snippets)}
            </div>
        </div>
    </a>
    HTML;
}