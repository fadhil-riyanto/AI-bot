<?php
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("gid", $chat_id);
$user = $db->getOne("grup_data");
if ($user == null) {
    $data = array(
        "gid" => $chat_id,
        "welcome_text" =>  null,
        "leaveuser_text" => null,
        "rules_group" => null,
        "chapcha" => 'off',
        "set_welcome_mode" => null,
        "set_leaveuser_mode" => null
    );


    $id = $db->insert('grup_data', $data);

    $reply = 'init untuk grup ini telah dibuat';
    $content1 = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content1);
} else {
    $reply = 'maaf, init untuk grup ini telah dibuat sebelum nya';
    $content1 = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content1);
}
