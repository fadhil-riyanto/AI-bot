<?php
if ($adanParse[1] != null) {
		//$getIPAPI = file_get_contents('https://ip-api.com/json/' . $adanParse[1]);
		$input = $adanParse[1];
		$input = trim($input, '/');

		// If not have http:// or https:// then prepend it
		if (!preg_match('#^http(s)?://#', $input)) {
			$input = 'http://' . $input;
		}

		$urlParts = parse_url($input);

		// Remove www.
		$domain_name = preg_replace('/^www\./', '', $urlParts['host']);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . $domain_name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'User-Agent: request'
		));
		$output = curl_exec($ch);
		curl_close($ch);

		$parseSAXJsonAPIS = json_decode($output);
		if ($parseSAXJsonAPIS->status == 'fail') {
			$reply = 'Maaf ' . $username . ', IP atau Host tidak ditemukan. Mohon cek lagi URL yang anda gunakan';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} elseif ($adanParse[2] == '-map') {
			$reply = 'Halo ' . $username . ' Kami menemukan ip geolokasi dari ' . $domain_name . ' Berikut datanya' . PHP_EOL . PHP_EOL .
				'Negara : ' . $parseSAXJsonAPIS->country . PHP_EOL .
				'Kode negara : ' . $parseSAXJsonAPIS->country . PHP_EOL .
				'region: ' . $parseSAXJsonAPIS->region . PHP_EOL .
				'regionName : ' . $parseSAXJsonAPIS->regionName . PHP_EOL .
				'city : ' . $parseSAXJsonAPIS->city . PHP_EOL .
				'zip : ' . $parseSAXJsonAPIS->zip . PHP_EOL .
				'lat : ' . $parseSAXJsonAPIS->lat . PHP_EOL .
				'lon : ' . $parseSAXJsonAPIS->lon . PHP_EOL .
				'Zona waktu : ' . $parseSAXJsonAPIS->timezone . PHP_EOL .
				'isp : ' . $parseSAXJsonAPIS->isp . PHP_EOL .
				'org : ' . $parseSAXJsonAPIS->org . PHP_EOL .
				'as : ' . $parseSAXJsonAPIS->as;
			//'openmap: https://www.openstreetmap.org/?mlat=' . $parseSAXJsonAPIS->lat . '&mlon=' . $parseSAXJsonAPIS->lon;
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
			$locate = array('chat_id' => $chat_id, 'latitude' => $parseSAXJsonAPIS->lat, 'longitude' => $parseSAXJsonAPIS->lon);
			$telegram->sendLocation($locate);
		} else {
			$reply = 'Halo ' . $username . ' Kami menemukan ip geolokasi dari ' . $domain_name . ' Berikut datanya' . PHP_EOL . PHP_EOL .
				'Negara : ' . $parseSAXJsonAPIS->country . PHP_EOL .
				'Kode negara : ' . $parseSAXJsonAPIS->country . PHP_EOL .
				'region: ' . $parseSAXJsonAPIS->region . PHP_EOL .
				'regionName : ' . $parseSAXJsonAPIS->regionName . PHP_EOL .
				'city : ' . $parseSAXJsonAPIS->city . PHP_EOL .
				'zip : ' . $parseSAXJsonAPIS->zip . PHP_EOL .
				'lat : ' . $parseSAXJsonAPIS->lat . PHP_EOL .
				'lon : ' . $parseSAXJsonAPIS->lon . PHP_EOL .
				'Zona waktu : ' . $parseSAXJsonAPIS->timezone . PHP_EOL .
				'isp : ' . $parseSAXJsonAPIS->isp . PHP_EOL .
				'org : ' . $parseSAXJsonAPIS->org . PHP_EOL .
				'as : ' . $parseSAXJsonAPIS->as;
			//'openmap: https://www.openstreetmap.org/?mlat=' . $parseSAXJsonAPIS->lat . '&mlon=' . $parseSAXJsonAPIS->lon;
			$option = array(
				//First row
				// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
				// //Second row 
				// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
				// //Third row
				array($telegram->buildInlineKeyBoardButton("Map", $url = 'https://www.openstreetmap.org/?mlat=' . $parseSAXJsonAPIS->lat . '&mlon=' . $parseSAXJsonAPIS->lon))
			);
			$keyb = $telegram->buildInlineKeyBoard($option);

			$content = array('chat_id' => $chat_id, 'text' => $reply, 'disable_web_page_preview' => true, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
			// $locate = array('chat_id' => $chat_id, 'latitude' => $parseSAXJsonAPIS->lat, 'longitude' => $parseSAXJsonAPIS->lon);
			// $telegram->sendLocation($locate);
		}
		/*$reply = 'Hasil pencarian '.$domain_name .PHP_EOL . PHP_EOL .
				'Status : '$parseSAXJsonAPIS->status;
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);*/
	} else {
		$reply = 'Maaf ' . $username . ', Gunakan pattern /ip_geo {host atau IP}' . PHP_EOL . PHP_EOL .
			'Pro tip : gunakan <pre> -map</pre> untuk menampilkan peta' . PHP_EOL . 'Contoh : <pre>/ip_geo google.com -map</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
