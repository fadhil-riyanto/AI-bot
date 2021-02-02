<?php

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan decode Base64, gunakan command <pre>/base64_decode {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/base64_decode indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		if (base64_encode(base64_decode($udahDiparse, true)) === $udahDiparse) {
			$reply = 'Hai ' . $username . ', Hasil convert text to encode dengan algoritma BASE46 adalah' . PHP_EOL . PHP_EOL .
				'Encoded : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Text : <pre>' .  base64_decode($udahDiparse_hash) . '</pre>';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . ', Maaf, base64 yang akan didecode tidak valid';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	}