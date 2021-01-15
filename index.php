<?php
ini_set('max_execution_time', 20);
//aktifkan saat mode debug. jika ngga ya jangan diaktifkan ;v
error_reporting(0);
//wajib diisi
// ______________________________
$userid_pemilik = '1393342467';
$telegramAPIs   = '1489990155:AAEC3c6I-hmtDfbk9OojmlDjNFt1NeMEjfs';
$api_key_cuttly = 'fa1d93ba90dedd2ceb7d01e9bade271653373';
// ________________________________
echo 'Ini server 1 bot telegram';
function SERVER_ALAMAT_addr()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
		$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	return $protocol . $domainName;
}
//include('Telegram.php');
$host_server   = SERVER_ALAMAT_addr();
//$host_server   = 'http://server-data.000webhostapp.com';

date_default_timezone_set('Asia/Jakarta');
$telegram = new Telegram($telegramAPIs);
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');

//use http!!!!
//akhir wajib diisi
if ($koneksi == 1) {
	$text = htmlspecialchars(strtolower(mysqli_real_escape_string($koneksi, $telegram->Text())));
	$text_plain = htmlspecialchars($telegram->Text());
	$text_plain_nokarakter = $telegram->Text();
	$chat_id = $telegram->ChatID();
	$userID = $telegram->UserID();
	$message_id = $telegram->MessageID();
	$usernameBelumdiparse = $telegram->Username();
} else {
	$text = htmlspecialchars(strtolower($telegram->Text()));
	$text_plain = htmlspecialchars($telegram->Text());
	$text_plain_nokarakter = $telegram->Text();
	$chat_id = $telegram->ChatID();
	$userID = $telegram->UserID();
	$message_id = $telegram->MessageID();
	$usernameBelumdiparse = $telegram->Username();
}


$username = ' @' . $usernameBelumdiparse;

$adanParse = explode(' ', $text);
$adanParse_plain = explode(' ', $text_plain);
$adanParse_plain_nokarakter = explode(' ', $text_plain_nokarakter);

$hilangAzan = str_replace('/azan ', '', $text, $hit);
if ($hit == 0) {
	$hilangAzan = str_replace('/azan@fadhil_riyanto_bot ', '', $text);
}

function is_valid_domain_name($domain_name)
{
	return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
		&& preg_match("/^.{1,253}$/", $domain_name) //overall length check
		&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)); //length of each label
}

$stringPertama = substr($text, 0, 1); //untuk command / !
$stringKedua = substr($text, 0, 2); // untuk command dengan 2 karakter

$stringTerakhir = substr($text, 0, -1);


if ($text == '/start' || $text == '/start@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', Apa kabar?';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/debug' || $text == '/debug@fadhil_riyanto_bot') {
	$option = array(
		//First row
		array($telegram->buildInlineKeyBoardButton("Button 1", $url = '', $callback_data = '/corona'), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
		//Second row 
		array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
		//Third row
		array($telegram->buildInlineKeyBoardButton("Button 6", $url = "http://link6.com"))
	);
	$keyb = $telegram->buildInlineKeyBoard($option);
	$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "This is a Keyboard Test");
	$telegram->sendMessage($content);
	exit;
} elseif ('/faker' == $adanParse[0] || '/faker@fadhil_riyanto_bot' == $adanParse[0]) {
	// $azanHilangcommand = str_replace($adanParse[0], '', $text);
	// $udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
	if (1) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://fakerapi.it/api/v1/persons?_locale=id_ID&_quantity=1");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'User-Agent: request'
		));
		$output_faker = curl_exec($ch);
		curl_close($ch);
		$json_tanpa_kodenegara  = json_decode($output_faker, true);

		if ($json_tanpa_kodenegara['code'] == 200) {
			$reply = 'Hai ' . $username . ', Faker data berhasil dibuat' . PHP_EOL . PHP_EOL .
				'Nama depan : ' . $json_tanpa_kodenegara['data'][0]['firstname'] . PHP_EOL .
				'Nama belakang : ' . $json_tanpa_kodenegara['data'][0]['lastname'] . PHP_EOL .
				'Email : ' . $json_tanpa_kodenegara['data'][0]['email'] . PHP_EOL .
				'No HP : ' . $json_tanpa_kodenegara['data'][0]['phone'] . PHP_EOL .
				'Ulang tahun : ' . $json_tanpa_kodenegara['data'][0]['birthday'] . PHP_EOL .
				'Gender : ' . $json_tanpa_kodenegara['data'][0]['gender'] . PHP_EOL .
				// DATA ALAMAT
				'Alamat Jalan : ' . $json_tanpa_kodenegara['data'][0]['address']['street'] . PHP_EOL .
				'Nomor bangunan : ' . $json_tanpa_kodenegara['data'][0]['address']['buildingNumber'] . PHP_EOL .
				'Kota : ' . $json_tanpa_kodenegara['data'][0]['address']['city'] . PHP_EOL .
				'Zip : ' . $json_tanpa_kodenegara['data'][0]['address']['zipcode'] . PHP_EOL .
				'Negara : ' . $json_tanpa_kodenegara['data'][0]['address']['country'] . PHP_EOL .
				'latitude : ' . $json_tanpa_kodenegara['data'][0]['address']['latitude'] . PHP_EOL .
				'longitude : ' . $json_tanpa_kodenegara['data'][0]['address']['longitude'] . PHP_EOL .
				'website : ' . $json_tanpa_kodenegara['data'][0]['website'] . PHP_EOL;
			//$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			//$telegram->sendMessage($content);
			$option = array(
				//First row
				// array($telegram->buildInlineKeyBoardButton("Button 1", $url = '', $callback_data = '/corona'), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
				// //Second row 
				// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
				// //Third row
				array($telegram->buildInlineKeyBoardButton("Buat data lagi!", $url = "", $callback_data = '/faker@fadhil_riyanto_bot'))
			);
			$keyb = $telegram->buildInlineKeyBoard($option);
			$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . ', Maaf, ada kesalahan di sistem kami.';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	}
	exit;
} elseif ('/wiki' == $adanParse[0] || '/wiki@fadhil_riyanto_bot' == $adanParse[0]) {
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
	exit;
} elseif ('/ch_serv' == $adanParse[0] || '/ch_serv@fadhil_riyanto_bot' == $adanParse[0]) {
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
	exit;
} elseif ('/ip_geo' == $adanParse[0] || '/ip_geo@fadhil_riyanto_bot' == $adanParse[0]) {
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
			'Pro tip : gunakan <pre>-map</pre> untuk menampilkan peta' . PHP_EOL . 'Contoh : <pre>/ip_geo google.com -map</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/tulis' == $adanParse[0] || '/tulis@fadhil_riyanto_bot' == $adanParse[0]) {
	//$hapusTulis = 
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text_plain);
	$curlImage = file_get_contents('https://tools.zone-xsec.com/api/nulis.php?q=' . urlencode($udahDiparse));
	$parsecJsons = json_decode($curlImage);
	if ($adanParse[1] == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Pattern kosong, gunakan format' . PHP_EOL . PHP_EOL . '<pre>/tulis {your text}</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	} elseif ($parsecJsons->status == "OK") {
		$konten = array('chat_id' => $chat_id, 'photo' => $parsecJsons->image);
		$telegram->sendPhoto($konten);
		$reply = 'Hai ' . $username . PHP_EOL . 'Gambar berhasil dibuat!';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, sepertinya ada yang error di sistem kami';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	}
} elseif ('/get_github_user' == $adanParse[0] || '/get_github_user@fadhil_riyanto_bot' == $adanParse[0]) {
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

		$konten = array('chat_id' => $chat_id, 'photo' => $githubAPIS->avatar_url);
		$telegram->sendPhoto($konten);
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		//keyboard inline biar ga ribet buka link repo


		exit;
	}
} elseif ($text == '/berhenti' || $text == '/berhenti@fadhil_riyanto_bot') {
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
} elseif ('/spam' == $adanParse[0] || '/spam@fadhil_riyanto_bot' == $adanParse[0]) {
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
} elseif ('/get_ip' == $adanParse[0] || '/get_ip@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = gethostbyname($adanParse[1]);
			$reply = 'Hai ' . $username . '. IP dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . '. Maaf, domain harus tanpa http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . '. Maaf, gunakan format' . PHP_EOL . PHP_EOL . '<pre>/get_ip {domain}</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_mx' == $adanParse[0] || '/get_mx@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=mx&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . '. MX dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, domain harus tanpa http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . PHP_EOL . '<pre>/get_mx {domain}</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_ns' == $adanParse[0] || '/get_ns@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=ns&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . '. NS dari ' . $adanParse[1] . ' adalah ' . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, domain harus tanpa http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . ' Maaf, gunakan format' . PHP_EOL . PHP_EOL .  '<pre>/get_ns {domain}</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_a' == $adanParse[0] || '/get_a@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=a&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username  . ' A dari ' . $adanParse[1] . ' adalah '  . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
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
		$reply = 'Hai ' . $username . '. Maaf, gunakan format' . PHP_EOL . PHP_EOL . '<pre>/get_a {domain}</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_aaaa' == $adanParse[0] || '/get_aaaa@fadhil_riyanto_bot' == $adanParse[0]) {
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
	exit;
} elseif ('/get_txt' == $adanParse[0] || '/get_txt@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=txt&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . '. TXT dari ' . $adanParse[1] . ' adalah '  . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
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
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '<pre>/get_txt {domain}</pre>' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_cname' == $adanParse[0] || '/get_cname@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=cname&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . '. CNAME dari ' . $adanParse[1] . ' adalah '  . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
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
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '<pre>/get_cname {domain}</pre>' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($text == '/donate' || $text == '/donate@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', Saya senang mendengar anda mau donasi' . PHP_EOL . PHP_EOL .
		'Saya memiliki 2 cara untuk donasi' . PHP_EOL . PHP_EOL .
		'Cara pertama kamu hanya perlu mengirimkan banyak pertanyaan ringan ke bot. Agar apa? agar dia pintar. karena semakin banyak kata maka semakin banyak jumlah kata yang tersimpan (Jangan spam yaa, kasihan CPU server-nya).' . PHP_EOL . PHP_EOL .
		'Cara kedua kamu bisa mengirimkan uang ke saya, jumlah bebas dan seikhlasnya. uang akan digunakan untuk membeli dan memperpanjang hosting database server.' . PHP_EOL . PHP_EOL .
		'Contact @fadhil_riyanto untuk penjelasan lebih lanjut';
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id);
	$telegram->sendMessage($content);
	exit;
} elseif ('/short' == $adanParse[0] || '/short@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (filter_var($adanParse[1], FILTER_VALIDATE_URL)) {
			if ($userID == $userid_pemilik) {
				$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse[1] . '&name=' . $adanParse[2]);
				$json_shorturl = json_decode($json_pendekurl, true);
				if ($json_pendekurl == null) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Server sedang down';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 1) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, link telah sebelumnya';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 2) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, itu bukanlah tautan';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 3) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, nama link yang diinginkan sudah digunakan';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 4) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'API key error, silahkan contact @fadhil_riyanto agar diperbarui olehnya. Mimin tipe orang humoris kok';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 5) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, LINK kamu tidak valid karena tidak lolos validasi. Termasuk karakter yang tidak valid';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 6) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Tautan yang diberikan berasal dari domain yang diblokir. seperti mengandung porno, judi, pishing, dan lain lain';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 7) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				} else {
					$reply = 'error, contact @fadhil_riyanto okee';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
				}
			} elseif ($userID != $userid_pemilik) {
				if (isset($adanParse[2])) {
					$reply = 'error, hanya @fadhil_riyanto yang bisa melakukan custom alias';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
					exit;
				} else {
					$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse[1]);
					$json_shorturl = json_decode($json_pendekurl, true);
					if ($json_pendekurl == null) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Server sedang down';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 1) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, link telah sebelumnya';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 2) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, itu bukanlah tautan';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 3) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, nama link yang diinginkan sudah digunakan';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 4) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'API key error, silahkan contact @fadhil_riyanto agar diperbarui olehnya. Mimin tipe orang humoris kok';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 5) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, LINK kamu tidak valid karena tidak lolos validasi. Termasuk karakter yang tidak valid';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 6) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Tautan yang diberikan berasal dari domain yang diblokir. seperti mengandung porno, judi, pishing, dan lain lain';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 7) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					} else {
						$reply = 'error, contact @fadhil_riyanto okee';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
					}
				}
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, ini bukan URL!' . PHP_EOL . 'Url harus diawali dengan http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . '. Gunakan parameter' . PHP_EOL . '<pre>/short {link kamu}</pre>' . PHP_EOL . PHP_EOL . 'Contoh <pre>/short https://google.com</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/azan' == $adanParse[0] || '/azan@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse[0], '', $text);
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
	if ($azanHilangcommand != null) {
		$azanDapatkankota = file_get_contents('https://api.banghasan.com/sholat/format/json/kota/nama/' . urlencode($udahDiparse));
		$h = json_decode($azanDapatkankota);
		if ($h->kota != null) {
			foreach ($h->kota as $azanKode) {
				if ($azanKode->nama == strtoupper($udahDiparse)) {
					//echo $azanKode->id;
					$azangetJadwal = file_get_contents('https://api.banghasan.com/sholat/format/json/jadwal/kota/' . $azanKode->id . '/tanggal/' . date('Y-m-d'));
					$jsonHasilazancurl = json_decode($azangetJadwal);
					$reply = 'Hai ' . $username . ', Jadwal azan dikota ' . strtolower($udahDiparse) . ' Adalah' . PHP_EOL . PHP_EOL .
						'subuh : ' . $jsonHasilazancurl->jadwal->data->subuh . PHP_EOL .
						'imsak : ' . $jsonHasilazancurl->jadwal->data->imsak . PHP_EOL .
						'terbit : ' . $jsonHasilazancurl->jadwal->data->terbit . PHP_EOL .
						'dhuha : ' . $jsonHasilazancurl->jadwal->data->dhuha . PHP_EOL .
						'dzuhur : ' . $jsonHasilazancurl->jadwal->data->dzuhur . PHP_EOL .
						'ashar : ' . $jsonHasilazancurl->jadwal->data->ashar . PHP_EOL .
						'maghrib : ' . $jsonHasilazancurl->jadwal->data->maghrib . PHP_EOL .
						'isya : ' . $jsonHasilazancurl->jadwal->data->isya . PHP_EOL .
						'tanggal : ' . $jsonHasilazancurl->jadwal->data->tanggal;
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
					exit;
				} elseif (file_get_contents('https://api.banghasan.com' == null)) {
					$reply = 'Maaf ' . $username . ' Server api.banghasan.com sekarang down. Namun tenang, biasa nya dia akan menyala kembali';
					$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
					$telegram->sendMessage($content);
					exit;
				}
			}
		} else {
			$reply = 'Hai ' . $username . ', Maaf, kota tidak ditemukan. Silahkan cek kembali tulisan untuk mendeteksi kemungkinan typo';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
			exit;
		}
	} elseif ($azanHilangcommand == null) {
		$reply = 'Maaf, gunakan pattern <pre>/azan namakota</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
	/*$curlImage = file_get_contents('https://tools.zone-xsec.com/api/nulis.php?q='.urlencode($udahDiparse));
	$parsecJsons = json_decode($curlImage);
	if($adanParse[1] == null){
		$reply = 'Hai '.$username. PHP_EOL . 'Maaf, Pattern kosong, gunakan format' . PHP_EOL . '/tulis {your text}';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}elseif($parsecJsons->status == "OK"){
		$konten = array('chat_id' => $chat_id, 'photo' => $parsecJsons->image);
		$telegram->sendPhoto($konten);
		$reply = 'Hai '.$username. PHP_EOL .'Gambar berhasil dibuat!';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}else{
		$reply = 'Hai '.$username. PHP_EOL .'Maaf, sepertinya ada yang error di sistem kami';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}*/
} elseif ($text == '/gempa' || $text == '/gempa@fadhil_riyanto_bot') {
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
	exit;
} elseif ($text == '/userid' || $text == '/userid@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', id kamu adalah' . PHP_EOL . 'ID :' . $userID . PHP_EOL . 'Terimakasih.';
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/panggil' ||
	$text == '/panggil@fadhil_riyanto_bot'
) {
	$reply = 'Hai ' . $username . ', ada apa memanggil saya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == 'ini jam berapa?' ||
	$text === '/waktu' ||
	$text === 'ini jam berapa ya?' ||
	$text === 'jam sekarang!' ||
	$text == 'lihat jam' ||
	$text == 'waktu' ||
	$text == '/waktu@fadhil_riyanto_bot' ||
	$text == 'sekarang jam berapa?' ||
	$text == 'sekarang jam berapa' ||
	$text == 'jam berapa ini' ||
	$text == 'jam berapa ini?' ||
	$text == 'jam berapa' ||
	$text == 'jam berapa?'
) {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Sekarang jam ' . date('h:i:s a') . ', dihape kamu apa tidak cocok jamnya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/info' ||
	$text == '/info@fadhil_riyanto_bot' ||
	$text == 'info bot fadhil riyanto'
) {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Saya bot Fadhil Riyanto. Hobi saya bermain komputer dan membuat program' . PHP_EOL . PHP_EOL . 'Teknologi yang saya gunakan ialah. ' . PHP_EOL . 'Server: nginx' . PHP_EOL . 'Database: Mysql' . PHP_EOL . 'Cloud: Heroku, 000webhost' . PHP_EOL . 'PHP: 8.0.0 thread safe' . PHP_EOL . 'Versi bot: 9.7.3 alpha' . PHP_EOL . PHP_EOL . ' Dibuat dengan Cinta oleh @fadhil_riyanto' . PHP_EOL . PHP_EOL .  'Semoga bot ini membantu.';
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/help' || $text == '/help@fadhil_riyanto_bot' ||
	$text == 'pertolongan bot ini' || $text == 'cara menggunakan bot ini gimana?' ||
	$text == 'cara menggunakan bot @fadhil_riyanto_bot' || $text == 'cara gunainnya bgmn?' ||
	$text == 'cara gunainnya bgmn' || $text == '/help@fadhil_riyanto_bot'
) {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Untuk melihat help, silahkan buka link ini https://telegra.ph/Panduan-bot-fadhil-riyanto-12-31-2';

	$option = array(
		//First row
		array($telegram->buildKeyboardButton("Button 1"), $telegram->buildKeyboardButton("Button 2"))
	);
	$keyb = $telegram->buildKeyBoard($option, $onetime = false);
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/tanggal' || $text == '/tanggal@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'sekarang tanggal ' . date('l, d F Y');
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/bug' || $text == '/bug@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Silahkan PM <a href="https://t.me/fadhil_riyanto">fadhil riyanto</a>' . PHP_EOL . PHP_EOL .
		'Jangan lupa sertakan Screenshot dan letak bug nya. yaaaa' . PHP_EOL . PHP_EOL .
		'Dengan kamu melaporkan bug, kamu telah membantu saya untuk membuat bot lebih baik lagi. Mimin orangnya tipe humoris kok';
	$option = array(
		//First row
		// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
		// //Second row 
		// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
		// //Third row

		array($telegram->buildInlineKeyBoardButton("PM Fadhil", $url = 'https://t.me/fadhil_riyanto'))
	);
	$keyb = $telegram->buildInlineKeyBoard($option);


	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == null) {
	exit;
} elseif (
	$text === '/corona' ||
	$text === 'info corona' ||
	$text === 'info corona terkini' ||
	$text === 'info corona sekarang' ||
	$text === 'info covid sekarang' ||
	$text === 'info covid19 sekarang' ||
	$text === 'info covid 19 sekarang' ||
	$text === 'info covid19 terkini' ||
	$text === 'info covid 19 terkini' ||
	$text === 'info covid 19 diindonesia' ||
	$text === 'info covid19 diindonesia' ||
	$text === 'info covid 19 di indonesia' ||
	$text === 'info covid19 di indonesia' ||
	$text === 'update corona gimana?' ||
	$text === 'update corona gimana' ||
	$text === 'update covid gimana?' ||
	$text === 'update covid19 gimana' ||
	$text === 'update covid 19 gimana' ||
	$text === 'info corona gimana?' ||
	$text === 'info corona gimana' ||
	$text === 'info corona bagaimana?' ||
	$text === 'info corona bagaimana' ||
	$text === 'info covid bagaimana?' ||
	$text === 'info covid bagaimana' ||
	$text === 'info covid 19 bagaimana?' ||
	$text === 'info covid 19 bagaimana' ||
	$text === 'info covid19 bagaimana?' ||
	$text === 'info covid19 bagaimana' ||
	$text === 'info covid19 gimana?' ||
	$text === 'info covid 19 gimana?' ||
	$text === 'update corona bagaimana?' ||
	$text === 'corona gimana?' ||
	$text === 'status corona' ||
	$text === 'info covid' ||
	$text === 'info covid 19' ||
	$text === 'info covid19' ||
	//slang teks disini
	$text === 'corona bgmn?' ||
	$text === 'corona bgmn' ||
	$text === 'status corona' ||
	$text === 'statiska corona' ||
	$text === 'info covid' ||
	$text === 'info covid 19' ||
	$text === 'info covid19' ||
	$text == '/corona@fadhil_riyanto_bot'
) {
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
	exit;
}
// ENCRYPT TOOLS DIMULAI DARI SINI WOYY
// LICENSE BY FADHIL
// PAHAM?
elseif ('/sha256' == $adanParse[0] || '/sha256@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA256, gunakan command <pre>/sha256 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/sha256 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA256 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('sha256', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/sha1' == $adanParse[0] || '/sha1@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA1, gunakan command <pre>/sha1 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/sha1 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA1 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('sha1', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/sha512' == $adanParse[0] || '/sha512@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA512, gunakan command <pre>/sha512 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/sha512 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA512 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('sha512', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/sha384' == $adanParse[0] || '/sha384@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA384, gunakan command <pre>/sha384 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/sha384 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA384 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('sha384', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/md5' == $adanParse[0] || '/md5@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt MD5, gunakan command <pre>/md5 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/md5 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD5 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('md5', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/md4' == $adanParse[0] || '/md4@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt MD4, gunakan command <pre>/md4 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/md4 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD4 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('md4', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/md2' == $adanParse[0] || '/md2@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt MD2, gunakan command <pre>/md2 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/md2 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD2 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('md2', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
}
//ALL HASH DISINI
// DIMULAI
elseif ('/ripemd128' == $adanParse[0] || '/ripemd128@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt RIPEMD128, gunakan command <pre>/ripemd128 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/ripemd128 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma RIPEMD128 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('ripemd128', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/ripemd160' == $adanParse[0] || '/ripemd160@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt RIPEMD160, gunakan command <pre>/ripemd160 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/ripemd160 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma RIPEMD160 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('ripemd160', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/ripemd256' == $adanParse[0] || '/ripemd256@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt RIPEMD256, gunakan command <pre>/ripemd256 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/ripemd256 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma RIPEMD256 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('ripemd256', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/ripemd320' == $adanParse[0] || '/ripemd320@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt RIPEMD320, gunakan command <pre>/ripemd320 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/ripemd320 indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma RIPEMD320 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('ripemd320', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/whirlpool' == $adanParse[0] || '/whirlpool@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt WHIRLPOOL, gunakan command <pre>/whirlpool {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/whirlpool indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma WHIRLPOOL adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('whirlpool', $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
}
//BASE DECODE ENCODE WOYYY
//BASE DECODE ENCODE WOYYY
//BASE DECODE ENCODE WOYYY
//BASE DECODE ENCODE WOYYY
elseif ('/base64_encode' == $adanParse[0] || '/base64_encode@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encode Base64, gunakan command <pre>/base64_encode {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/base64_encode indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to encode dengan algoritma BASE46 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  base64_encode($udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/base64_decode' == $adanParse[0] || '/base64_decode@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan decode Base64, gunakan command <pre>/base64_decode {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/base64_decode indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		if (base64_encode(base64_decode($udahDiparse, true)) === $udahDiparse) {
			$reply = 'Hai ' . $username . ', Hasil convert text to encode dengan algoritma BASE46 adalah' . PHP_EOL . PHP_EOL .
				'Encoded : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Text : <pre>' .  base64_decode($udahDiparse_hash) . '</pre>';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . ', Maaf, base64 yang akan didecode tidak valid';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	}
	exit;




	exit;
} elseif ($stringPertama == '/' || $stringPertama == '!' || $stringKedua == 'cc') {
	// Jika ditemukan data dengan awalan coommand telegram, maka dia ngga akan diinsert ke database
	// kita menggunakan exit agar dia keluar dari konsol
	exit;
}
// ENCRYPT TOOLS DIAKHIRI
// LICENSE BY FADHIL
// PAHAM?
$filter_msg = new filter_pesan();
$teksTerfilter = $filter_msg->hyphenize($text);
if ($koneksi == 1) {
	$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$teksTerfilter' ");
	$tes_jumlah_row = @mysqli_affected_rows($koneksi);
	$dataAI = mysqli_fetch_assoc($q);

	if ($tes_jumlah_row > 0) {
		//foreach ($q as $respon) {


		$reply = $dataAI['data_res_ai'] . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
		//}
	} elseif ($tes_jumlah_row === 0) {

		$reply = '' . PHP_EOL . '';
		mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$teksTerfilter', 'hmhm')");
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
} elseif ($koneksi == 0) {
	$reply = 'Maaf, saat ini kamu tidak bisa membalas pesan kamu dikarnakan database sedang error. Jadi kami hanya bisa menerima command saja untuk sementara waktu ini. Kamu bisa melaporkan ke @fadhil_riyanto selaku pembuatnya';
	$option = array(
		//First row
		// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
		// //Second row 
		// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
		// //Third row

		array($telegram->buildInlineKeyBoardButton("Fadhil Riyanto", $url = 'https://t.me/fadhil_riyanto'))
	);
	$keyb = $telegram->buildInlineKeyBoard($option);


	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
}
// TELEGRAM KELAS
// V 4
// API CLASS DIMULAI DISINI WOYY
class filter_pesan
{
	public function hyphenize($string)
	{
		$dict = array(
			"km"      => "kamu",
			"yoi"      => "ya",
			"yg"      => "yang",
			"gk"      => "gak",
			"tg"    => "telegram"
			// replace teks lainnya disini
		);
		return strtolower(
			preg_replace(
				array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
				array(' ', ''),

				$this->cleanString(
					str_replace(
						array_keys($dict),
						array_values($dict),
						urldecode($string)
					)
				)
			)
		);
	}
	public function cleanString($text)
	{
		$utf8 = array(
			'/[áàâãªä]/u'   =>   'a',
			'/[ÁÀÂÃÄ]/u'    =>   'A',
			'/[ÍÌÎÏ]/u'     =>   'I',
			'/[íìîï]/u'     =>   'i',
			'/[éèêë]/u'     =>   'e',
			'/[ÉÈÊË]/u'     =>   'E',
			'/[óòôõºö]/u'   =>   'o',
			'/[ÓÒÔÕÖ]/u'    =>   'O',
			'/[úùûü]/u'     =>   'u',
			'/[ÚÙÛÜ]/u'     =>   'U',
			'/ç/'           =>   'c',
			'/Ç/'           =>   'C',
			'/ñ/'           =>   'n',
			'/Ñ/'           =>   'N',
			'/–/'           =>   '-',
			'/[’‘‹›‚]/u'    =>   ' ',
			'/[“”«»„]/u'    =>   ' ',
			'/ /'           =>   ' ',
		);
		return preg_replace(array_keys($utf8), array_values($utf8), $text);
	}
}

class Telegram
{
	const INLINE_QUERY = 'inline_query';
	const CALLBACK_QUERY = 'callback_query';
	const EDITED_MESSAGE = 'edited_message';
	const REPLY = 'reply';
	const MESSAGE = 'message';
	const PHOTO = 'photo';
	const VIDEO = 'video';
	const AUDIO = 'audio';
	const VOICE = 'voice';
	const ANIMATION = 'animation';
	const STICKER = 'sticker';
	const DOCUMENT = 'document';
	const LOCATION = 'location';
	const CONTACT = 'contact';
	const CHANNEL_POST = 'channel_post';
	private $bot_token = '';
	private $data = [];
	private $updates = [];
	private $log_errors;
	private $proxy;
	public function __construct($bot_token, $log_errors = true, array $proxy = [])
	{
		$this->bot_token = $bot_token;
		$this->data = $this->getData();
		$this->log_errors = $log_errors;
		$this->proxy = $proxy;
	}
	public function endpoint($api, array $content, $post = true)
	{
		$url = 'https://api.telegram.org/bot' . $this->bot_token . '/' . $api;
		if ($post) {
			$reply = $this->sendAPIRequest($url, $content);
		} else {
			$reply = $this->sendAPIRequest($url, [], false);
		}
		return json_decode($reply, true);
	}
	public function getMe()
	{
		return $this->endpoint('getMe', [], false);
	}
	public function respondSuccess()
	{
		http_response_code(200);
		return json_encode(['status' => 'success']);
	}
	public function sendMessage(array $content)
	{
		return $this->endpoint('sendMessage', $content);
	}
	public function forwardMessage(array $content)
	{
		return $this->endpoint('forwardMessage', $content);
	}
	public function sendPhoto(array $content)
	{
		return $this->endpoint('sendPhoto', $content);
	}
	public function sendAudio(array $content)
	{
		return $this->endpoint('sendAudio', $content);
	}
	public function sendDocument(array $content)
	{
		return $this->endpoint('sendDocument', $content);
	}
	public function sendAnimation(array $content)
	{
		return $this->endpoint('sendAnimation', $content);
	}
	public function sendSticker(array $content)
	{
		return $this->endpoint('sendSticker', $content);
	}
	public function sendVideo(array $content)
	{
		return $this->endpoint('sendVideo', $content);
	}
	public function sendVoice(array $content)
	{
		return $this->endpoint('sendVoice', $content);
	}
	public function sendLocation(array $content)
	{
		return $this->endpoint('sendLocation', $content);
	}
	public function editMessageLiveLocation(array $content)
	{
		return $this->endpoint('editMessageLiveLocation', $content);
	}
	public function stopMessageLiveLocation(array $content)
	{
		return $this->endpoint('stopMessageLiveLocation', $content);
	}
	public function setChatStickerSet(array $content)
	{
		return $this->endpoint('setChatStickerSet', $content);
	}
	public function deleteChatStickerSet(array $content)
	{
		return $this->endpoint('deleteChatStickerSet', $content);
	}
	public function sendMediaGroup(array $content)
	{
		return $this->endpoint('sendMediaGroup', $content);
	}
	public function sendVenue(array $content)
	{
		return $this->endpoint('sendVenue', $content);
	}
	public function sendContact(array $content)
	{
		return $this->endpoint('sendContact', $content);
	}
	public function sendChatAction(array $content)
	{
		return $this->endpoint('sendChatAction', $content);
	}
	public function getUserProfilePhotos(array $content)
	{
		return $this->endpoint('getUserProfilePhotos', $content);
	}
	public function getFile($file_id)
	{
		$content = ['file_id' => $file_id];
		return $this->endpoint('getFile', $content);
	}
	public function kickChatMember(array $content)
	{
		return $this->endpoint('kickChatMember', $content);
	}
	public function leaveChat(array $content)
	{
		return $this->endpoint('leaveChat', $content);
	}
	public function unbanChatMember(array $content)
	{
		return $this->endpoint('unbanChatMember', $content);
	}
	public function getChat(array $content)
	{
		return $this->endpoint('getChat', $content);
	}
	public function getChatAdministrators(array $content)
	{
		return $this->endpoint('getChatAdministrators', $content);
	}
	public function getChatMembersCount(array $content)
	{
		return $this->endpoint('getChatMembersCount', $content);
	}
	public function getChatMember(array $content)
	{
		return $this->endpoint('getChatMember', $content);
	}
	public function answerInlineQuery(array $content)
	{
		return $this->endpoint('answerInlineQuery', $content);
	}
	public function setGameScore(array $content)
	{
		return $this->endpoint('setGameScore', $content);
	}
	public function answerCallbackQuery(array $content)
	{
		return $this->endpoint('answerCallbackQuery', $content);
	}
	public function editMessageText(array $content)
	{
		return $this->endpoint('editMessageText', $content);
	}
	public function editMessageCaption(array $content)
	{
		return $this->endpoint('editMessageCaption', $content);
	}
	public function editMessageReplyMarkup(array $content)
	{
		return $this->endpoint('editMessageReplyMarkup', $content);
	}
	public function downloadFile($telegram_file_path, $local_file_path)
	{
		$file_url = 'https://api.telegram.org/file/bot' . $this->bot_token . '/' . $telegram_file_path;
		$in = fopen($file_url, 'rb');
		$out = fopen($local_file_path, 'wb');
		while ($chunk = fread($in, 8192)) {
			fwrite($out, $chunk, 8192);
		}
		fclose($in);
		fclose($out);
	}
	public function setWebhook($url, $certificate = '')
	{
		if ($certificate == '') {
			$requestBody = ['url' => $url];
		} else {
			$requestBody = ['url' => $url, 'certificate' => "@$certificate"];
		}
		return $this->endpoint('setWebhook', $requestBody, true);
	}
	public function deleteWebhook()
	{
		return $this->endpoint('deleteWebhook', [], false);
	}
	public function getData()
	{
		if (empty($this->data)) {
			$rawData = file_get_contents('php://input');
			return json_decode($rawData, true);
		} else {
			return $this->data;
		}
	}
	public function setData(array $data)
	{
		$this->data = $data;
	}
	public function Text()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return @$this->data['callback_query']['data'];
		}
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['text'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['text'];
		}
		return @$this->data['message']['text'];
	}
	public function Caption()
	{
		$type = $this->getUpdateType();
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['caption'];
		}
		return @$this->data['message']['caption'];
	}
	public function ChatID()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return @$this->data['callback_query']['message']['chat']['id'];
		}
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['chat']['id'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['chat']['id'];
		}
		if ($type == self::INLINE_QUERY) {
			return @$this->data['inline_query']['from']['id'];
		}
		return $this->data['message']['chat']['id'];
	}
	public function MessageID()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return @$this->data['callback_query']['message']['message_id'];
		}
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['message_id'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['message_id'];
		}
		return $this->data['message']['message_id'];
	}
	public function ReplyToMessageID()
	{
		return $this->data['message']['reply_to_message']['message_id'];
	}
	public function ReplyToMessageFromUserID()
	{
		return $this->data['message']['reply_to_message']['forward_from']['id'];
	}
	public function Inline_Query()
	{
		return $this->data['inline_query'];
	}
	public function Callback_Query()
	{
		return $this->data['callback_query'];
	}
	public function Callback_ID()
	{
		return $this->data['callback_query']['id'];
	}
	public function Callback_Data()
	{
		return $this->data['callback_query']['data'];
	}
	public function Callback_Message()
	{
		return $this->data['callback_query']['message'];
	}
	public function Callback_ChatID()
	{
		return $this->data['callback_query']['message']['chat']['id'];
	}
	public function Date()
	{
		return $this->data['message']['date'];
	}
	public function FirstName()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return @$this->data['callback_query']['from']['first_name'];
		}
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['from']['first_name'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['from']['first_name'];
		}
		return @$this->data['message']['from']['first_name'];
	}
	public function LastName()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return @$this->data['callback_query']['from']['last_name'];
		}
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['from']['last_name'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['from']['last_name'];
		}
		return @$this->data['message']['from']['last_name'];
	}
	public function Username()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return @$this->data['callback_query']['from']['username'];
		}
		if ($type == self::CHANNEL_POST) {
			return @$this->data['channel_post']['from']['username'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['from']['username'];
		}
		return @$this->data['message']['from']['username'];
	}
	public function Location()
	{
		return $this->data['message']['location'];
	}
	public function UpdateID()
	{
		return $this->data['update_id'];
	}
	public function UpdateCount()
	{
		return count($this->updates['result']);
	}
	public function UserID()
	{
		$type = $this->getUpdateType();
		if ($type == self::CALLBACK_QUERY) {
			return $this->data['callback_query']['from']['id'];
		}
		if ($type == self::CHANNEL_POST) {
			return $this->data['channel_post']['from']['id'];
		}
		if ($type == self::EDITED_MESSAGE) {
			return @$this->data['edited_message']['from']['id'];
		}
		return $this->data['message']['from']['id'];
	}
	public function FromID()
	{
		return $this->data['message']['forward_from']['id'];
	}
	public function FromChatID()
	{
		return $this->data['message']['forward_from_chat']['id'];
	}
	public function messageFromGroup()
	{
		if ($this->data['message']['chat']['type'] == 'private') {
			return false;
		}
		return true;
	}
	public function messageFromGroupTitle()
	{
		if ($this->data['message']['chat']['type'] != 'private') {
			return $this->data['message']['chat']['title'];
		}
	}
	public function buildKeyBoard(array $options, $onetime = false, $resize = false, $selective = true)
	{
		$replyMarkup = ['keyboard' => $options, 'one_time_keyboard' => $onetime, 'resize_keyboard' => $resize, 'selective' => $selective,];
		$encodedMarkup = json_encode($replyMarkup, true);
		return $encodedMarkup;
	}
	public function buildInlineKeyBoard(array $options)
	{
		$replyMarkup = ['inline_keyboard' => $options,];
		$encodedMarkup = json_encode($replyMarkup, true);
		return $encodedMarkup;
	}
	public function buildInlineKeyboardButton($text, $url = '', $callback_data = '', $switch_inline_query = null, $switch_inline_query_current_chat = null, $callback_game = '', $pay = '')
	{
		$replyMarkup = ['text' => $text,];
		if ($url != '') {
			$replyMarkup['url'] = $url;
		} elseif ($callback_data != '') {
			$replyMarkup['callback_data'] = $callback_data;
		} elseif (!is_null($switch_inline_query)) {
			$replyMarkup['switch_inline_query'] = $switch_inline_query;
		} elseif (!is_null($switch_inline_query_current_chat)) {
			$replyMarkup['switch_inline_query_current_chat'] = $switch_inline_query_current_chat;
		} elseif ($callback_game != '') {
			$replyMarkup['callback_game'] = $callback_game;
		} elseif ($pay != '') {
			$replyMarkup['pay'] = $pay;
		}
		return $replyMarkup;
	}
	public function buildKeyboardButton($text, $request_contact = false, $request_location = false)
	{
		$replyMarkup = ['text' => $text, 'request_contact' => $request_contact, 'request_location' => $request_location,];
		return $replyMarkup;
	}
	public function buildKeyBoardHide($selective = true)
	{
		$replyMarkup = ['remove_keyboard' => true, 'selective' => $selective,];
		$encodedMarkup = json_encode($replyMarkup, true);
		return $encodedMarkup;
	}
	public function buildForceReply($selective = true)
	{
		$replyMarkup = ['force_reply' => true, 'selective' => $selective,];
		$encodedMarkup = json_encode($replyMarkup, true);
		return $encodedMarkup;
	}
	public function sendInvoice(array $content)
	{
		return $this->endpoint('sendInvoice', $content);
	}
	public function answerShippingQuery(array $content)
	{
		return $this->endpoint('answerShippingQuery', $content);
	}
	public function answerPreCheckoutQuery(array $content)
	{
		return $this->endpoint('answerPreCheckoutQuery', $content);
	}
	public function sendVideoNote(array $content)
	{
		return $this->endpoint('sendVideoNote', $content);
	}
	public function restrictChatMember(array $content)
	{
		return $this->endpoint('restrictChatMember', $content);
	}
	public function promoteChatMember(array $content)
	{
		return $this->endpoint('promoteChatMember', $content);
	}
	public function exportChatInviteLink(array $content)
	{
		return $this->endpoint('exportChatInviteLink', $content);
	}
	public function setChatPhoto(array $content)
	{
		return $this->endpoint('setChatPhoto', $content);
	}
	public function deleteChatPhoto(array $content)
	{
		return $this->endpoint('deleteChatPhoto', $content);
	}
	public function setChatTitle(array $content)
	{
		return $this->endpoint('setChatTitle', $content);
	}
	public function setChatDescription(array $content)
	{
		return $this->endpoint('setChatDescription', $content);
	}
	public function pinChatMessage(array $content)
	{
		return $this->endpoint('pinChatMessage', $content);
	}
	public function unpinChatMessage(array $content)
	{
		return $this->endpoint('unpinChatMessage', $content);
	}
	public function getStickerSet(array $content)
	{
		return $this->endpoint('getStickerSet', $content);
	}
	public function uploadStickerFile(array $content)
	{
		return $this->endpoint('uploadStickerFile', $content);
	}
	public function createNewStickerSet(array $content)
	{
		return $this->endpoint('createNewStickerSet', $content);
	}
	public function addStickerToSet(array $content)
	{
		return $this->endpoint('addStickerToSet', $content);
	}
	public function setStickerPositionInSet(array $content)
	{
		return $this->endpoint('setStickerPositionInSet', $content);
	}
	public function deleteStickerFromSet(array $content)
	{
		return $this->endpoint('deleteStickerFromSet', $content);
	}
	public function deleteMessage(array $content)
	{
		return $this->endpoint('deleteMessage', $content);
	}
	public function getUpdates($offset = 0, $limit = 100, $timeout = 0, $update = true)
	{
		$content = ['offset' => $offset, 'limit' => $limit, 'timeout' => $timeout];
		$this->updates = $this->endpoint('getUpdates', $content);
		if ($update) {
			if (is_array($this->updates['result']) && count($this->updates['result']) >= 1) {
				$last_element_id = $this->updates['result'][count($this->updates['result']) - 1]['update_id'] + 1;
				$content = ['offset' => $last_element_id, 'limit' => '1', 'timeout' => $timeout];
				$this->endpoint('getUpdates', $content);
			}
		}
		return $this->updates;
	}
	public function serveUpdate($update)
	{
		$this->data = $this->updates['result'][$update];
	}
	public function getUpdateType()
	{
		$update = $this->data;
		if (isset($update['inline_query'])) {
			return self::INLINE_QUERY;
		}
		if (isset($update['callback_query'])) {
			return self::CALLBACK_QUERY;
		}
		if (isset($update['edited_message'])) {
			return self::EDITED_MESSAGE;
		}
		if (isset($update['message']['text'])) {
			return self::MESSAGE;
		}
		if (isset($update['message']['photo'])) {
			return self::PHOTO;
		}
		if (isset($update['message']['video'])) {
			return self::VIDEO;
		}
		if (isset($update['message']['audio'])) {
			return self::AUDIO;
		}
		if (isset($update['message']['voice'])) {
			return self::VOICE;
		}
		if (isset($update['message']['contact'])) {
			return self::CONTACT;
		}
		if (isset($update['message']['location'])) {
			return self::LOCATION;
		}
		if (isset($update['message']['reply_to_message'])) {
			return self::REPLY;
		}
		if (isset($update['message']['animation'])) {
			return self::ANIMATION;
		}
		if (isset($update['message']['sticker'])) {
			return self::STICKER;
		}
		if (isset($update['message']['document'])) {
			return self::DOCUMENT;
		}
		if (isset($update['channel_post'])) {
			return self::CHANNEL_POST;
		}
		return false;
	}
	private function sendAPIRequest($url, array $content, $post = true)
	{
		if (isset($content['chat_id'])) {
			$url = $url . '?chat_id=' . $content['chat_id'];
			unset($content['chat_id']);
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if ($post) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
		}
		if (!empty($this->proxy)) {
			if (array_key_exists('type', $this->proxy)) {
				curl_setopt($ch, CURLOPT_PROXYTYPE, $this->proxy['type']);
			}
			if (array_key_exists('auth', $this->proxy)) {
				curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy['auth']);
			}
			if (array_key_exists('url', $this->proxy)) {
				curl_setopt($ch, CURLOPT_PROXY, $this->proxy['url']);
			}
			if (array_key_exists('port', $this->proxy)) {
				curl_setopt($ch, CURLOPT_PROXYPORT, $this->proxy['port']);
			}
		}
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		if ($result === false) {
			$result = json_encode(['ok' => false, 'curl_error_code' => curl_errno($ch), 'curl_error' => curl_error($ch)]);
		}
		curl_close($ch);
		if ($this->log_errors) {
			if (class_exists('TelegramErrorLogger')) {
				$loggerArray = ($this->getData() == null) ? [$content] : [$this->getData(), $content];
				TelegramErrorLogger::log(json_decode($result, true), $loggerArray);
			}
		}
		return $result;
	}
}
if (!function_exists('curl_file_create')) {
	function curl_file_create($filename, $mimetype = '', $postname = '')
	{
		return "@$filename;filename=" . ($postname ?: basename($filename)) . ($mimetype ? ";type=$mimetype" : '');
	}
}

//ERROR LONGER BUAT EXCEPTION DAN LOG SISTEM
class TelegramErrorLogger
{
	private static $self;
	public static function log($result, $content, $use_rt = true)
	{
		try {
			if ($result['ok'] === false) {
				self::$self = new self();
				$e = new \Exception();
				$error = PHP_EOL;
				$error .= '==========[Response]==========';
				$error .= "\n";
				foreach ($result as $key => $value) {
					if ($value == false) {
						$error .= $key . ":\t\t\tFalse\n";
					} else {
						$error .= $key . ":\t\t" . $value . "\n";
					}
				}
				$array = '=========[Sent Data]==========';
				$array .= "\n";
				if ($use_rt == true) {
					foreach ($content as $item) {
						$array .= self::$self->rt($item) . PHP_EOL . PHP_EOL;
					}
				} else {
					foreach ($content as $key => $value) {
						$array .= $key . ":\t\t" . $value . "\n";
					}
				}
				$backtrace = '============[Trace]===========';
				$backtrace .= "\n";
				$backtrace .= $e->getTraceAsString();
				self::$self->_log_to_file($error . $array . $backtrace);
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
	private function _log_to_file($error_text)
	{
		try {
			$dir_name = 'logs';
			if (!is_dir($dir_name)) {
				mkdir($dir_name);
			}
			$fileName = $dir_name . '/' . __CLASS__ . '-' . date('Y-m-d') . '.txt';
			$myFile = fopen($fileName, 'a+');
			$date = '============[Date]============';
			$date .= "\n";
			$date .= '[ ' . date('Y-m-d H:i:s  e') . ' ] ';
			fwrite($myFile, $date . $error_text . "\n\n");
			fclose($myFile);
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
	private function rt($array, $title = null, $head = true)
	{
		$ref = 'ref';
		$text = '';
		if ($head) {
			$text = "[$ref]";
			$text .= "\n";
		}
		foreach ($array as $key => $value) {
			if ($value instanceof CURLFile) {
				$text .= $ref . '.' . $key . '= File' . PHP_EOL;
			} elseif (is_array($value)) {
				if ($title != null) {
					$key = $title . '.' . $key;
				}
				$text .= self::rt($value, $key, false);
			} else {
				if (is_bool($value)) {
					$value = ($value) ? 'true' : 'false';
				}
				if ($title != '') {
					$text .= $ref . '.' . $title . '.' . $key . '= ' . $value . PHP_EOL;
				} else {
					$text .= $ref . '.' . $key . '= ' . $value . PHP_EOL;
				}
			}
		}
		return $text;
	}
}
