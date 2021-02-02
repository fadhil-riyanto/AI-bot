<?php
if ($userID == $userid_pemilik) {
		$reply = 'Hai ' . $username . PHP_EOL . 'bot ter-stop!!';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = 'Maaf ' . $username . PHP_EOL . PHP_EOL . 'hanya @fadhil_riyanto yang bisa menjalankan command ini';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}