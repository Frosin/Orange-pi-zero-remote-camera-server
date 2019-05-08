<?php

require_once('init.php');

if (isset($_REQUEST['getphotocommand'])) {
    try {
        if ($_REQUEST['getphotocommand'] == 1) {
            (new Classes\Server())->getFile();
        } else if ($_REQUEST['getphotocommand'] == 2) {
            (new Classes\Server())->getAllFiles();
        }
    } catch (Exception $e) {
        logger($e->getMessage());
    }
} 


