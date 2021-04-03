<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../pengaturan/env.php';

$resolvetest = '@oh_yoon_hee ok';

$regexp = '/\@[a-zA-Z0-9_]+/';
preg_match_all($regexp, $resolvetest, $hasil);
$username = $hasil[0][0];

$checkat = substr($username, 0, 1);
if ($checkat == '@') {
    $replaceusername = str_replace('@', '', $username);
} else {
    $replaceusername = $username;
}

// echo $replaceusername;
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("username", $replaceusername);
$user = $db->getOne("username_dict");

// echo $user['id'];
if ($user['username'] == null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://serv2-fadhilbot.herokuapp.com/madeline/a.php?u=' . $replaceusername);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
}
