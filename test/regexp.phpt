<?php
$text = 'var nama = "fadhil";';
preg_match('/var ([a-zA-Z0-9])=([a-zA-Z0-9])/i', $text, $hasil);
var_dump($hasil);
