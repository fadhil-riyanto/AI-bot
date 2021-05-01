<?php
define('CR', chr(13));
define('LF', chr(10));

function runcode($cond = '')
{
    $cond = trim($cond);
    if ($cond == '') return 'Success (condition was empty).';
    $result = false;
    $cond = '$result = ' . str_replace(array(CR, LF), ' ', $cond) . ';';
    try {
        $success = eval($cond);
        if ($success === false) return 'Error: could not run expression.';
        return   PHP_EOL . PHP_EOL . 'Success (condition return ' . ($result ? 'true' : 'false') . ').';
    } catch (Exception $e) {
        return 'Error: exception ' . get_class($e) . ', ' . $e->getMessage() . '.';
    }
}
echo test("print(\"okay\");");
