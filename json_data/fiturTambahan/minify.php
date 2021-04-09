<?php 
$a = json_decode(file_get_contents('merge_province_postal_full.json'));
file_put_contents('merge_province_postal_full.min.json', json_encode($a));