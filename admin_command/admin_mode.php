<?php
if ($adanParse[1] == 'on') {
    $ijin = '{
        "can_send_messages": false
    }';
    $konten = array('chat_id' => $chat_id, 'permissions' => $ijin);
    $telegram->setChatPermissions($konten);

    $reply = 'grup ditutup, semua anggota tidak diperbolehkan mengirim pesan';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($adanParse[1] == 'off') {
    $ijin = '{
        "can_send_messages": true,
        "can_send_media_messages": true,
        "can_send_other_messages": true,
        "can_invite_users": true,
        
    }';
    $konten = array('chat_id' => $chat_id, 'permissions' => $ijin);
    $telegram->setChatPermissions($konten);

    $reply = 'grup dibuka, semua anggota diperbolehkan mengirim pesan';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($adanParse[1] == null) {
    $reply = 'ups, anda harus on atau off';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $reply = 'ups, anda harus on atau off';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
