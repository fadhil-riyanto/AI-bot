<?php
$option = array(
    //First row
    array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
    //Second row 
    array($telegram->buildInlineKeyBoardButton("base64_decode", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("get_github_user", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("base64_decode", $url = "http://link5.com")),
    //Third row
    array($telegram->buildInlineKeyBoardButton("Button 6", $url = "http://link6.com"))
);
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
$telegram->sendMessage($content);
