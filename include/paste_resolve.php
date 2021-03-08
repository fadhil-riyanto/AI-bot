<?php
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("paste_id", $explodeparse_pastebin[1]);
$user = $db->getOne("pastebin");
if ($user['data'] == null) {
    $reply = "ups, paste tidak ditemukan";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $reply = "paste dari pengguna <a href=\"tg://user?id=" . $user['userid'] . "\">#" . $user['userid'] . "</a>" . PHP_EOL . PHP_EOL .
        $user['data'];
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
