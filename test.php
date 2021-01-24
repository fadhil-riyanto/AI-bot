<?php
include(__DIR__ . "/vendor/autoload.php");
$time_start = microtime(true);

//sample script
for ($i = 0; $i < 1000000000000000000000000000000000000000000000000000000000; $i++) {
    //do anything
}

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes otherwise seconds
$execution_time = ($time_end - $time_start) / 60;

echo $execution_time;
