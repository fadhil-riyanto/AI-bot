<?php

// $db->where("gid", $chat_id);
// $user = $db->getOne("grup_data");
$user = $db->row(
    "SELECT * FROM grup_data WHERE gid = ?",
    $chat_id
);
if ($user == null) {
    // $data = array(
    //     "gid" => $chat_id,
    //     "welcome_text" =>  null,
    //     "leaveuser_text" => null,
    //     "rules_group" => null,
    //     "captcha" => 'off',
    //     "set_welcome_mode" => null,
    //     "set_leaveuser_mode" => null
    // );


    // $id = $db->insert('grup_data', $data);
    $db->insert('grup_data', [
        "gid" => $chat_id,
        "welcome_text" =>  null,
        "leaveuser_text" => null,
        "rules_group" => null,
        "captcha" => 'off',
        "set_welcome_mode" => null,
        "set_leaveuser_mode" => null,
        "act_filters_detect" => null,
        "filters_hukuman" => null,
        "filter_notify" => null
    ]);

    $reply = 'init untuk grup ini telah dibuat';
    $content1 = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content1);
} else {
    $reply = 'maaf, init untuk grup ini telah dibuat sebelum nya';
    $content1 = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content1);
}
