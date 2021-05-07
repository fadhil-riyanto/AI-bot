<?php

$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);
$udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ', '', $text_plain_nokarakter);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan note yang mau disimpan.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $getDataafku = $db->row(
        "SELECT * FROM note WHERE userid = ? AND notename = ?",
        $userID,
        $udahDiparse
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
        $reply = "maaf, note name yang anda cari tidak ditemukan, cek nama dan besar kecil huruf";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = "<u>Note : " . $getDataafku['notevalue'] . "</u>" . PHP_EOL  . PHP_EOL  .
            $getDataafku['notevalue'];
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
