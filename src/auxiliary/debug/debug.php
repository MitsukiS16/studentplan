<?php
include_once('../routing/checkURI.php');

function printToConsole($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('$output');</script>";
}

function echoLineBreak()
{
    echo "<br/>";
}
