<?php
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://serv2-fadhilbot.herokuapp.com/madeline/a.php?u=' . $udahDiparse);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);

$reply = $output;
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
