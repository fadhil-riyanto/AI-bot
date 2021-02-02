<?php
if ($userID == $userid_pemilik) {
    $content = array('chat_id' => '@fadhil_riyanto_project');
    $telegram->leaveChat($content);
}
