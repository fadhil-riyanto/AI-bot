<?php

//$q = mysqli_query($koneksi, "SELECT * FROM `grup_data` WHERE `gid` LIKE '$udahDiparse' ");
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("gid", $chat_id);
$user = $db->getOne("grup_data");
if ($user['rules_group'] == null) {

    $reply = 'ups, admin group belum mengatur pengaturan untuk grup ini, itu bukan berati grup ini tidak ada aturan. Anda tetap harus berlaku sopan';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($user['rules_group'] != null) {
    $reply = $user['rules_group'];
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
