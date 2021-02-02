<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text); //Hilangkan command
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text); //ambil data setelah command
	if ($azanHilangcommand != null) { //jika data ternyata ngga kosong maka
		// $a_provinsi_corona = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi'); //get json ke server
		// $b_provinsi_corona = json_decode($a_provinsi_corona); //lalu decode
		// foreach ($b_provinsi_corona as $bb_b_provinsi_corona) { //loop sampai menemukan yg pas
		// 	if (strtolower($bb_b_provinsi_corona->attributes->Provinsi) == $udahDiparse) { //jika nama provinsi sama maka
		// 		$reply = 'Provinsi : ' . $bb_b_provinsi_corona->attributes->Provinsi . PHP_EOL . PHP_EOL .
		// 			'😊 Total sembuh : ' . $bb_b_provinsi_corona->attributes->Kasus_Semb . PHP_EOL .
		// 			'😞 Total positif : ' . $bb_b_provinsi_corona->attributes->Kasus_Posi . PHP_EOL .
		// 			'😢 Total meninggal : ' . $bb_b_provinsi_corona->attributes->Kasus_Meni . PHP_EOL;
		// 		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		// 		$telegram->sendMessage($content); //Kirim teks ini
		// 		exit;
		// 	}
		// }
		$coronaprov = file_get_contents($host_server . '/APIs.php?method=corona_provinsi&dns=' . urlencode($udahDiparse));
		if ($coronaprov == null) {
			$reply = 'Maaf provinsi tidak ditemukan'; //jiika dia ngetik command doang tanpa parameter kirim ini
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$reply = $coronaprov . PHP_EOL . 'Jangan lupa selalu pakai masker dan jaga kesehatan yaaa'; //jiika dia ngetik command doang tanpa parameter kirim ini
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
		$reply = 'Maaf gunakan patern nama provinsi'; //jiika dia ngetik command doang tanpa parameter kirim ini
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
