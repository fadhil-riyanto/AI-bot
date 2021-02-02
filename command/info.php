<?php
$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Saya bot Fadhil Riyanto. Hobi saya bermain komputer dan membuat program' . PHP_EOL . PHP_EOL . 'Teknologi yang saya gunakan ialah. ' . PHP_EOL . 'Server: nginx' . PHP_EOL . 'Database: Mysql' . PHP_EOL . 'Cloud: Heroku, 000webhost' . PHP_EOL . 'PHP: 8.0.0 thread safe' . PHP_EOL . 'Versi bot: 9.7.3 alpha' . PHP_EOL . PHP_EOL . ' Dibuat dengan Cinta oleh @fadhil_riyanto' . PHP_EOL . PHP_EOL .  'Semoga bot ini membantu.';

	$option = array(
		//First row
		array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = "https://t.me/fadhil_riyanto_project"), $telegram->buildInlineKeyBoardButton("❓ Help", $url = "", $callback_data = '/help@fadhil_riyanto_bot')),
		//Second row 

	);
	$keyb = $telegram->buildInlineKeyBoard($option);
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'reply_markup' => $keyb, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);