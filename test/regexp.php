<?php
$regex = '/([-+]?\d+([-+*\/][-+]?\d+)+)/i';

preg_match_all($regex, '-8*7*6 aaaaaa', $matcher);
// print_r($matcher);
echo $matcher[0][0];
