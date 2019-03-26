<?php

spl_autoload_register(function ($className)
{
    $className = str_replace("\\" , "/" , $className);
    require_once(__DIR__ . "/$className.php");
});

try {
    $camera = new Classes\Camera();
    $server = new Classes\Server("url to my server");
    $fileName = $camera->makeShot();
    $server->sendToServer($fileName);
} catch (Exception $e) {
    file_put_contents(__DIR__ . "/log-errors.log", date("d.m.Y H:i:s") . ": \n" . print_r($e->getMessage() , 1) . "\n", FILE_APPEND);
}

