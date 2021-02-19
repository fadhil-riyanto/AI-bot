<?php
$result = $telegram->getData();
$msgid = $result['message']['reply_to_message']['message_id'];
if ($kamu_admin == true) {
    if (isset($msgid)) {
        $content = array('chat_id' => $chat_id, 'message_id' => $msgid);
        $boolpinchat = $telegram->unpinChatMessage($content);
    } else {
        $reply = 'Maaf, kamu harus mereply pesan yang akan diunpin';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
