<?php
$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL .
	'Saya bot milik ' . PUMBUAT_BOT .
	'. Hobi saya bermain komputer dan membuat program' . PHP_EOL . PHP_EOL .
	'Teknologi yang saya gunakan ialah. ' . PHP_EOL .
	'Server: ' . SERVER_HTTP_PLATFORM . PHP_EOL .
	'Database: ' . DATABASE_PLATFORM . PHP_EOL .
	'Cloud: ' . HOSTED_BY . PHP_EOL .
	'PHP: ' . phpversion() . PHP_EOL .
	'Versi bot: ' . BOT_VERSION . PHP_EOL .
	PHP_EOL . ' Dibuat dengan Cinta oleh ' . PUMBUAT_BOT . PHP_EOL . PHP_EOL .
	'Semoga bot ini membantu.';

$option = array(
	//First row
	array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = SUPPORT_GROUP), $telegram->buildInlineKeyBoardButton("❓ Help", $url = "", $callback_data = '/help@fadhil_riyanto_bot')),
	//Second row 

);
$keyb = $telegram->buildInlineKeyBoard($option);
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'reply_markup' => $keyb, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
