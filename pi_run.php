<?php

require_once(__DIR__ .'/init.php');

$uploadScript = file_get_contents('uploadScript.txt');

try {
    $camera = new Classes\Camera();
    $server = new Classes\Pi($uploadScript);
    $fileName = $camera->makeShot();
    $server->sendToServer($fileName);
} catch (\Exception $e) {
    logger($e->getMessage());
}




