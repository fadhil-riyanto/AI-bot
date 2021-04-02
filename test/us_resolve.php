<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';

$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("userid", $userID);
$user = $db->getOne("afk_user_data");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://serv2-fadhilbot.herokuapp.com/madeline/a.php?u=' . $udahDiparse);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
