<?php

$reply = 'Warning: Uncaught Error: Call to undefined function download() in php shell code:1
Stack trace:
#0 {main}
  thrown in php shell code on line 1';
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$editmsg = $telegram->sendMessage($content);

$getinfoDir = $telegram->getFile($fileid);
$dirTgid = $getinfoDir['result']['file_path'];
$downloadingimg = downloadUrlToFile('https://api.telegram.org/file/bot' . TG_HTTP_API . '/' . $dirTgid, 'tmp/pict_uploader.png');
