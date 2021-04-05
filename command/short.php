<?php
if ($adanParse_plain_nokarakter[1] != null) {
	if (filter_var($adanParse_plain_nokarakter[1], FILTER_VALIDATE_URL)) {
		if ($userID == $userid_pemilik) {
			$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse_plain_nokarakter[1] . '&name=' . $adanParse_plain_nokarakter[2]);
			$json_shorturl = json_decode($json_pendekurl, true);
			if ($json_pendekurl == null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Server sedang down';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 1) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, link telah sebelumnya dipendekkan';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 2) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, itu bukanlah tautan';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 3) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, nama link yang diinginkan sudah digunakan';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 4) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'API key error, silahkan contact @fadhil_riyanto agar diperbarui olehnya. Mimin tipe orang humoris kok';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 5) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, LINK kamu tidak valid karena tidak lolos validasi. Termasuk karakter yang tidak valid';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 6) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Tautan yang diberikan berasal dari domain yang diblokir. seperti mengandung porno, judi, pishing, dan lain lain';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} elseif ($json_shorturl["url"]["status"] == 7) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} else {
				$reply = 'error, contact @fadhil_riyanto okee';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			}
		} elseif ($userID != $userid_pemilik) {
			if (isset($adanParse_plain_nokarakter[2])) {
				$reply = 'error, hanya @fadhil_riyanto yang bisa melakukan custom alias';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
				exit;
			} else {
				$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse_plain_nokarakter[1]);
				$json_shorturl = json_decode($json_pendekurl, true);
				if ($json_pendekurl == null) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Server sedang down';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 1) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, link telah sebelumnya';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 2) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, itu bukanlah tautan';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 3) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, nama link yang diinginkan sudah digunakan';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 4) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'API key error, silahkan contact @fadhil_riyanto agar diperbarui olehnya. Mimin tipe orang humoris kok';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 5) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, LINK kamu tidak valid karena tidak lolos validasi. Termasuk karakter yang tidak valid';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 6) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Tautan yang diberikan berasal dari domain yang diblokir. seperti mengandung porno, judi, pishing, dan lain lain';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 7) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} else {
					$reply = 'error, contact @fadhil_riyanto okee';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				}
			}
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, ini bukan URL!' . PHP_EOL . 'Url harus diawali dengan http://';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
} else {
	$reply = 'Hai ' . $username . '. Gunakan parameter' . PHP_EOL . '<pre>/short {link kamu}</pre>' . PHP_EOL . PHP_EOL . 'Contoh <pre>/short https://google.com</pre>';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
}
