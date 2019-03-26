<?php

spl_autoload_register(function ($className)
{
    $className = str_replace("\\" , "/" , $className);
    require_once(__DIR__ . "/$className.php");
});


try {
    $memcache = (new Classes\Memory())->add("test", "testvalue", 180);
    echo $memcache->get('test');
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}

