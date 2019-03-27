<?php

require_once('init.php');

if (isset($_REQUEST['getphotocommand']) && $_REQUEST['getphotocommand'] == 1) {
    try {
        (new Classes\Server())->getFile();
    } catch (Exception $e) {
        logger($e->getMessage());
    }
    
}
