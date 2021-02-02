<?php
if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=aaaa&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . '. AAAA dari ' . $adanParse[1] . ' adalah ' . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, domain harus tanpa http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format : <pre>/get_aaaa {domain}</pre>' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}