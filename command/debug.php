<?php
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

$h = username_resolver($udahDiparse);
$reply = $h['id'];
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
