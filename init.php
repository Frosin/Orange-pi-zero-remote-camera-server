<?php

spl_autoload_register(function ($className)
{
    $className = str_replace("\\", "/", $className);
    require_once(__DIR__. "/$className.php");
});

function logger($data)
{
    file_put_contents(__DIR__ . "/". basename(__FILE__) . "-log-errors.log", date("d.m.Y H:i:s") . ": \n" . print_r($data , 1) . "\n", FILE_APPEND);
}
