<?php
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	//$no_underskor = str_replace(' ', '_', $wiki_matang);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan wiki, gunakan command <pre>/wiki {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .  'Contoh : <pre>/wiki indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://id.wikipedia.org/w/api.php?action=query&prop=extracts&format=xml&exintro=&titles=" . urlencode($udahDiparse));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'User-Agent: request'
		));
		$output_wiki = curl_exec($ch);
		curl_close($ch);

		$wiki_get_datanya_ubahKeXML = simplexml_load_string($output_wiki);
		$wiki_matang = $wiki_get_datanya_ubahKeXML->query->pages->page->extract;
		$wiki_escape = strip_tags($wiki_matang);

		if ($wiki_escape == null) {
			$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Kami tidak mendapatkan hasil wikipedia.';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . 'Kami mendapatkan hasil di wikipedia. hasil : ' . PHP_EOL . PHP_EOL .
				$wiki_escape;
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	}