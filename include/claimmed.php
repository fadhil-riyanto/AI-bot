<?php

if (
    '/c' == $adanParse[0] || '/c' . USERNAME_BOT . '' == $adanParse[0] ||
    '/price' == $adanParse[0] || '/price' . USERNAME_BOT . '' == $adanParse[0] ||
    '/cc' == $adanParse[0] || '/cc' . USERNAME_BOT . '' == $adanParse[0] ||
    '/tban' == $adanParse[0] || '/tban' . USERNAME_BOT . '' == $adanParse[0] ||
    '/hack' == $adanParse[0] || '/hack' . USERNAME_BOT . '' == $adanParse[0] ||
    '/game' == $adanParse[0] || '/game' . USERNAME_BOT . '' == $adanParse[0]
) {
    $reply = 'ups, command ini sedang dalam pengembangan';
    $content = array('chat_id' => $chat_id, 'text' => $reply,   'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
}
