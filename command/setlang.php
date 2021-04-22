<?php

if (isset($adanParse[1])) {
    $data = array(
        'bahasa' => $adanParse[2]
    );
    $db->where('userid', $adanParse[1]);
    if ($db->update('members', $data)) {
        if ($adanParse[2] == "id_id") {
            $jawabquery = $telegram->getData();
            $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'Bahasa diubah ke Indonesia', 'show_alert' => true);
            $telegram->answerCallbackQuery($alswecl);
        } elseif ($adanParse[2] == "en_en") {
            $jawabquery = $telegram->getData();
            $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'Language changed to English', 'show_alert' => true);
            $telegram->answerCallbackQuery($alswecl);
        }
        die();
    } else {
        $content = array('chat_id' => $chat_id, 'text' => "maaf, kami tidak bisa memperbarui database. coba lagi nanti");
        $telegram->sendMessage($content);
        die();
    }
}
$option = array(
    array(
        $telegram->buildInlineKeyBoardButton("🇮🇩 Indonesia", $url = "", $callback_data = "/setlang@Fadhil_riyanto_bot " . $userID . " " . "id_id"),
        $telegram->buildInlineKeyBoardButton("🇬🇧 English", $url = "", $callback_data = "/setlang@Fadhil_riyanto_bot " . $userID . " " . "en_en")
    ),
);
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Pilih bahasa yang akan dipergunakan" . PHP_EOL . PHP_EOL .
    "select your language");
$telegram->sendMessage($content);
