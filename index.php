<?php
set_time_limit(-1);
//aktifkan saat mode debug. jika ngga ya jangan diaktifkan ;v
error_reporting(0);
echo 'Hello world';

include(__DIR__ . '/vendor/autoload.php');
//wajib diisi
$userid_pemilik = '1393342467';
$telegram = new Telegram('1489990155:AAE8JG68gf968NWYwvW5ymEYlPMnggfPfHA');
$api_key_cuttly = 'fa1d93ba90dedd2ceb7d01e9bade271653373';
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');
date_default_timezone_set('Asia/Jakarta');
//use http!!!!
$host_server = 'https://cd5bf62044371454c8fa9b32f358c670.loophole.host';
//akhir wajib diisi
$text = strtolower(mysqli_real_escape_string($koneksi, $telegram->Text()));
$chat_id = $telegram->ChatID();
$userID = $telegram->UserID();

$adanParse = explode(' ', $text);
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
	$reply = 'Hai, Apa kabar?';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif('/tulis' == $adanParse[0] || '/tulis@fadhil_riyanto_bot' == $adanParse[0]){
	//$hapusTulis = 
	$udahDiparse = str_replace($adanParse[0].' ', '', $text);
	$curlImage = file_get_contents('https://tools.zone-xsec.com/api/nulis.php?q='.urlencode($udahDiparse));
	$parsecJsons = json_decode($curlImage);
	if($adanParse[1] == null){
		$reply = 'Pattern kosong, gunakan format' . PHP_EOL . '/tulis {your text}';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}elseif($parsecJsons->status == "OK"){
		$konten = array('chat_id' => $chat_id, 'photo' => $parsecJsons->image);
		$telegram->sendPhoto($konten);
		$reply = 'Gambar berhasil dibuat!';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}else{
		$reply = 'Maaf, sepertinya ada yang error di sistem kami';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}
	
}elseif ('/get_github_user' == $adanParse[0] || '/get_github_user@fadhil_riyanto_bot' == $adanParse[0]) {
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
	if($adanParse[1] == null){
		$reply = 'Maaf, Gunakan pattern' . PHP_EOL . PHP_EOL . '/get_github_user {username github';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}elseif($githubAPIS->message == "Not Found"){
		$reply = 'Maaf, tidak ditemukan';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}else{
		$reply = 'Info user github' . PHP_EOL . PHP_EOL .
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
				'updated_at : ' . $githubAPIS->updated_at . PHP_EOL  ;
		$konten = array('chat_id' => $chat_id, 'photo' => $githubAPIS->avatar_url );
		$telegram->sendPhoto($konten);
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);	
	exit;
	}
} elseif ($text == '/berhenti' || $text == '/berhenti@fadhil_riyanto_bot') {
	if ($userID == $userid_pemilik) {
		$reply = 'bot ter-stop!!';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = '';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	
}elseif ('/spam' == $adanParse[0] || '/spam@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($userID == $userid_pemilik) {
		if($adanParse[1] == null){
			$reply = 'Kosong!! Masukkan username yang ingin diSpam';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
			exit;
		}else{
			if($adanParse[2] < 100){
				if($adanParse[2] == null){
					$reply = 'Isikan jumlah spam!!';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
				}else{
					for($spam = 1; $spam <= $adanParse[2]; $spam++){
					$reply = 'Spam '.$spam. ' '. $adanParse[1];
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					//exit;
					}
					$reply = 'Spam selesai bos!!';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					exit;
				}
			}else{
			$reply = 'Pesan Harus dibawah 100!!';
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
			$reply = 'IP dari host ' . $adanParse[1] . ' adalah ' . $ipHOST;
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_ip {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_mx' == $adanParse[0] || '/get_mx@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=mx&dns=' . $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'mx dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Query DNS gagal';
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
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=ns&dns='. $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'ns dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_ns {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_a' == $adanParse[0] || '/get_a@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=a&dns='. $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'A dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_a {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_aaaa' == $adanParse[0] || '/get_aaaa@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=aaaa&dns='. $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'AAAA dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_aaaa {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_txt' == $adanParse[0] || '/get_txt@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=txt&dns='. $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'TXT dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_txt {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/get_cname' == $adanParse[0] || '/get_cname@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($adanParse[1] != null) {
		if (is_valid_domain_name($adanParse[1])) {
			$ipHOST = file_get_contents($host_server . '/APIs.php?method=cname&dns='. $adanParse[1]);
			if ($ipHOST != null) {
				$reply = 'CNAME dari host ' . $adanParse[1] . ' adalah ' . PHP_EOL . PHP_EOL . $ipHOST;
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			} else {
				$reply = 'Query DNS gagal';
				$content = array('chat_id' => $chat_id, 'text' => $reply);
				$telegram->sendMessage($content);
			}
		} else {
			$reply = 'Maaf, Harus Tanpa HTTP://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_cname {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($text == '/donate' || $text == '/donate@fadhil_riyanto_bot') {
	$reply = 'Hai, Saya senang mendengar anda mau donasi' . PHP_EOL . PHP_EOL .
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
					$reply = 'server down';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 1) {
					$reply = 'Maaf, link telah dipersingkat';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 2) {
					$reply = 'Maaf, itu bukan tautan';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 3) {
					$reply = 'nama link yang diinginkan sudah digunakan';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 4) {
					$reply = 'API key error';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 5) {
					$reply = 'tidak valid : link tidak lolos validasi. Termasuk karakter yang tidak valid';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 6) {
					$reply = 'Tautan yang diberikan berasal dari domain yang diblokir';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 7) {
					$reply = 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} else {
					$reply = 'error';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				}
			} elseif ($userID != $userid_pemilik) {
				if (isset($adanParse[2])) {
					$reply = 'error, hanya admin yang bisa melakukan custom alias';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
					exit;
				} else {
					$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse[1]);
					$json_shorturl = json_decode($json_pendekurl, true);
					if ($json_pendekurl == null) {
						$reply = 'server down';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 1) {
						$reply = 'Maaf, link telah dipersingkat';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 2) {
						$reply = 'Maaf, itu bukan tautan';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 3) {
						$reply = 'nama link yang diinginkan sudah digunakan';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 4) {
						$reply = 'API key error';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 5) {
						$reply = 'tidak valid : link tidak lolos validasi. Termasuk karakter yang tidak valid';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 6) {
						$reply = 'Tautan yang diberikan berasal dari domain yang diblokir';
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					} elseif ($json_shorturl["url"]["status"] == 7) {
						$reply = 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
						$content = array('chat_id' => $chat_id, 'text' => $reply);
						$telegram->sendMessage($content);
					}
				}
			}
		} else {
			$reply = 'Maaf, ini bukan URL!' . PHP_EOL . 'Url harus diawali dengan http://';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	} else {
		$reply = 'Gunakan parameter' . PHP_EOL . ' /short {link kamu}' . PHP_EOL . PHP_EOL . 'Contoh /short https://google.com';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ('/azan' == $adanParse[0] || '/azan@fadhil_riyanto_bot' == $adanParse[0]) {
	$adanKota = $hilangAzan;
	$tanggal = date("Y-m-d");
	$adanCurl = file_get_contents('https://api.pray.zone/v2/times/day.json?city=' . $adanKota . '&date=' . $tanggal);
	$json_adan = json_decode($adanCurl, true);

	if ($adanParse[1] == null) {
		$reply = 'maaf, anda salah. gunakan syntax' . PHP_EOL .
			'/azan {kota}' . PHP_EOL . PHP_EOL .
			'Contoh /azan jakarta';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} elseif ($json_adan != null) {
		$reply = 'Jadwal azan di' . $adanParse[1] . PHP_EOL . PHP_EOL .
			'Imsak ' . $json_adan['results']['datetime'][0]['times']['Imsak'] . PHP_EOL .
			'Terbit ' . $json_adan['results']['datetime'][0]['times']['Sunrise'] . PHP_EOL .
			'Fajar ' . $json_adan['results']['datetime'][0]['times']['Fajr'] . PHP_EOL .
			'Dzuhur ' . $json_adan['results']['datetime'][0]['times']['Dhuhr'] . PHP_EOL .
			'Ashar ' . $json_adan['results']['datetime'][0]['times']['Asr'] . PHP_EOL .
			'Terbenam ' . $json_adan['results']['datetime'][0]['times']['Sunset'] . PHP_EOL .
			'Maghrib ' . $json_adan['results']['datetime'][0]['times']['Maghrib'] . PHP_EOL .
			'Isya ' . $json_adan['results']['datetime'][0]['times']['Isha'] . PHP_EOL .
			'Tengah malam ' . $json_adan['results']['datetime'][0]['times']['Midnight'] . PHP_EOL . PHP_EOL .
			'Sumber : api.pray.zone';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} else {
		$reply = 'maaf, tidak tersedia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($text == '/gempa' || $text == '/gempa@fadhil_riyanto_bot') {
	$data_gempanya = @simplexml_load_file('https://data.bmkg.go.id/autogempa.xml');
	if ($data_gempanya != null) {
		$reply = 'Data gempa terkini' . PHP_EOL . PHP_EOL .
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
		$reply = 'Maaf, server data.bmkg.go.id tidak aktif. silahkan coba lagi';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($text == '/userid' || $text == '/userid@fadhil_riyanto_bot') {
	$reply = 'Hai, id kamu adalah' . PHP_EOL . 'ID :' . $userID . PHP_EOL . 'Terimakasih.';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/mention' ||
	$text == '/mention@fadhil_riyanto_bot'
) {
	$reply = 'Hai...ada apa memanggil saya?' . PHP_EOL;
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
	$reply = 'Sekarang jam ' . date('h:i:s a') . ', dihape kamu apa tidak cocok jamnya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif (
	$text == '/info' ||
	$text == '/info@fadhil_riyanto_bot' ||
	$text == 'info bot fadhil riyanto'
) {
	$reply = 'Hi....' . PHP_EOL . PHP_EOL . 'Saya bot Fadhil Riyanto. Hobi saya bermain komputer dan membuat program' . PHP_EOL . PHP_EOL . 'Teknologi yang saya gunakan ialah. ' . PHP_EOL . 'Server: nginx' . PHP_EOL . 'Database: Mysql' . PHP_EOL . 'Forward: ngrok' . PHP_EOL . 'PHP: 8.0 ts' . PHP_EOL . 'Versi: 8.3.3' . PHP_EOL . PHP_EOL . ' Dibuat dengan Cinta oleh @fadhil_riyanto' . PHP_EOL . PHP_EOL .  'Semoga bot ini membantu.';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/help' || $text == '/help@fadhil_riyanto_bot') {
	$reply = 'Hi....' . PHP_EOL . PHP_EOL .
		'Saya punya beberapa command untuk membantu kamu. Diantaranya adalah' . PHP_EOL . PHP_EOL .
		'/corona - info status corona' . PHP_EOL .
		'/userid - melihat ID user' . PHP_EOL .
		'/waktu - cek waktu terkini' . PHP_EOL .
		'/info - info bot ini' . PHP_EOL .
		'/mention - untuk memanggil saya' . PHP_EOL .
		'/start - memulai bot' . PHP_EOL .
		'/short - pendekkan link' . PHP_EOL .
		'/berhenti - hentikan thread bot' . PHP_EOL .
		'/tanggal - lihat tanggal' . PHP_EOL .
		'/bug - laporkan bug' . PHP_EOL .
		'/azan - Jadwal azan' . PHP_EOL .
		'/donate - Donasi ke developer' . PHP_EOL .
		'/gempa - Melihat info gempa terkini' . PHP_EOL .
		'/help - melihat semua command' . PHP_EOL . PHP_EOL .
		'Semoga bot ini membantu' . PHP_EOL;

	$option = array(
		//First row
		array($telegram->buildKeyboardButton("Button 1"), $telegram->buildKeyboardButton("Button 2"))
	);
	$keyb = $telegram->buildKeyBoard($option, $onetime = false);
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/tanggal' || $text == '/tanggal@fadhil_riyanto_bot') {
	$reply = 'sekarang tanggal ' . date('l, d F Y');
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/bug' || $text == '/bug@fadhil_riyanto_bot') {
	$reply = 'Silahkan PM @fadhil_riyanto' . PHP_EOL . PHP_EOL . 'Jangan lupa sertakan Screenshot dan letak bug nya. yaaaa' . PHP_EOL . PHP_EOL . 'Dengan kamu melaporkan bug, kamu telah membantu saya untuk membuat bot lebih baik lagi';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == null) {
} elseif (
	$text === '/corona' ||
	$text == '/corona@fadhil_riyanto_bot'
) {
	$file_korona = @file_get_contents('https://api.kawalcorona.com/indonesia/');
	$file_korona_jsonParse = json_decode($file_korona, true);
	if ($file_korona_jsonParse != NULL) {
		foreach ($file_korona_jsonParse as $corona_jadi) {
			$reply =  'Sepertinya jumlah kasus Corona adalah' . PHP_EOL . PHP_EOL . 'positif   ' . $corona_jadi['positif'] . PHP_EOL . 'sembuh    ' . $corona_jadi['sembuh'] . PHP_EOL . 'meninggal ' . $corona_jadi['meninggal'] . PHP_EOL . 'dirawat   ' . $corona_jadi['dirawat'] . PHP_EOL . PHP_EOL . 'Jangan lupa pakai masker dan jaga kesehatan.';
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
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '$text' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);

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
