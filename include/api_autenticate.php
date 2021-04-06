<?php
require __DIR__ . '/../pengaturan/env.php';
require __DIR__ . '/../vendor/autoload.php';

function cek_kredensial_api($apikey)
{
    $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db->where("userid", $userID);
    $user = $db->getOne("afk_user_data");
}
