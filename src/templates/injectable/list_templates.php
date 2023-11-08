<?php
include_once('../../auxiliary/routing/checkURI.php');

function listEntry($url, $id, $name)
{
    return <<<HTML
    <a class="w-full" href="{$url}?id={$id}">
        <div class="list-item-card container-box container-box-interactable">
            <h3>{$name}</h3>
        </div>
    </a>
    HTML;
}
