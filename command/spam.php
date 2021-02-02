<?php
if ($userID == $userid_pemilik) {
		if ($adanParse[1] == null) {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Mohon Masukkan username yang ingin dispam';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
			exit;
		} else {
			if ($adanParse[2] < 15) {
				if ($adanParse[2] == null) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Mohon isikan jumlah spam!!';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} else {
					for ($spam = 1; $spam <= $adanParse[2]; $spam++) {
						$reply = 'Spam ' . $spam . ' ' . $adanParse[1];
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
						//exit;
					}
					$reply = 'Hai ' . $username . PHP_EOL . 'Spam selesai bos!!';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					exit;
				}
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Jumlah spam Harus dibawah 15 untuk melindungi user!!';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		}
	} else {
		$reply = 'Maaf, hanya @fadhil_riyanto yang bisa melakukanya';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}