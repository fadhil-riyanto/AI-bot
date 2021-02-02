<?php
$file_korona = @file_get_contents('https://api.kawalcorona.com/indonesia/');
	$file_korona_jsonParse = json_decode($file_korona, true);
	if ($file_korona_jsonParse != NULL) {
		foreach ($file_korona_jsonParse as $corona_jadi) {
			$reply =  'Hai ' . $username . PHP_EOL .
				'jumlah kasus Corona sekarang adalah' . PHP_EOL . PHP_EOL .
				'positif   ' . $corona_jadi['positif'] . PHP_EOL .
				'sembuh    ' . $corona_jadi['sembuh'] . PHP_EOL .
				'meninggal ' . $corona_jadi['meninggal'] . PHP_EOL .
				'dirawat   ' . $corona_jadi['dirawat'] . PHP_EOL . PHP_EOL .
				'Dan Jangan lupa selalu pakai masker dan jaga kesehatan yaaa';
			$option = array(
				//First row
				// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
				// //Second row 
				// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
				// //Third row


				array($telegram->buildInlineKeyBoardButton("covid19", $url = "https://covid19.go.id/"), $telegram->buildInlineKeyBoardButton("kemenkes", $url = "https://www.kemkes.go.id/"))
			);
			$keyb = $telegram->buildInlineKeyBoard($option);


			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'server mati sepertinya, coba lagi nanti' . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}