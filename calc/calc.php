<?php
require __DIR__ . '/keyboard.php';
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Kalkulator");
$calc_result = $telegram->sendMessage($content);

require __DIR__ . '/calc_initdb.php';
//deteksi apakah user telah berinteraksi sebelumnya dengan command ini
$deteksiid = $calc_db_cache->findOneBy(["userid", "=", $userID]);
if ($deteksiid['userid'] !== null) {
    $calc_db_cache->deleteBy(["userid", "=", $userID]);
}

// $reply = json_encode($deteksiid);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// die();

$data_input = [
    "msgid" => $calc_result['result']['message_id'],
    "stdin_input" => null,
    "userid" => $userID
];
$results = $calc_db_cache->insert($data_input);
