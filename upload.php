<?php

require_once('init.php');

try {
    (new Classes\Server())->setFile();
} catch (\Exception $e) {
    logger($e->getMessage());
}

