<?php
// $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// $db->where("paste_id", $explodeparse_pastebin[1]);
// $user = $db->getOne("pastebin");

//postgresql
if ($db_error_koneksi != true) {
    $user = $db->row(
        "SELECT * FROM pastebin WHERE paste_id = ?",
        $explodeparse_pastebin[1]
    );

    if ($user['data'] == null) {
        $reply = "ups, paste tidak ditemukan";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = "paste dari pengguna <a href=\"tg://user?id=" . $user['userid'] . "\">#" . $user['userid'] . "</a>" . PHP_EOL . PHP_EOL .
            $user['data'];
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);

        // $reply = "paste dari pengguna anonymous" . PHP_EOL . PHP_EOL .
        //     $user['data'];
        // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        // $telegram->sendMessage($content);
    }
} else {
    $reply = EXCEPTION_SYSTEM_ERROR_MESSAGE;
    $option = array(
        array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = SUPPORT_GROUP))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
