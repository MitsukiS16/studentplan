<?php
include_once('../../auxiliary/routing/checkURI.php');

/**
 * Builds a profile's information template
 * @param $profile_info - array with the profile's information. Keys contain are the title/description of their respective values.
 * @return HTML of the template
 */
function profileInfoTemplate($profile_info)
{
    $htmlStr = "";
    foreach ($profile_info as $key => $db_info) {
        $value = htmlspecialchars($db_info);
        $htmlStr .= <<<HTML
            <li>
                <h2>{$key}</h2>
                <h3>{$value}</h3>
            </li>
        HTML;
    }
    return $htmlStr;
}