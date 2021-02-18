<?php
$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Silahkan kirim laporan ke  <a href="' . SUPPORT_GROUP . '">👥 Support Group</a>' . PHP_EOL . PHP_EOL .
	'Jangan lupa sertakan Screenshot dan letak bug nya. yaaaa' . PHP_EOL . PHP_EOL .
	'Dengan kamu melaporkan bug, kamu telah membantu saya untuk membuat bot lebih baik lagi. Mimin orangnya tipe humoris kok';
$option = array(
	//First row
	// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
	// //Second row 
	// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
	// //Third row

	array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = SUPPORT_GROUP))
);
$keyb = $telegram->buildInlineKeyBoard($option);


$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
