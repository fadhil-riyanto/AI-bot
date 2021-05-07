<?php

$getDataafku = $db->run(
    "SELECT * FROM note WHERE userid = ?",
    $userID
);
// $reply = json_encode($getDataafku);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// die();

// foreach ($getDataafku as $noteName) {
//     if (strtolower($adanParse_plain_nokarakter[1]) == strtolower($noteName['notename'])) {
//         $kataada = true;
//     }
// }
if ($getDataafku == null) {
    $reply = "maaf, sepertinya anda belum membuat note apapun, kami tidak menemukan data satupun";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    foreach ($getDataafku as $notelist) {
        $listnote[] = '~ ' . $notelist['notename'];
    }
    $reply = "list note kamu : " . PHP_EOL . PHP_EOL . implode(PHP_EOL, $listnote);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
