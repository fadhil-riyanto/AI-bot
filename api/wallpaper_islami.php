<?php
require __DIR__ . '/middleware.php';

$a = json_decode(file_get_contents(__DIR__ . '/../json_data/zhirss/wallpaper/Islamic.json'));
$total = random_int(0, count($a));
$res = array(
    "error" => null,
    "result" => $a[$total]
);
render_json($res);
