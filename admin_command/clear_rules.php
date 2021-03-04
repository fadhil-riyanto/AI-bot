<?php
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("gid", $chat_id);
$user = $db->getOne("grup_data");
if ($user['rules_group'] == null) {
    $reply = 'clear dibatalkan karna grup ini tidak mempunyai peraturan';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $data = array(
        "rules_group" => null
    );
    $db->where('gid', $chat_id);
    if ($db->update('grup_data', $data)) {
        $reply = 'peraturan grup dihapus!';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = "ups, ada kesalahan!. Penyebab : " . $db->getLastError();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
