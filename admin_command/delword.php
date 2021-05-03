<?php
if ($gc_command_verify == null) {
    $reply = "ups, command ini hanya berlaku di grup saja.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
}
date_default_timezone_set(TIME_ZONE);
$result = $telegram->getData();
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "maaf, anda harus memasukkan kata yang ingin dihapus dari database";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("chat_id", $chat_id);
    // $getDataafku = $db->get("filters_word_data");
    $getDataafku = $db->run(
        "SELECT * FROM filters_word_data WHERE chat_id = ?",
        $chat_id
    );

    foreach ($getDataafku as $katablock) {
        if (strtolower($udahDiparse) == strtolower($katablock['word'])) {
            $iduniq = $katablock['uniq_id'];
            $kataada = true;
        }
    }
    if ($kataada == true) {
        // $db->where('uniq_id', $iduniq);
        $deleteverify = $db->delete('filters_word_data', [
            'uniq_id' => $iduniq
        ]);
        if ($deleteverify) {
            $reply = "kata telah dihapus";
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = EXCEPTION_SYSTEM_ERROR_MESSAGE;
            $option = array(
                array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = SUPPORT_GROUP))
            );
            $keyb = $telegram->buildInlineKeyBoard($option);
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } else {
        $reply = "maaf, kata tidak ditemukan di database";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        //delete
    }
}
