<?php

$date = exec("date");

if (empty($_GET['log']))
{
    echo "Log file not specified.";
    die();
} else {
    $log = $_GET['log'] . "_facebook_log.txt";
    if(!file_exists($log)){
        echo "Log file not exists.";
        die();
    }    
    file_put_contents($log,"Last cleared: " . $date);
    echo '"' . $_GET['log'] . '" file cleared.';
}    

?>