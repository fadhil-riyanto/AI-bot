<?php
if ($userID == $userid_pemilik) {

    $content = array('chat_id' => $chat_id, 'text' => $reply);
    $telegram->sendMessage($content);
}
