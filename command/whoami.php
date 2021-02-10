<?php
$hasil = $telegram->getData();
if ($hasil['message']['from']['is_bot'] == true) {
	$inibotWhoami = 'iya';
} else {
	$inibotWhoami = 'tidak';
}

$reply = '
👤 You' . PHP_EOL .
	'├ id: ' .  $hasil['message']['from']['id'] . PHP_EOL .
	'├ kamu bot: ' . $inibotWhoami . PHP_EOL .
	'├ nama pertama: ' . $hasil['message']['from']['first_name'] . PHP_EOL .
	'├ nama terakhir: ' . $hasil['message']['from']['last_name'] . PHP_EOL .
	'├ username: ' . $hasil['message']['from']['username'] . PHP_EOL .
	'└ kode bahasa: ' . $hasil['message']['from']['language_code'];
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
