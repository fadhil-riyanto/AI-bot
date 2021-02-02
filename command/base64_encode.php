<?php
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encode Base64, gunakan command <pre>/base64_encode {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/base64_encode indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to encode dengan algoritma BASE46 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  base64_encode($udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}