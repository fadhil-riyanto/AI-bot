<?php
include(__DIR__ . "/vendor/autoload.php");

use Buchin\Badwords\Badwords;

var_dump(Badwords::isDirty('dasar kontol'));

/*
when string contains bad words, it returns true
Example result:
(boolean) true 
*/

echo Badwords::strip('Blood sugar sex magic');
