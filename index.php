<?php
error_reporting(0);
echo 'Hello world';
include(__DIR__ . '/vendor/autoload.php');
$userid_pemilik = '1393342467';
$telegram = new Telegram('1489990155:AAGb7YFsVA-G2Vs28R6fQQZ8uxMm3ouCFDg');
$api_key_cuttly = 'fa1d93ba90dedd2ceb7d01e9bade271653373';
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');
date_default_timezone_set('Asia/Jakarta');
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
} elseif ('/get_hostname' == $adanParse[0] || '/get_hostname@fadhil_riyanto_bot' == $adanParse[0]) {
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
		$reply = 'Maaf, gunakan format' . PHP_EOL . '/get_hostname {domain}' . PHP_EOL . PHP_EOL . 'Note: Tanpa HTTP://';
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
} elseif ($text == '/berhenti' || $text == '/berhenti@fadhil_riyanto_bot') {
	$reply = 'bot ter-stop!!';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
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
			'Wilayah :' . $data_gempanya->gempa->Wilayah . PHP_EOL .
			'Potensi :' . $data_gempanya->gempa->Potensi . PHP_EOL . PHP_EOL . PHP_EOL . 'Sumber : BMKG';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	} elseif ($data_gempanya == null) {
		$reply = 'Maaf, server BMKG tidak aktif. silahkan coba lagi';
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

	$reply = '... Percakapan ini saya simpan untuk pembendaharaan kata kata agar bot lebih pintar lagi ' . PHP_EOL . 'Balas oke';
	mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$text', 'null')");
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}
