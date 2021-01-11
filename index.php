<?php
ini_set('max_execution_time', 20);
//aktifkan saat mode debug. jika ngga ya jangan diaktifkan ;v
error_reporting(0);
echo 'Ini server 1 bot telegram';

include('Telegram.php');
//wajib diisi
// ______________________________
$userid_pemilik = '1393342467';
$telegramAPIs   = '1489990155:AAGmAjOQD5D0Bmivo6KkagMG0JqUtxc1wnk';
$api_key_cuttly = 'fa1d93ba90dedd2ceb7d01e9bade271653373';
//$host_server    = 'http://' . $_SERVER['HTTP_HOST'];
//$host_server   = 'https://serv1-fadhil-riyanto-bot.herokuapp.com';
$host_server   = 'https://serv1-fadhil-riyanto-bot.herokuapp.com';

date_default_timezone_set('Asia/Jakarta');
// ________________________________
$telegram = new Telegram($telegramAPIs);

$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');

//use http!!!!
//akhir wajib diisi
$text = strtolower(mysqli_real_escape_string($koneksi, $telegram->Text()));
$text_plain = $telegram->Text();
$chat_id = $telegram->ChatID();
$userID = $telegram->UserID();
$usernameBelumdiparse = $telegram->Username();

$username = ' @' . $usernameBelumdiparse;

$adanParse = explode(' ', $text);
$adanParse_plain = explode(' ', $text_plain);
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

if ($text == '/start' || $text == '/start@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', Apa kabar?';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
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
			$reply = 'Hai ' . $username . ', Faker data' . PHP_EOL . PHP_EOL .
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
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . ', Maaf, ada kesalahan di sistem kami.';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	}
	exit;
} elseif ('/wiki' == $adanParse[0] || '/wiki@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse[0], '', strtolower($text_plain));
	$udahDiparse = str_replace($adanParse[0] . ' ', '', strtolower($text_plain));

	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan wiki, gunakan command /wiki {teks atau kata}.' . PHP_EOL . PHP_EOL .  'Contoh : /wiki indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
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
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . 'Kami mendapatkan hasil di wikipedia. hasil : ' . PHP_EOL . PHP_EOL .
				$wiki_escape;
			$content = array('chat_id' => $chat_id, 'text' => $reply);
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
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
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
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
		/*$reply = 'Hasil pencarian '.$domain_name .PHP_EOL . PHP_EOL .
				'Status : '$parseSAXJsonAPIS->status;
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);*/
	} else {
		$reply = 'Maaf, Gunakan pattern /ip_geo {host atau IP}';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/tulis' == $adanParse[0] || '/tulis@fadhil_riyanto_bot' == $adanParse[0]) {
	//$hapusTulis = 
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text_plain);
	$curlImage = file_get_contents('https://tools.zone-xsec.com/api/nulis.php?q=' . urlencode($udahDiparse));
	$parsecJsons = json_decode($curlImage);
	if ($adanParse[1] == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Pattern kosong, gunakan format' . PHP_EOL . '/tulis {your text}';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	} elseif ($parsecJsons->status == "OK") {
		$konten = array('chat_id' => $chat_id, 'photo' => $parsecJsons->image);
		$telegram->sendPhoto($konten);
		$reply = 'Hai ' . $username . PHP_EOL . 'Gambar berhasil dibuat!';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, sepertinya ada yang error di sistem kami';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
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
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Gunakan pattern' . PHP_EOL . PHP_EOL . '/get_github_user {username github' . PHP_EOL . PHP_EOL . 'Contoh : /get_github_user torvalds';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	} elseif ($githubAPIS->message == "Not Found") {
		$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, tidak ditemukan, Mungkin kamu salah ketik atau mungkin akun yang kamu cari sudah dihapus sama Github';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . 'Info user github' . PHP_EOL . PHP_EOL .
			'ID :' . $githubAPIS->id . PHP_EOL .
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
		$konten = array('chat_id' => $chat_id, 'photo' => $githubAPIS->avatar_url);
		$telegram->sendPhoto($konten);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
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
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'IP dari host ' . $adanParse[1] . PHP_EOL . 'adalah ' . $ipHOST;
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '/get_ip {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_mx' == $adanParse[0] || '/get_mx@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=mx&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'MX dari host ' . $adanParse[1] . PHP_EOL .  'adalah ' . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_mx {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_ns' == $adanParse[0] || '/get_ns@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=ns&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'NS dari ' . $adanParse[1] . PHP_EOL . 'adalah ' . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '/get_ns {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_a' == $adanParse[0] || '/get_a@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=a&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'A dari ' . $adanParse[1] . ' adalah '  . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '/get_a {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_aaaa' == $adanParse[0] || '/get_aaaa@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=aaaa&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'AAAA dari ' . $adanParse[1] . ' adalah ' . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '/get_aaaa {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_txt' == $adanParse[0] || '/get_txt@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=txt&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'TXT dari ' . $adanParse[1] . ' adalah '  . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '/get_txt {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_cname' == $adanParse[0] || '/get_cname@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=cname&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'CNAME dari ' . $adanParse[1] . ' adalah '  . PHP_EOL . '------------------' . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, gunakan format' . PHP_EOL . '/get_cname {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($text == '/donate' || $text == '/donate@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', Saya senang mendengar anda mau donasi' . PHP_EOL . PHP_EOL .
		'Saya memiliki 2 cara untuk donasi' . PHP_EOL . PHP_EOL .
		'Cara pertama kamu hanya perlu mengirimkan banyak pertanyaan ringan ke bot. Agar apa? agar dia pintar. karena semakin banyak kata maka semakin banyak jumlah kata yang tersimpan (Jangan spam yaa, kasihan CPU server-nya).' . PHP_EOL . PHP_EOL .
		'Cara kedua kamu bisa mengirimkan uang ke saya, jumlah bebas dan seikhlasnya. uang akan digunakan untuk membeli dan memperpanjang hosting database server.' . PHP_EOL . PHP_EOL .
		'Contact @fadhil_riyanto untuk penjelasan lebih lanjut';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
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
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 1) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, link telah sebelumnya';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 2) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, itu bukanlah tautan';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 3) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, nama link yang diinginkan sudah digunakan';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 4) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'API key error, silahkan contact @fadhil_riyanto agar diperbarui olehnya. Mimin tipe orang humoris kok';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 5) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, LINK kamu tidak valid karena tidak lolos validasi. Termasuk karakter yang tidak valid';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 6) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Tautan yang diberikan berasal dari domain yang diblokir. seperti mengandung porno, judi, pishing, dan lain lain';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 7) {
					$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} else {
					$reply = 'error, contact @fadhil_riyanto okee';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				}
			} elseif ($userID != $userid_pemilik) {
				if (isset($adanParse[2])) {
					$reply = 'error, hanya @fadhil_riyanto yang bisa melakukan custom alias';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					exit;
				} else {
					$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse[1]);
					$json_shorturl = json_decode($json_pendekurl, true);
					if ($json_pendekurl == null) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Server sedang down';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 1) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, link telah sebelumnya';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 2) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, itu bukanlah tautan';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 3) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, nama link yang diinginkan sudah digunakan';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 4) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'API key error, silahkan contact @fadhil_riyanto agar diperbarui olehnya. Mimin tipe orang humoris kok';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 5) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, LINK kamu tidak valid karena tidak lolos validasi. Termasuk karakter yang tidak valid';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 6) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Tautan yang diberikan berasal dari domain yang diblokir. seperti mengandung porno, judi, pishing, dan lain lain';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 7) {
						$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} else {
						$reply = 'error, contact @fadhil_riyanto okee';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					}
				}
			}
		} else {
			$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, ini bukan URL!' . PHP_EOL . 'Url harus diawali dengan http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Gunakan parameter' . PHP_EOL . ' /short {link kamu}' . PHP_EOL . PHP_EOL . 'Contoh /short https://google.com';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
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
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					exit;
				} elseif (file_get_contents('https://api.banghasan.com' == null)) {
					$reply = 'Maaf ' . $username . ' Server api.banghasan.com sekarang down. Namun tenang, biasa nya dia akan menyala kembali';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					exit;
				}
			}
		} else {
			$reply = 'Hai ' . $username . ', Maaf, kota tidak ditemukan. Silahkan cek kembali tulisan untuk mendeteksi kemungkinan typo';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
			exit;
		}
	} elseif ($azanHilangcommand == null) {
		$reply = 'Maaf, gunakan pattern /azan namakota';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
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
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} elseif ($data_gempanya == null) {
		$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Maaf, server data.bmkg.go.id tidak aktif. silahkan coba lagi nanti';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($text == '/userid' || $text == '/userid@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', id kamu adalah' . PHP_EOL . 'ID :' . $userID . PHP_EOL . 'Terimakasih.';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/panggil' ||
	$text == '/panggil@fadhil_riyanto_bot'
) {
	$reply = 'Hai ' . $username . ', ada apa memanggil saya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
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
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/info' ||
	$text == '/info@fadhil_riyanto_bot' ||
	$text == 'info bot fadhil riyanto'
) {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Saya bot Fadhil Riyanto. Hobi saya bermain komputer dan membuat program' . PHP_EOL . PHP_EOL . 'Teknologi yang saya gunakan ialah. ' . PHP_EOL . 'Server: nginx' . PHP_EOL . 'Database: Mysql' . PHP_EOL . 'Cloud: Heroku, 000webhost' . PHP_EOL . 'PHP: 8.0.0 thread safe' . PHP_EOL . 'Versi bot: 9.7.3 alpha' . PHP_EOL . PHP_EOL . ' Dibuat dengan Cinta oleh @fadhil_riyanto' . PHP_EOL . PHP_EOL .  'Semoga bot ini membantu.';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
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
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/tanggal' || $text == '/tanggal@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'sekarang tanggal ' . date('l, d F Y');
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/bug' || $text == '/bug@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Silahkan PM @fadhil_riyanto' . PHP_EOL . PHP_EOL .
		'Jangan lupa sertakan Screenshot dan letak bug nya. yaaaa' . PHP_EOL . PHP_EOL .
		'Dengan kamu melaporkan bug, kamu telah membantu saya untuk membuat bot lebih baik lagi. Mimin orangnya tipe humoris kok';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
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
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'server mati sepertinya, coba lagi nanti' . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply);
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
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA256, gunakan command /sha256 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /sha256 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA256 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('sha256', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/sha1' == $adanParse[0] || '/sha1@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA1, gunakan command /sha1 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /sha1 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA1 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('sha1', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/sha512' == $adanParse[0] || '/sha512@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA512, gunakan command /sha512 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /sha512 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA512 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('sha512', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/sha384' == $adanParse[0] || '/sha384@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt SHA384, gunakan command /sha384 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /sha384 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma SHA384 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('sha384', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/md5' == $adanParse[0] || '/md5@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt md5, gunakan command /md5 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /md5 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD5 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('md5', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/md4' == $adanParse[0] || '/md4@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt md4, gunakan command /md4 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /md4 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD4 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('md4', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/md2' == $adanParse[0] || '/md2@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt md2, gunakan command /md2 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /md2 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD2 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('md2', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
}
//ALL HASH DISINI
// DIMULAI
elseif ('/ripemd128' == $adanParse[0] || '/ripemd128@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt ripemd128, gunakan command /ripemd128 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /ripemd128 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma ripemd128 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('ripemd128', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/ripemd160' == $adanParse[0] || '/ripemd160@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt ripemd160, gunakan command /ripemd160 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /ripemd160 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma ripemd160 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('ripemd160', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/ripemd256' == $adanParse[0] || '/ripemd256@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt ripemd256, gunakan command /ripemd256 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /ripemd256 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma ripemd256 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('ripemd256', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/ripemd320' == $adanParse[0] || '/ripemd320@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt ripemd320, gunakan command /ripemd320 {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /ripemd320 indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma ripemd320 adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('ripemd320', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/whirlpool' == $adanParse[0] || '/whirlpool@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt whirlpool, gunakan command /whirlpool {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /whirlpool indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma whirlpool adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : ' .  hash('whirlpool', $udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
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
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encode base64, gunakan command /base64_encode {teks atau kata}.' . PHP_EOL . PHP_EOL .
			'Contoh : /base64_encode indonesia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to base64 encode adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Encoded : ' .  base64_encode($udahDiparse);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/base64_decode' == $adanParse[0] || '/base64_decode@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan decode base64, gunakan command /base64_decode {base64 encoded teks}.' . PHP_EOL . PHP_EOL .
			'Contoh : /base64_decode SGFsbw==';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		if (base64_encode(base64_decode($udahDiparse, true)) === $udahDiparse) {
			$reply = 'Hai ' . $username . ', Hasil convert text to base64 decode adalah' . PHP_EOL . PHP_EOL .
				'Encoded : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Decoded : ' . base64_decode($udahDiparse);
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Hai ' . $username . ', Maaf, base64 yang akan didecode tidak valid';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	}
	exit;
}
// ENCRYPT TOOLS DIAKHIRI
// LICENSE BY FADHIL
// PAHAM?
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '$text' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);
//$dataAI = mysqli_fetch_assoc($q);

if ($tes_jumlah_row > 0) {
	foreach ($q as $respon) {

		$reply = $respon['data_res_ai'] . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}
} elseif ($tes_jumlah_row === 0) {

	$reply = '' . PHP_EOL . '';
	mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$text', 'hmhm')");
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}
