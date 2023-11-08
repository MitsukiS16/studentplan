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
