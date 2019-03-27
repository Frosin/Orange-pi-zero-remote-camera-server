<?php

/****      for testing shell exec create photo  - copying random photo fron `test_img` into current directory ****/

$directory = __DIR__ . '/test_img';
$directory = array_values(array_diff(scandir($directory), array('..', '.')));

$count = count($directory) - 1;

$num = rand(0, $count);

$file = __DIR__ . "/test_img/". $directory[$num];


if (!copy($file, __DIR__ . '/shot.jpg')) {
    file_put_contents(__DIR__ . "/log-fuck.log", "CANT COPY\n", FILE_APPEND);
};
