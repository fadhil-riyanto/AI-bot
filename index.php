<?php
define('DB_HOST', 'freedb.tech');											//WAJIB
define('DB_USERNAME', 'freedbtech_ai_bot_fadhil_riyanto');					//WAJIB
define('DB_PASSWORD', '789b697698hyufijbbiub*&^BO&it87tbn7to&^7896');		//WAJIB
define('DB_NAME', 'freedbtech_ai_bot_fadhil_riyanto');						//WAJIB
define('TG_HTTP_API', '1489990155:AAEC3c6I-hmtDfbk9OojmlDjNFt1NeMEjfs');	//WAJIB
define('USER_ID_TG_ME', '1393342467');										//WAJIB
define('CUTLLY_API', 'fa1d93ba90dedd2ceb7d01e9bade271653373');				//WAJIB
define('TIME_ZONE', 'Asia/Jakarta');										//WAJIB
define('MAX_EXECUTE_SCRIPT', 20);											//SUNNAH_ROSUL

// PENJELASAN SINGKAT

// DB_HOST digunakan untuk login ke database, begitu juga username dan password_get_info
// TG HTTP API digunakan untuk identifikasi API, bisa didapat di @botfather
// USERid digunakan untuk identifikasi
// Cutlly digunakan untuk fitur /SHORT
// Time zone digunakan untuk fitur tanggal dan waktu

// =============== BARIS SELANJUT NYA TIDAK USAH DIUBAH. KARENA KEMUNGKINAN KAMU TIDAL PAHAM ============

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/ai_robot.php';



ini_set('max_execution_time', MAX_EXECUTE_SCRIPT);
error_reporting(1);
$userid_pemilik = USER_ID_TG_ME;
$telegramAPIs   = TG_HTTP_API;
$api_key_cuttly = CUTLLY_API;

echo 'Ini server 1 bot telegram' . PHP_EOL . '<hr>';
function SERVER_ALAMAT_addr()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
		$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	return $protocol . $domainName;
}

function _is_curl_installed()
{
	if (in_array('curl', get_loaded_extensions())) {
		return true;
	} else {
		return false;
	}
}

// Ouput text to user based on test
if (_is_curl_installed()) {
	echo "Bagus, cURL sudah <span style=\"color:blue\">TERPASANG</span> diserver ini" . PHP_EOL;
} else {
	echo "cURL belum <span style=\"color:red\">TERPASANG</span> diserver ini" . PHP_EOL;
}
echo '<br>Memory usage : ' . memory_get_usage();
function waktu_aktif()
{
	$ut = strtok(exec("cat /proc/uptime"), ".");
	$days = sprintf("%2d", ($ut / (3600 * 24)));
	$hours = sprintf("%2d", (($ut % (3600 * 24)) / 3600));
	$min = sprintf("%2d", ($ut % (3600 * 24) % 3600) / 60);
	$sec = sprintf("%2d", ($ut % (3600 * 24) % 3600) % 60);


	return array($days, $hours, $min, $sec);
}
//include('Telegram.php');
$host_server   = SERVER_ALAMAT_addr();
//$host_server   = 'http://server-data.000webhostapp.com';

date_default_timezone_set(TIME_ZONE);
$telegram = new Telegram($telegramAPIs);
$koneksi = @mysqli_connect(
	DB_HOST,
	DB_USERNAME,
	DB_PASSWORD,
	DB_NAME
);

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
	$namaPertama = $telegram->FirstName();
	$namaTerakhir = $telegram->LastName();
} else {
	$text = htmlspecialchars(strtolower($telegram->Text()));
	$text_plain = htmlspecialchars($telegram->Text());
	$text_plain_nokarakter = $telegram->Text();
	$chat_id = $telegram->ChatID();
	$userID = $telegram->UserID();
	$message_id = $telegram->MessageID();
	$usernameBelumdiparse = $telegram->Username();
	$namaPertama = $telegram->FirstName();
	$namaTerakhir = $telegram->LastName();
}

if ($usernameBelumdiparse != null) {
	$username = ' @' . $usernameBelumdiparse;
} else {
	$username = '<a href="tg://user?id=' . $userID . '">' . $namaPertama . ' ' . $namaTerakhir . '</a>';
}

$adanParse = explode(' ', $text);
$adanParse_plain = explode(' ', $text_plain);
$adanParse_plain_nokarakter = explode(' ', $text_plain_nokarakter);

$hilangAzan = str_replace('/azan ', '', $text, $hit);
if ($hit == 0) {
	$hilangAzan = str_replace('/azan@fadhil_riyanto_bot ', '', $text);
}
function detect_grup()
{
	global $chat_id;
	$pregs = substr($chat_id, 0, 1);
	if ($pregs == '-') {
		return true;
	}
}
function is_valid_domain_name($domain_name)
{
	return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
		&& preg_match("/^.{1,253}$/", $domain_name) //overall length check
		&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)); //length of each label
}

function cek_domain($url)
{
	// KEMbalikan BOOL ::
	$validation = FALSE;
	/*Parse URL*/
	$urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
	/*Check host exist else path assign to host*/
	if (!isset($urlparts['host'])) {
		$urlparts['host'] = $urlparts['path'];
	}

	if ($urlparts['host'] != '') {
		/*Add scheme if not found*/
		if (!isset($urlparts['scheme'])) {
			$urlparts['scheme'] = 'http';
		}
		/*Validation*/
		if (checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'], array('http', 'https')) && ip2long($urlparts['host']) === FALSE) {
			$urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
			$url = $urlparts['scheme'] . '://' . $urlparts['host'] . "/";

			if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
				$validation = TRUE;
			}
		}
	}

	if (!$validation) {
		return false;
	} else {
		return true;
	}
}

function hapus_http($url)
{
	$disallowed = array('http://', 'https://');
	foreach ($disallowed as $d) {
		if (strpos($url, $d) === 0) {
			return str_replace($d, '', $url);
		}
	}
	return $url;
}

$stringPertama = substr($text, 0, 1);
$stringKedua = substr($text, 0, 2);

$stringTerakhir = substr($text, 0, -1);
$memberBaru = $telegram->member_baru();
//sleep(10);
//TRACK DATA
// $q_track = mysqli_query($koneksi, "SELECT * FROM `client_user` WHERE `userid` LIKE '$userID' ");
// $q_track_row = @mysqli_affected_rows($koneksi);
// $q_track_user = mysqli_fetch_assoc($q_track);
// if ($q_track_row > 0) {
// } else {
// 	mysqli_query($koneksi, "INSERT INTO `freedbtech_ai_bot_fadhil_riyanto`.`client_user` (`username`, `userid`, `firstname`, `lastname`) VALUES ('$usernameBelumdiparse', '$userID', '$namaPertama', '$namaTerakhir')");
// }

function tracking_user($userID)
{
	$file = __DIR__ . "/json_data/user_client.json";
	$anggota = file_get_contents($file);
	$data = json_decode($anggota, true);
	foreach ($data as $d) {
		if ($d['userid'] == $userID) {
			return true;
		}
	}
}

$chek = tracking_user($userID);
if ($chek == true) {
} elseif ($chek == null) {
	$file = __DIR__ . "/json_data/user_client.json";
	$anggota = file_get_contents($file);
	$data = json_decode($anggota, true);

	$data[] = array(
		"userid" => $userID,
		"username" => $usernameBelumdiparse,
		"firstname" => $namaPertama,
		"lastname" => $namaTerakhir
	);

	$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
	$anggota = file_put_contents($file, $jsonfile);
}

$status = array('chat_id' => $chat_id, 'action' => 'typing');
$telegram->sendChatAction($status);

use Stichoza\GoogleTranslate\GoogleTranslate;

if ($text == '/start' || $text == '/start@fadhil_riyanto_bot') {
	$reply = 'Hai ' . $username . ', Apa kabar? ';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ($text == '/leave' || $text == '/leave@fadhil_riyanto_bot') {
	if ($userID == $userid_pemilik) {
		$content = array('chat_id' => '@fadhil_riyanto_project');
		$telegram->leaveChat($content);
	}
} elseif ('/db_add' == $adanParse[0] || '/db_add@fadhil_riyanto_bot' == $adanParse[0]) {
	if ($userID != $userid_pemilik) {
		exit;
	}
	$azanHilangcommand = str_replace($adanParse[0], '', $text);
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

	$db_kirim = explode('$', $udahDiparse);
	mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$db_kirim[0]', '$db_kirim[1]')");


	$reply = 'done';

	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif (isset($memberBaru)) {
	$reply = 'Halo, apa kabar mu?';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ('/help' == $adanParse[0] || '/help@fadhil_riyanto_bot' == $adanParse[0]) {
	if (detect_grup() == true) {
		$reply = 'Hai ' . $username . ', Maaf, menu ini hanya bisa diakses via PM';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	} else {
		$reply = 'Hai ' . $username . ', Selamat datang di buku panduan bot ini';
		$option = array(
			//First row
			array(
				$telegram->buildInlineKeyBoardButton("corona", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot corona'),
				$telegram->buildInlineKeyBoardButton("userid", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot userid')
			),
			array(
				$telegram->buildInlineKeyBoardButton("waktu", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot waktu'),
				$telegram->buildInlineKeyBoardButton("info", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot info')
			),
			array(
				$telegram->buildInlineKeyBoardButton("panggil", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot panggil'),
				$telegram->buildInlineKeyBoardButton("start", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot start')
			),
			array(
				$telegram->buildInlineKeyBoardButton("short", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot short'),
				$telegram->buildInlineKeyBoardButton("tanggal", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot tanggal')
			),
			array(
				$telegram->buildInlineKeyBoardButton("bug", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot bug'),
				$telegram->buildInlineKeyBoardButton("azan", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot azan')
			),
			array(
				$telegram->buildInlineKeyBoardButton("donate", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot donate'),
				$telegram->buildInlineKeyBoardButton("gempa", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot gempa')
			),
			array(
				$telegram->buildInlineKeyBoardButton("help", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot help'),
				$telegram->buildInlineKeyBoardButton("wiki", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot wiki')
			),

			array(
				$telegram->buildInlineKeyBoardButton("tulis", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot tulis'),
				$telegram->buildInlineKeyBoardButton("get_ip", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_ip')
			),
			array(
				$telegram->buildInlineKeyBoardButton("get_mx", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_mx'),
				$telegram->buildInlineKeyBoardButton("get_ns", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_ns')
			),
			array(
				$telegram->buildInlineKeyBoardButton("get_aaaa", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_aaaa'),
				$telegram->buildInlineKeyBoardButton("get_txt", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_txt')
			),
			array(
				$telegram->buildInlineKeyBoardButton("get_cname", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_cname'),
				$telegram->buildInlineKeyBoardButton("get_github_user", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_github_user')
			),
			array(
				$telegram->buildInlineKeyBoardButton("ip_geo", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ip_geo'),
				$telegram->buildInlineKeyBoardButton("faker", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot faker')
			),
			array(
				$telegram->buildInlineKeyBoardButton("sha512", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha512'),
				$telegram->buildInlineKeyBoardButton("sha384", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha384')
			),
			array(
				$telegram->buildInlineKeyBoardButton("sha256", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha256'),
				$telegram->buildInlineKeyBoardButton("sha1", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha1')
			),
			array(
				$telegram->buildInlineKeyBoardButton("md5", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot md5'),
				$telegram->buildInlineKeyBoardButton("md4", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot md4')
			),
			array(
				$telegram->buildInlineKeyBoardButton("md2", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot md2'),
				$telegram->buildInlineKeyBoardButton("base64_encode", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot base64_encode')
			),
			array(
				$telegram->buildInlineKeyBoardButton("base64_decode", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot base64_decode'),
				$telegram->buildInlineKeyBoardButton("ripemd128", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd128')
			),
			array(
				$telegram->buildInlineKeyBoardButton("ripemd160", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd160'),
				$telegram->buildInlineKeyBoardButton("ripemd256", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd256')
			),
			array(
				$telegram->buildInlineKeyBoardButton("ripemd320", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd320'),
				$telegram->buildInlineKeyBoardButton("whirlpool", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot whirlpool')
			), array(
				$telegram->buildInlineKeyBoardButton("capture", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot capture'),

			),

		);
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
	}
} elseif ('/callback_q' == $adanParse[0] || '/callback_q@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse[0], '', $text);
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
	$get_help_files = file_get_contents(__DIR__ . '/json_data/slangword.json');
	$helper = json_decode($get_help_files, true);


	$reply = $helper[$udahDiparse];
	$option = array(
		array($telegram->buildInlineKeyBoardButton("kembali", $url = "", $callback_data = '/help@fadhil_riyanto_bot'))
	);
	$keyb = $telegram->buildInlineKeyBoard($option);
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ('/capture' == $adanParse[0] || '/capture@fadhil_riyanto_bot' == $adanParse[0]) {
	$azanHilangcommand = str_replace($adanParse[0], '', $text);
	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

	$hash_cek = hash_file('md5', 'https://cdn.statically.io/screenshot/' . hapus_http($udahDiparse));

	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan capture, gunakan command <pre>/capture {domain or IP}</pre>' . PHP_EOL . PHP_EOL .  'Contoh : <pre>/capture google.com</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} elseif ($udahDiparse != null) {

		if ($hash_cek == '9c60b52f2f14216bf26f6685c2f25283') {
			// $reply = '1';
			// $content = array('chat_id' => $chat_id, 'photo' => 'https://cdn.statically.io/screenshot/google.com');
			// $telegram->sendPhoto($content);
			$reply = 'Maaf, kami tidak bisa mendapatkan gambar nya. Mungkin url kamu salah atau mungkin server yang tidak aktif. Kamu bisa coba mengeja kembali atau menambahkan WWW didepan nya';
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		} else {
			$content = array('chat_id' => $chat_id, 'photo' => 'https://cdn.statically.io/screenshot/' . hapus_http($udahDiparse), 'reply_to_message_id' => $message_id);
			$telegram->sendPhoto($content);
		}
	}
	exit;
}
// } elseif ('/capture_full' == $adanParse[0] || '/capture_full@fadhil_riyanto_bot' == $adanParse[0]) {

// 	$azanHilangcommand = str_replace($adanParse[0], '', $text);
// 	$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);

// 	$hash_cek = hash_file('md5', 'https://cdn.statically.io/screenshot/' . hapus_http($udahDiparse));

// 	if ($azanHilangcommand == null) {
// 		$reply = 'Hai ' . $username . PHP_EOL . 'Ini adalah command untuk menggunakan mengambil capture web secara full page, gunakan command <pre>/capture_full {domain or IP}</pre>' . PHP_EOL . PHP_EOL .  'Contoh : <pre>/capture_full google.com</pre>';
// 		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 		$telegram->sendMessage($content);
// 	} elseif ($udahDiparse != null) {

// 		if ($hash_cek == '9c60b52f2f14216bf26f6685c2f25283') {
// 			// $reply = '1';
// 			// $content = array('chat_id' => $chat_id, 'photo' => 'https://cdn.statically.io/screenshot/google.com');
// 			// $telegram->sendPhoto($content);
// 			$reply = 'Maaf, kami tidak bisa mendapatkan gambar nya. Mungkin url kamu salah atau mungkin server yang tidak aktif. Kamu bisa coba mengeja kembali atau menambahkan WWW didepan nya';
// 			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 			$telegram->sendMessage($content);
// 		} else {
// 			$content = array('chat_id' => $chat_id, 'document' => 'https://cdn.statically.io/screenshot/full=true/' . hapus_http($udahDiparse), 'reply_to_message_id' => $message_id);
// 			$telegram->sendDocument($content);
// 		}
// 	}
// 	exit;
// } 
elseif ('/faker' == $adanParse[0] || '/faker@fadhil_riyanto_bot' == $adanParse[0]) {
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

	$option = array(
		//First row
		array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = "https://t.me/fadhil_riyanto_project"), $telegram->buildInlineKeyBoardButton("❓ Help", $url = "", $callback_data = '/help@fadhil_riyanto_bot')),
		//Second row 
		array($telegram->buildInlineKeyBoardButton("🎉 Tambahkan saya ke group", $url = "https://t.me/fadhil_riyanto_bot?startgroup=new"))
	);
	$keyb = $telegram->buildInlineKeyBoard($option);
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'reply_markup' => $keyb, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
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
	$reply = 'Hai ' . $username . PHP_EOL . PHP_EOL . 'Silahkan kirim laporan ke  <a href="https://t.me/fadhil_riyanto_project">👥 Support Group</a>' . PHP_EOL . PHP_EOL .
		'Jangan lupa sertakan Screenshot dan letak bug nya. yaaaa' . PHP_EOL . PHP_EOL .
		'Dengan kamu melaporkan bug, kamu telah membantu saya untuk membuat bot lebih baik lagi. Mimin orangnya tipe humoris kok';
	$option = array(
		//First row
		// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
		// //Second row 
		// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
		// //Third row

		array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = 'https://t.me/fadhil_riyanto_project'))
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
} elseif ($stringPertama == '/') {
	// Jika ditemukan data dengan awalan coommand telegram, maka dia ngga akan diinsert ke database
	// kita menggunakan exit agar dia keluar dari konsol
	exit;
}
// ENCRYPT TOOLS DIAKHIRI
// LICENSE BY FADHIL
// PAHAM?
$ai_chatting = robot_artificial_intelegence($text);
$ai_chatting_decode = json_decode($ai_chatting);
if ($ai_chatting_decode->bad_word == true) {
	$reply = 'Aku ogah jawab ah, ada kata kata yg tidak sopan soalnya';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
}

if ($koneksi == 1) {
	if ($ai_chatting_decode->affected > 0) {
		$reply = Emoji::Decode($ai_chatting_decode->respon) . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		exit;
		//}
	} elseif ($ai_chatting_decode->affected === 'simsimi') {

		$reply = Emoji::Decode($ai_chatting_decode->respon) . PHP_EOL;
		//mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$teksTerfilter', 'hmhm')");
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
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

		array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = 'https://t.me/fadhil_riyanto_project'))
	);
	$keyb = $telegram->buildInlineKeyBoard($option);


	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
}
// TELEGRAM KELAS
// V 4
// API CLASS DIMULAI DISINI WOYY


class Emoji
{
	/**
	 * Encode emoji in text
	 * @param string $text text to encode
	 */
	public static function Encode($text)
	{
		return self::convertEmoji($text, "ENCODE");
	}

	/**
	 * Decode emoji in text
	 * @param string $text text to decode
	 */
	public static function Decode($text)
	{
		return self::convertEmoji($text, "DECODE");
	}

	private static function convertEmoji($text, $op)
	{
		if ($op == "ENCODE") {
			return preg_replace_callback('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{1F000}-\x{1FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F9FF}][\x{1F000}-\x{1FEFF}]?/u', array('self', "encodeEmoji"), $text);
		} else {
			return preg_replace_callback('/(\\\u[0-9a-f]{4})+/', array('self', "decodeEmoji"), $text);
		}
	}

	private static function encodeEmoji($match)
	{
		return str_replace(array('[', ']', '"'), '', json_encode($match));
	}

	private static function decodeEmoji($text)
	{
		if (!$text) return '';
		$text = $text[0];
		$decode = json_decode($text, true);
		if ($decode) return $decode;
		$text = '["' . $text . '"]';
		$decode = json_decode($text);
		if (count($decode) == 1) {
			return $decode[0];
		}
		return $text;
	}
}
