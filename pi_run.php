<?php

require_once(__DIR__ .'/init.php');

try {
    $camera = new Classes\Camera();
    $server = new Classes\Pi("");
    $fileName = $camera->makeShot();
    $server->sendToServer($fileName);
} catch (\Exception $e) {
    logger($e->getMessage());
}
