<?php

use \Brush\Pastes\Draft;
use \Brush\Accounts\Developer;
use \Brush\Exceptions\BrushException;

$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan kode yang akan disimpan di pastebin";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {


    $draft = new Draft(); // drafts represent unsent pastes
    $draft->setContent($udahDiparse); // set the paste content
    $developer = new Developer(PASTEBIN_API);

    try {
        // send the draft to Pastebin; turn it into a full blown Paste object
        $paste = $draft->paste($developer);

        // print out the URL of the new paste
        //echo $paste->getUrl(); // e.g. https://ppastebin.com/JYvbS0fC
        $reply = "yey bisa, link pastebin kamu adalah " . $paste->getUrl();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } catch (BrushException $e) {
        // some sort of error occurred; check the message for the cause
        echo $e->getMessage();
        $reply = "ups ada kesalahan" . PHP_EOL . "debug : " . $e->getMessage();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
