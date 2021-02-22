<?php
$file = __DIR__ . '/../json_data/afk.json';
$anggota = file_get_contents($file);
$data = json_decode($anggota, true);
foreach ($data as $key => $d) {
    if ($d['userid'] === $userID) {
        array_splice($data, $key, 1);
        $reply = "anda udah tidak lagi afk";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
$anggota = file_put_contents($file, $jsonfile);
