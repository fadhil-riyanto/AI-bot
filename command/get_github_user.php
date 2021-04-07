<?php

//$githubApis = file_get_contents('https://api.github.com/users/'. $adanParse[1]);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/" . $adanParse[1]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'User-Agent: request'
	));
	$output = curl_exec($ch);
	curl_close($ch);
	$githubAPIS = json_decode($output);
	if ($adanParse[1] == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Gunakan pattern' . PHP_EOL . PHP_EOL . '<pre>/get_github_user {username github</pre>' . PHP_EOL . PHP_EOL . 'Contoh : <pre>/get_github_user torvalds</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	} elseif ($githubAPIS->message == "Not Found") {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, tidak ditemukan, Mungkin kamu salah ketik atau mungkin akun yang kamu cari sudah dibanned sama Github';
		$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . 'Info user github' . PHP_EOL . PHP_EOL .
			'ID Github:' . $githubAPIS->id . PHP_EOL .
			'Username : ' . $githubAPIS->login . PHP_EOL .
			'Akun : ' . $githubAPIS->html_url . PHP_EOL . PHP_EOL .
			'Tipe : ' . $githubAPIS->type . PHP_EOL .
			'Nama : ' . $githubAPIS->name . PHP_EOL .
			'Perusahaan : ' . $githubAPIS->company . PHP_EOL .
			'Web : ' . $githubAPIS->blog . PHP_EOL .
			'Lokasi : ' . $githubAPIS->location . PHP_EOL .
			'email : ' . $githubAPIS->email . PHP_EOL .
			'bio : ' . $githubAPIS->bio . PHP_EOL . PHP_EOL .
			'Twitter : ' . $githubAPIS->twitter_username . PHP_EOL .
			'Reposito : ' . $githubAPIS->public_repos . PHP_EOL .
			'Gist : ' . $githubAPIS->public_gists . PHP_EOL .
			'Pengikut : ' . $githubAPIS->followers . PHP_EOL .
			'Mengikuti : ' . $githubAPIS->following . PHP_EOL . PHP_EOL . PHP_EOL .
			'updated_at : ' . $githubAPIS->updated_at . PHP_EOL;

		$option = array(
			//First row
			// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
			// //Second row 
			// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
			// //Third row
			array($telegram->buildInlineKeyBoardButton("Github Account", $url = $githubAPIS->html_url)),
			array($telegram->buildInlineKeyBoardButton("Repository", $url = $githubAPIS->html_url . '?tab=repositories'))
		);
		$keyb = $telegram->buildInlineKeyBoard($option);

		$konten = array('chat_id' => $chat_id, 'photo' => $githubAPIS->avatar_url, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true, 'caption' => $reply);
		$telegram->sendPhoto($konten);
		// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
		// $telegram->sendMessage($content);
		//keyboard inline biar ga ribet buka link repo


		exit;
	}