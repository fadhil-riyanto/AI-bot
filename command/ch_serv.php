<?php
if ($userID == $userid_pemilik) {
		if ($adanParse[1] == null) {
			$reply = 'Welcome to server modifier!' . PHP_EOL . PHP_EOL . 'Write --all for see all serv' . PHP_EOL . 'Write /ch_serv {num} For select';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
			exit;
		} else {
			switch ($adanParse[1]) {
				case '--all':
					$reply = '1. server-data.000webhostapp.com' . PHP_EOL .
						'2. serv1-fadhil-riyanto-bot.herokuapp.com' . PHP_EOL .
						'3. serv2-fadhil-riyanto-bot.herokuapp.com';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					break;

				case '1':
					$reply = file_get_contents('https://api.telegram.org/bot' . $telegramAPIs . '/setWebhook?url=https://server-data.000webhostapp.com');
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					break;

				case '2':
					$reply = file_get_contents('https://api.telegram.org/bot' . $telegramAPIs . '/setWebhook?url=https://serv1-fadhil-riyanto-bot.herokuapp.com');
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					break;

				case '3':
					$reply = file_get_contents('https://api.telegram.org/bot' . $telegramAPIs . '/setWebhook?url=https://serv2-fadhil-riyanto-bot.herokuapp.com');
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					break;
				default:
					$reply = 'not found';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					break;
			}
		}
	} else {
		$reply = 'ACCES DENIED!, Hanya @fadhil_riyanto yang bisa mengexecute command ini!';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}