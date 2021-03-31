<?php
require __DIR__ . '/../pengaturan/env.php';
require __DIR__ . '/../vendor/autoload.php';


$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("chat_id", -1001209274058);
$getDataafku = $db->get("filters_word_data");
//$tojson_banlist = json_encode($getDataafku);
// echo $tojson_banlist;
$text_plain_nokarakter = 'ngetesbadword';
foreach ($getDataafku as $katablock) {
    $a = explode(' ', $text_plain_nokarakter);
    foreach ($a as $aa) {
        if (strtolower($aa) == strtolower($katablock['word'])) {
            echo 'detect';
        }
    }
}
