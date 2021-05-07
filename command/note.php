<?php
$reply = "fitur ini sedang dalam pengembangan, command ter-claim : /my_note, /del_note. /clear_note";
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
die();
$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan note yang mau disimpan.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $getDataafku = $db->run(
        "SELECT * FROM note WHERE userid = ?",
        $userID
    );

    foreach ($getDataafku as $noteName) {
        if (strtolower($udahDiparse) == strtolower($noteName['notename'])) {
            $kataada = true;
        }
    }
    if ($kataada == true) {
        $reply = "maaf, note name yang anda masukan telah tersedia di database";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
    }

    $reply = $udahDiparse;
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
