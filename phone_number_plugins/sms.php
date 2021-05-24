<?php
require __DIR__ . '/nomor_telfon_list.php';
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'text' => 'ngetessssssssss', 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$sms_result = $telegram->sendMessage($content);

require __DIR__ . '/sms_initdb.php';

$deteksiid = $sms_db_cache->findOneBy(["userid", "=", $userID]);
// if ($deteksiid['userid'] !== null) {
//     $sms_db_cache->deleteBy(["userid", "=", $userID]);
// }

$reply = json_encode($deteksiid);
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
die();

$data_input = [
    "msgid" => $sms_result['result']['message_id'],
    "userid" => $userID
];
$results = $sms_db_cache->insert($data_input);
