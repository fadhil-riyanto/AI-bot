<?php
$data_gempanya = @simplexml_load_file('https://data.bmkg.go.id/autogempa.xml');
	if ($data_gempanya != null) {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Data gempa terkini' . PHP_EOL . PHP_EOL .
			'tanggal :' . $data_gempanya->gempa->Tanggal . PHP_EOL .
			'jam :' . $data_gempanya->gempa->Jam . PHP_EOL .
			'lintang :' . $data_gempanya->gempa->Lintang . PHP_EOL .
			'Bujur :' . $data_gempanya->gempa->Bujur . PHP_EOL .
			'Magnitude :' . $data_gempanya->gempa->Magnitude . PHP_EOL .
			'Kedalaman :' . $data_gempanya->gempa->Kedalaman . PHP_EOL .
			'Wilayah1 :' . $data_gempanya->gempa->Wilayah1 . PHP_EOL .
			'Wilayah2 :' . $data_gempanya->gempa->Wilayah2 . PHP_EOL .
			'Wilayah3 :' . $data_gempanya->gempa->Wilayah3 . PHP_EOL .
			'Wilayah4 :' . $data_gempanya->gempa->Wilayah4 . PHP_EOL .
			'Wilayah5 :' . $data_gempanya->gempa->Wilayah5 . PHP_EOL .
			'Potensi :' . $data_gempanya->gempa->Potensi . PHP_EOL . PHP_EOL . PHP_EOL . 'Sumber : data.bmkg.go.id';
		$option = array(
			//First row
			// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
			// //Second row 
			// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
			// //Third row

			array($telegram->buildInlineKeyBoardButton("Situs BMKG", $url = 'https://www.bmkg.go.id/'))
		);
		$keyb = $telegram->buildInlineKeyBoard($option);


		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} elseif ($data_gempanya == null) {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, server data.bmkg.go.id tidak aktif. silahkan coba lagi nanti';
		$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}