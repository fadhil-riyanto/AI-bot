<?php

$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);

// $reply = time_ai($udahDiparse);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// exit;
if (isset($promote_uid) && isset($udahDiparse)) {
    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid,
        'permissions' => '{"can_send_messages": true, "can_send_media_messages": true, "can_send_polls": true, "can_send_other_messages": true, "can_invite_users": true}'
    );
    $telegram->restrictChatMember($param_promote);

    //debug
    $reply = $unamepromote . ', dibunyikan. Selamat!!!.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $reply = 'ups, anda harus mereply user yang ingin diunmute.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
