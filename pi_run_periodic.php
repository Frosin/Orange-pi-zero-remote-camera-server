<?php

require_once(__DIR__ . '/vendor/autoload.php');

require_once(__DIR__ .'/init.php');
$uploadScript = file_get_contents('uploadScript.txt');

$loop = React\EventLoop\Factory::create();

$camera = new Classes\Camera();
$server = new Classes\Pi($uploadScript);



$timer = $loop->addPeriodicTimer(1, function () use($uploadScript, $camera, $server) {
    try {
        $fileName = $camera->makeShot();
        $server->sendToServer($fileName);
    } catch (\Exception $e) {
        logger($e->getMessage());
    }
});

$loop->run();