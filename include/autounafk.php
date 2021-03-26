<?php


function deteksi_grupP()
{
    global $chat_id;
    $pregs = substr($chat_id, 0, 1);
    if ($pregs == '-') {
        return true;
    }
}
if (deteksi_grupP() == true) {

    $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db->where('userid', $userID);
    $user = $db->getOne("afk_user_data");

    if ($cekher_diri != NULL) {
        $reply = "anda sudah tidak afk";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);

        $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db->where('userid', $userID);
        $user = $db->getOne("afk_user_data");

        $db->delete('afk_user_data');
    }
}
