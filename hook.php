<?php
$debugwaktu_awal = microtime(true);

require __DIR__ . '/pengaturan/env.php';
require __DIR__ . '/include/hook_function_core.php';
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
$id_bot_sendiri = ID_BOT;
echo 'Ini server 1 bot telegram' . PHP_EOL . '<hr>';




// Ouput text to user based on test
if (_is_curl_installed()) {
	echo "Bagus, cURL sudah <span style=\"color:blue\">TERPASANG</span> diserver ini" . PHP_EOL;
} else {
	echo "cURL belum <span style=\"color:red\">TERPASANG</span> diserver ini" . PHP_EOL;
}
echo '<br>Memory usage : ' . memory_get_usage();

//include('Telegram.php');
$host_server   = SERVER_ALAMAT_addr();
//$host_server   = 'http://server-data.000webhostapp.com';

date_default_timezone_set(TIME_ZONE);
$telegram = new Telegram($telegramAPIs);




//use http!!!!
//akhir wajib diisi

$text = htmlspecialchars(strtolower($telegram->Text()));
$text_plain = htmlspecialchars($telegram->Text());
$text_plain_nokarakter = $telegram->Text();
$chat_id = $telegram->ChatID();
$userID = $telegram->UserID();
$message_id = $telegram->MessageID();
$usernameBelumdiparse = $telegram->Username();
$namaPertama = $telegram->FirstName();
$namaTerakhir = $telegram->LastName();

$adanParse = explode(' ', $text);
$adanParse_plain = explode(' ', $text_plain);
$adanParse_plain_nokarakter = explode(' ', $text_plain_nokarakter);

// if ($userID != $userid_pemilik) {

// 	exit;
// }


$hilangAzan = str_replace('/azan ', '', $text, $hit);
if ($hit == 0) {
	$hilangAzan = str_replace('/azan' . USERNAME_BOT . ' ', '', $text);
}

if ('/ping_detail' == $adanParse[0] || '/ping_detail' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/ping_detail.php';
	exit;
}
if ('/ping' == $adanParse[0] || '/ping' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/ping.php';
	exit;
}

function whitelist_check($userID)
{
	$file = __DIR__ . "/json_data/whitelist_userid.json";
	$anggota = file_get_contents($file);
	$data = json_decode($anggota, true);
	foreach ($data as $d) {
		if ($d['userid'] == $userID) {
			return true;
		}
	}
}
$cek_daftarputih = whitelist_check($userID);

if ($cek_daftarputih == true) {
	exit;
} elseif ($cek_daftarputih == null) {
}

if ($usernameBelumdiparse != null) { //Jika user ada usernamenya
	$username = ' @' . $usernameBelumdiparse;
} else { //ini user aneh, username gaada.....
	$username = '<a href="tg://user?id=' . $userID . '">' . $namaPertama . ' ' . $namaTerakhir . '</a>';
}

$data_stiker = $telegram->getData();
$stiker_hapus = $data_stiker['message']['sticker']['file_unique_id'];
$stiker_hapus2 = $data_stiker['message']['sticker']['thumb']['file_id']['file_unique_id'];
if (isset($stiker_hapus2)) {
	if (
		$stiker_hapus2 == 'AgADWAEAAmrOKEY'
	) {
		$arr = array('chat_id' => $chat_id, 'message_id' => $message_id);
		$telegram->deleteMessage($arr);
	}
}

if (isset($stiker_hapus)) {
	if (
		$stiker_hapus == 'AgADCQADm23LJA' || $stiker_hapus == 'AgADZQEAAoGHIEY' || $stiker_hapus == 'AgADAwEAAt84IUY'
		||  $stiker_hapus == 'AgADZQEAAoGHIEY'
	) {
		$arr = array('chat_id' => $chat_id, 'message_id' => $message_id);
		$telegram->deleteMessage($arr);
	}
} else {
}
if ($text == ':v' || $text == ';v' || $text == '/copy') {
	$arr = array('chat_id' => $chat_id, 'message_id' => $message_id);
	$telegram->deleteMessage($arr);
}



$result = $telegram->getData();
$getreplyianid = $result['message']['reply_to_message']['from']['id'];
$afkforstname = $result['message']['reply_to_message']['from']['first_name'];
$afklastname = $result['message']['reply_to_message']['from']['last_name'];
$entityUserAfk = $result['message']['entities'];
// $jsongetafk = file_get_contents(__DIR__ . '/json_data/afk.json');
// $jsonafk = json_decode($jsongetafk, true);
// foreach ($jsonafk as $daftarafk) {
// 	if ($daftarafk['userid'] == $getreplyianid) {
// 		$reply = 'maaf, ' . $afkforstname . ' ' . $afklastname  . ' sedang afk' . PHP_EOL . 'Alasan : ' .  $daftarafk['alasan'];
// 		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 		$telegram->sendMessage($content);
// 		exit;
// 	}
// }


if (isset($getreplyianid)) {

	$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$db->where("userid", $getreplyianid);
	$user = $db->getOne("afk_user_data");
	if ($user['userid'] == null) {
	} else {
		if ($getreplyianid == $userID) {
			if (substr($text_plain_nokarakter, 0, 1) == '/') {
			} else {
				exit;
			}
		} else {
			$reply = "Maaf ," . $afkforstname . ' ' . $afklastname . ' sedang AFK sejak ' . $user['time_afk'] . PHP_EOL .
				'Alasan : ' . $user['alasan'];
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
			exit;
		}
	}
}


if (isset($entityUserAfk)) {
	foreach ($entityUserAfk as $getEntity) {
		if ($getEntity['type'] == 'text_mention' || $getEntity['type'] == 'mention') {
			$username_Yang_didapaktkanAFK[] = substr($text_plain_nokarakter, $getEntity['offset'] + 1, $getEntity['length']);
		}
	}
	foreach ($username_Yang_didapaktkanAFK as $uafkdata) {
		$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		$db->where("username", $uafkdata);
		$getDataafku = $db->getOne("afk_user_data");
		if ($getDataafku['username'] != null) {
			$reply = "Maaf ," . $getDataafku['username'] . ' sedang AFK sejak ' . $getDataafku['time_afk'] . PHP_EOL .
				'Alasan : ' . $getDataafku['alasan'];
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	}
}

if (isset($text)) {
	require __DIR__ . '/include/autounafk.php';
}
// $pregMention = preg_match_all('/@([a-zA-Z0-9_]+)/', $text_plain_nokarakter);
// if ($pregMention > 0) {
// 	$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// }


// $anggota = file_get_contents(__DIR__ . '/pengaturan/settings.json');

// $data = json_decode($anggota, true);
// foreach ($data as $key => $d) {
// 	if ($d['no'] === 1) {
// 		if ($userID == $userid_pemilik) {
// 			continue;
// 		} elseif ($d['debug'] == true) {
// 			$reply = 'maaf, bot ini sedang dalam perbaikan';
// 			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 			$telegram->sendMessage($content);
// 			exit;
// 		} elseif ($d['debug'] == false) {
// 			continue;
// 		}
// 	}
// }



$deteksiApakahGrup = detect_grup();
$gc_command_verify = detect_grup();

$stringPertama = substr($text, 0, 1);
$stringKedua = substr($text, 0, 2);

$stringTerakhir = substr($text, 0, -1);
$memberBaru = $telegram->member_baru();

$result_getreplyian = $telegram->getData();
$replyid_replian = $result_getreplyian['message']['reply_to_message']['from']['id'];

//sleep(10);
//TRACK DATA
// $q_track = mysqli_query($koneksi, "SELECT * FROM `client_user` WHERE `userid` LIKE '$userID' ");
// $q_track_row = @mysqli_affected_rows($koneksi);
// $q_track_user = mysqli_fetch_assoc($q_track);
// if ($q_track_row > 0) {
// } else {
// 	mysqli_query($koneksi, "INSERT INTO `freedbtech_ai_bot_fadhil_riyanto`.`client_user` (`username`, `userid`, `firstname`, `lastname`) VALUES ('$usernameBelumdiparse', '$userID', '$namaPertama', '$namaTerakhir')");
// }


// $chek = tracking_user($userID);
// if ($chek == true) {
// } elseif ($chek == null) {
// 	$file = __DIR__ . "/json_data/user_client.json";
// 	$anggota = file_get_contents($file);
// 	$data = json_decode($anggota, true);

// 	$data[] = array(
// 		"userid" => $userID,
// 		"username" => $usernameBelumdiparse,
// 		"firstname" => $namaPertama,
// 		"lastname" => $namaTerakhir
// 	);

// 	$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
// 	$anggota = file_put_contents($file, $jsonfile);
// }



$calkulatorpreg = preg_match('/[a-zA-Z]\s+([-+]?\s*\d+(?:\s*[-+*\/]\s*[-+]?\s*\d+)+)/i', $text, $hasilpreg);

if (isset($text)) {
	$chek_gc = detect_grup();
	$nama_gc = $chat_id;
	if ($chek_gc == true) {
		if ($nama_gc == -1001209274058 || $nama_gc == -1001410961692 || $nama_gc == -458987087 || $nama_gc == -1001433395819 || $nama_gc == -1001310420564) {
		} else {
			$reply = 'Maaf, saya diprogram oleh pemilik saya untuk tidak dimasukkan ke grup secara sembarangan oleh orang' . PHP_EOL . PHP_EOL .
				'Jika anda masih tetap ingin memasukkan saya ke grup. silahkan copy angka ini <pre>' . $chat_id . '</pre> lalu pm atau kirimkan ke pembuat bot ini, yaitu ' . PUMBUAT_BOT . PHP_EOL . PHP_EOL .
				'kenapa saya membuat grup proteksi untuk bot ini? dikarnakan untuk menghemat jumlah hit dan bandwith server';
			$content1 = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content1);
			$content = array('chat_id' => $chat_id);
			$telegram->leaveChat($content);
		}
	} else {
	}
}
$deteksiApakahGrupwaktu = detect_grup();
if ($deteksiApakahGrupwaktu != true) {

	$chek = tracking_user_forwaktu($userID);
	if ($chek == true) {
		if (
			'/help' == $adanParse[0] || '/help' . USERNAME_BOT . '' == $adanParse[0] ||
			'/help_i' == $adanParse[0] || '/help_i' . USERNAME_BOT . '' == $adanParse[0] ||
			'/sudo' == $adanParse[0] || '/sudo' . USERNAME_BOT . '' == $adanParse[0] ||
			'/bucin' == $adanParse[0] || '/bucin' . USERNAME_BOT . '' == $adanParse[0] ||
			'/bucin_i' == $adanParse[0] || '/bucin_i' . USERNAME_BOT . '' == $adanParse[0] ||
			'/berita' == $adanParse[0] || '/berita' . USERNAME_BOT . '' == $adanParse[0] ||
			'/berita_i' == $adanParse[0] || '/berita_i' . USERNAME_BOT . '' == $adanParse[0] ||
			'/chapcha_i' == $adanParse[0] || '/chapcha_i' . USERNAME_BOT . '' == $adanParse[0] ||
			'/brainly' == $adanParse[0] || '/brainly' . USERNAME_BOT . '' == $adanParse[0] ||
			'/brainly_i' == $adanParse[0] || '/brainly_i' . USERNAME_BOT . '' == $adanParse[0] ||
			'/callback_q' == $adanParse[0] || '/callback_q' . USERNAME_BOT . '' == $adanParse[0]
		) {
		} else {
			$file = __DIR__ . "/json_data/user_delay_time.json";
			$anggota = file_get_contents($file);
			$delayedTime = 2;
			$data = json_decode($anggota, true);

			foreach ($data as $d) {
				if ($d['userid'] == $useridTime) {
					$useridTime = $d['userid'];
					$timesekarang = $d['time'] + $delayedTime;
					$timedelay = $timesekarang - time();
					if ($timedelay > 0) {
						$reply = 'Maaf, kamu dapat mengirim pesan kembali setelah ' . ($timesekarang - time()) . ' detik';
						$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
						$telegram->sendMessage($content);
						exit;
					} elseif ($timedelay < 0) {
						foreach ($data as $key => $d) {
							if ($d['userid'] === $useridTime) {
								$data[$key]['time'] = time() + $delayedTime;
							}
						}
						$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
						$anggota = file_put_contents($file, $jsonfile);
					}
				}
			}
		}
	} elseif ($chek == null) {
		$file = __DIR__ . "/json_data/user_delay_time.json";
		$anggota = file_get_contents($file);
		$data = json_decode($anggota, true);

		$data[] = array(
			"userid" => $userID,
			"time" => time() + $delayedTime
		);

		$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
		$anggota = file_put_contents($file, $jsonfile);
	}
}

// if ($deteksiApakahGrup == true) {
// } elseif ($deteksiApakahGrup == null) {
// 	$dumppesan = 'dari : ' . $username . PHP_EOL .
// 		'userid : <pre>' . $userID . '</pre>' .  PHP_EOL .
// 		'konten : ' . $text_plain_nokarakter;
// 	$content = array('chat_id' => '-458987087', 'parse_mode' => 'html', 'text' => $dumppesan, 'disable_web_page_preview' => true);
// 	$telegram->sendMessage($content);
// }



// if (detect_apakah_pesan_reply_ke_bot() == true) {
// 	$status = array('chat_id' => $chat_id, 'action' => 'typing');
// 	$telegram->sendChatAction($status);
// }
// if ('/wc' == $adanParse[0] || 'wc' == $adanParse[0] || '/wc' . USERNAME_BOT . '' == $adanParse[0]) {
require __DIR__ . '/include/welcome_system.php';
require __DIR__ . '/include/leaveuser_system.php';
// }

// $result = $telegram->getData();
// $getreplyianid = $result['message']['reply_to_message']['from']['id'];


// $reply = $getreplyianid;
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
if ('/start' == $adanParse[0] || '/start' . USERNAME_BOT . '' == $adanParse[0]) {

	if (detect_grup() == true) {
	} else {
		//track user
		$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
		$db->where("userid", $userID);
		$user = $db->getOne("members");
		if ($user['userid'] == null) {
			//insert
			$data = array(
				"userid" => $userID,
				"username" =>  $usernameBelumdiparse,
				"first_name" => $namaPertama,
				"lastname" => $namaTerakhir
			);
			$id = $db->insert('members', $data);
		} else {
		}


		if (isset($adanParse[1])) {
			$explodeparse_pastebin = explode('_', $adanParse[1]);
			if ($adanParse[1] == 'help_admin') {
				require __DIR__ . '/admin_help/help_admin.php';
				exit;
			} elseif ($adanParse[1] == 'help') {
				require __DIR__ . '/command/help.php';
				exit;
			} elseif ($explodeparse_pastebin[0] == 'ps') {
				require __DIR__ . '/include/paste_resolve.php';
				exit;
			}
		}
		require __DIR__ . '/command/start.php';
	}
	exit;
} elseif ('/pantun' == $adanParse[0] || '/pantun' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/pantun.php';
	exit;
} elseif ('/carbon' == $adanParse[0] || '/carbon' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/carbon.php';
	exit;
} elseif ('/resi' == $adanParse[0] || '/resi' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/resi.php';
	exit;
} elseif ('/calc_i' == $adanParse[0] || '/calc_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/apps/calculator/calc_i.php';
	exit;
} elseif ('/callback_q_admin_help' == $adanParse[0] || '/callback_q_admin_help' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/admin_help/callback_q_admin_help.php';
	exit;
} elseif ('/help_admin' == $adanParse[0] || '/help_admin' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/admin_help/help_admin.php';
	exit;
} elseif ('/help_admin_i' == $adanParse[0] || '/help_admin_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/admin_help/help_admin_i.php';
	exit;
} elseif ('/adminlist' == $adanParse[0] || '/adminlist' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/adminlist.php';
	exit;
} elseif ('/xlsx_to_json' == $adanParse[0] || '/xlsx_to_json' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/xlsx_to_json.php';
	exit;
} elseif ('/upload' == $adanParse[0] || '/upload' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/upload.php';
	exit;
} elseif ('/pastebin' == $adanParse[0] || '/bin' == $adanParse[0] || '/pastebin' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/pastebin.php';
	exit;
} elseif ('/chapcha' == $adanParse[0] || '/chapcha' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/chapcha.php';
	exit;
} elseif ('/wallpaper' == $adanParse[0] || '/wallpaper' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/wallpaper.php';
	exit;
} elseif ('/qr_code' == $adanParse[0] || '/qr_code' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/qr_code.php';
	exit;
} elseif ('/read_qr' == $adanParse[0] || '/read_qr' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/read_qr.php';
	exit;
} elseif (
	'/br' == $adanParse[0] || '/br' . USERNAME_BOT . '' == $adanParse[0]
) {
	require __DIR__ . '/command/brainly.php';
	exit;
} elseif ('/brainly_i' == $adanParse[0] || '/brainly_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/brainly_i.php';
	exit;
} elseif ('/photooxy' == $adanParse[0] || '/photooxy' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/photooxy_command/photooxy.php';
	exit;
} elseif ('/debug' == $adanParse[0] || '/debug' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/debug.php';
	exit;
} elseif ('/kalimat_quotes' == $adanParse[0] || '/kalimat_quotes' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/kalimat_quotes.php';
	exit;
} elseif ('/whois' == $adanParse[0] || '/whois' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/whois.php';
	exit;
} elseif ('/q' == $adanParse[0] || '/q' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/q.php';
	exit;
} elseif ('/cuaca' == $adanParse[0] || '/cuaca' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/cuaca.php';
	exit;
} elseif ($text == '/debug' || $text == '/debug' . USERNAME_BOT . '') {
	require __DIR__ . '/command/debug.php';
	exit;
} elseif ('/chapcha_i' == $adanParse[0] || '/chapcha_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/chapcha_i.php';
	exit;
} elseif ('/trs' == $adanParse[0] || '/trs' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/trs.php';
	exit;
} elseif (
	'/quran' == $adanParse[0] || '/quran' . USERNAME_BOT . '' == $adanParse[0] ||
	'/qs' == $adanParse[0] || '/qs' . USERNAME_BOT . '' == $adanParse[0]
) {
	require __DIR__ . '/command/quran.php';
	exit;
} elseif ('/php_doc' == $adanParse[0] || '/php_doc' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/php_doc.php';
	exit;
} elseif (
	'/run' == $adanParse[0] || '/run' . USERNAME_BOT . '' == $adanParse[0]
) {
	// jalankan kode memakai rextester

	require __DIR__ . '/command/run.php';
	exit;
} elseif ('/db_add' == $adanParse[0] || '/db_add' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/db_add.php';
	exit;
} elseif ($calkulatorpreg > 0) {
	eval("\$hsl = $hasilpreg[1];");
	$jawabcal = array("hasil adalah " . $hsl, "hasilnya kan " . $hsl . " ngab", "eh hasil nya " . $hsl);
	$reply =  $jawabcal[random_int(0, 2)];
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$url = $telegram->sendMessage($content);
	exit;
} elseif ('/help_i' == $adanParse[0] || '/help_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/help_i.php';
	exit;
} elseif ('/help' == $adanParse[0] || '/help' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/help.php';
	exit;
} elseif ('/callback_q' == $adanParse[0] || '/callback_q' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/callback_q.php';
	exit;
} elseif ('/capture' == $adanParse[0] || '/capture' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/capture.php';
	exit;
} elseif ('/faker' == $adanParse[0] || '/faker' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/faker.php';
	exit;
} elseif ('/berita' == $adanParse[0] || '/berita' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/berita.php';
	exit;
} elseif ('/berita_i' == $adanParse[0] || '/berita_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/berita_i.php';
	exit;
} elseif ('/wiki' == $adanParse[0] || '/wiki' . USERNAME_BOT . '' == $adanParse[0] || '/w' == $adanParse[0] || '/w' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/wiki.php';
	exit;
} elseif ('/kata_bijak' == $adanParse[0] || '/kata_bijak' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/kata_bijak.php';
	exit;
} elseif ('/bucin' == $adanParse[0] || '/bucin' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/bucin.php';
	exit;
} elseif ('/bucin_i' == $adanParse[0] || '/bucin_i' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/bucin_i.php';
	exit;
} elseif ('/sudo' == $adanParse[0] || '/sudo' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/sudo.php';
	exit;
} elseif ('/fakta_unik' == $adanParse[0] || '/fakta_unik' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/fakta.php';
	exit;
} elseif ('/rules' == $adanParse[0] || '/rules' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/rules.php';
	exit;
} elseif ('/ch_serv' == $adanParse[0] || '/ch_serv' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/ch_serv.php';
	exit;
} elseif ('/ip_geo' == $adanParse[0] || '/ip_geo' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/ip_geo.php';
	exit;
} elseif ('/tulis' == $adanParse[0] || '/tulis' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/tulis.php';
	exit;
} elseif (
	'/get_github_user' == $adanParse[0] || '/get_github_user' . USERNAME_BOT . '' == $adanParse[0] ||
	'/gh' == $adanParse[0] || '/gh' . USERNAME_BOT . '' == $adanParse[0]
) {
	require __DIR__ . '/command/get_github_user.php';
	exit;
} elseif ($text == '/berhenti' || $text == '/berhenti' . USERNAME_BOT . '') {
	require __DIR__ . '/command/berhenti.php';
	exit;
} elseif ('/spam' == $adanParse[0] || '/spam' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/spam.php';
	exit;
} elseif ('/get_ip' == $adanParse[0] || '/get_ip' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_ip.php';
	exit;
} elseif ('/get_mx' == $adanParse[0] || '/get_mx' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_mx.php';
	exit;
} elseif ('/get_ns' == $adanParse[0] || '/get_ns' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_ns.php';
	exit;
} elseif ('/get_a' == $adanParse[0] || '/get_a' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_a.php';
	exit;
} elseif ('/get_aaaa' == $adanParse[0] || '/get_aaaa' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_aaaa.php';
	exit;
} elseif ('/get_txt' == $adanParse[0] || '/get_txt' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_txt.php';
	exit;
} elseif ('/get_cname' == $adanParse[0] || '/get_cname' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/get_cname.php';
	exit;
} elseif ('/http' == $adanParse[0] || '/http' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/http.php';
	exit;
} elseif ('/header' == $adanParse[0] || '/header' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/header.php';
	exit;
} elseif ('/media' == $adanParse[0] || '/media' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/media.php';
	exit;
} elseif ('/method' == $adanParse[0] || '/method' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/method.php';
	exit;
} elseif ($text == '/donate' || $text == '/donate' . USERNAME_BOT . '') {
	require __DIR__ . '/command/donate.php';
	exit;
} elseif ('/short' == $adanParse[0] || '/short' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/short.php';
	exit;
} elseif ('/azan' == $adanParse[0] || '/azan' . USERNAME_BOT . '' == $adanParse[0]) {
	require __DIR__ . '/command/azan.php';
	exit;
} elseif ($text == '/gempa' || $text == '/gempa' . USERNAME_BOT . '') {
	require __DIR__ . '/command/gempa.php';
	exit;
} elseif ($text == '/whoami' || $text == '/whoami' . USERNAME_BOT . '') {
	require __DIR__ . '/command/whoami.php';
	exit;
} elseif (
	$text == '/panggil' ||
	$text == '/panggil' . USERNAME_BOT . ''
) {
	require __DIR__ . '/command/panggil.php';
	exit;
} elseif (
	$text == 'ini jam berapa?' || $text === '/waktu' || $text === 'ini jam berapa ya?' || $text === 'jam sekarang!' ||
	$text == 'lihat jam' || $text == 'waktu' || $text == '/waktu' . USERNAME_BOT . '' || $text == 'sekarang jam berapa?' ||
	$text == 'sekarang jam berapa' || $text == 'jam berapa ini' || $text == 'jam berapa ini?' || $text == 'jam berapa' || $text == 'jam berapa?'
) {
	require __DIR__ . '/command/waktu.php';
	exit;
} elseif (
	$text == '/info' ||
	$text == '/info' . USERNAME_BOT . '' ||
	$text == 'info bot fadhil riyanto'
) {
	require __DIR__ . '/command/info.php';
	exit;
} elseif ($text == '/tanggal' || $text == '/tanggal' . USERNAME_BOT . '') {
	require __DIR__ . '/command/tanggal.php';
	exit;
} elseif ($text == '/bug' || $text == '/bug' . USERNAME_BOT . '') {
	require __DIR__ . '/command/bug.php';
	exit;
} elseif ($text == null) {
	exit;
} elseif (
	$text === '/corona' || $text === '/cv19' || $text === 'info corona' || $text === 'info corona terkini' || $text === 'info corona sekarang' ||
	$text === 'info covid sekarang' || $text === 'info covid19 sekarang' || $text === 'info covid 19 sekarang' || $text === 'info covid19 terkini' ||
	$text === 'info covid 19 terkini' || $text === 'info covid 19 diindonesia' || $text === 'info covid19 diindonesia' || $text === 'info covid 19 di indonesia' ||
	$text === 'info covid19 di indonesia' || $text === 'update corona gimana?' || $text === 'update corona gimana' ||
	$text === 'corona gimana infonya?' || $text === 'corona gimana infonya' || $text === 'update corona gimana' ||
	$text === 'update covid gimana?' || $text === 'update covid19 gimana' || $text === 'update covid 19 gimana' || $text === 'info corona gimana?' || $text === 'info corona gimana' || $text === 'info corona bagaimana?' || $text === 'info corona bagaimana' || $text === 'info covid bagaimana?' || $text === 'info covid bagaimana' || $text === 'info covid 19 bagaimana?' || $text === 'info covid 19 bagaimana' || $text === 'info covid19 bagaimana?' || $text === 'info covid19 bagaimana' || $text === 'info covid19 gimana?' || $text === 'info covid 19 gimana?' ||
	$text === 'update corona bagaimana?' || $text === 'corona gimana?' || $text === 'status corona' || $text === 'info covid' || $text === 'info covid 19' || $text === 'info covid19' ||
	//slang teks disini
	$text === 'corona bgmn?' || $text === 'corona bgmn' || $text === 'status corona' || $text === 'statiska corona' || $text === 'info covid' ||
	$text === 'info covid 19' || $text === 'info covid19' || $text == '/corona' . USERNAME_BOT . ''
) {
	require __DIR__ . '/command/corona.php';
	exit;
} elseif ('/corona_provinsi' == $adanParse[0] || '/corona_provinsi' . USERNAME_BOT . '' == $adanParse[0]) {
	// exit;
	require __DIR__ . '/command/corona_provinsi.php';
	exit;
} elseif (
	'/base64_encode' == $adanParse[0] || '/base64_encode' . USERNAME_BOT . '' == $adanParse[0] ||
	'/b64_enc' == $adanParse[0] || '/b64_enc' . USERNAME_BOT . '' == $adanParse[0]
) {
	require __DIR__ . '/command/base64_encode.php';
	exit;
} elseif (
	'/base64_decode' == $adanParse[0] || '/base64_decode' . USERNAME_BOT . '' == $adanParse[0] ||
	'/b64_dec' == $adanParse[0] || '/b64_dec' . USERNAME_BOT . '' == $adanParse[0]
) {
	require __DIR__ . '/command/base64_decode.php';
	exit;
} elseif ($stringPertama == '/') {

	require __DIR__ . '/photooxy_command/__init__.php';

	require __DIR__ . '/include/claimmed.php';
	require __DIR__ . '/group_command/__init__.php';

	require __DIR__ . '/anime_command/__init__.php';

	require __DIR__ . '/hash_command/__init__.php';

	require __DIR__ . '/admin_command/__init__.php';





	// Jika ditemukan data dengan awalan coommand telegram, maka dia ngga akan diinsert ke database
	// kita menggunakan exit agar dia keluar dari konsol
	exit;
}
// ENCRYPT TOOLS DIAKHIRI
// LICENSE BY FADHIL
// PAHAM?



$detectReply = detect_apakah_pesan_reply_ke_bot();
if ($detectReply == true) {
	$koneksi = @mysqli_connect(
		DB_HOST,
		DB_USERNAME,
		DB_PASSWORD,
		DB_NAME
	);

	$ai_chatting = robot_artificial_intelegence($text);
	$ai_chatting_decode = json_decode($ai_chatting);
	if ($ai_chatting_decode->bad_word == true) {
		$reply = 'Aku ogah jawab ah, ada kata kata yg tidak sopan soalnya';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
		mysqli_close($koneksi);
		exit;
	}

	if ($koneksi == 1) {
		if ($ai_chatting_decode->affected > 0) {
			$reply = Emoji::Decode($ai_chatting_decode->respon) . PHP_EOL;
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
			mysqli_close($koneksi);
			exit;
			//}
		} elseif ($ai_chatting_decode->affected === 'simsimi') {

			$reply = Emoji::Decode($ai_chatting_decode->respon) . PHP_EOL;
			//mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$teksTerfilter', 'hmhm')");
			$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
			$telegram->sendMessage($content);
		}
	} elseif ($koneksi == 0) {
		$reply = 'Maaf, saat ini kamu tidak bisa membalas pesan kamu dikarnakan database sedang error. Jadi kami hanya bisa menerima command saja untuk sementara waktu ini. Kamu bisa melaporkan ke ' . PUMBUAT_BOT . ' selaku pembuatnya';
		$option = array(
			//First row
			// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
			// //Second row 
			// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
			// //Third row

			array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = 'https://t.me/tgdev_php_group'))
		);
		$keyb = $telegram->buildInlineKeyBoard($option);


		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	mysqli_close($koneksi);
} else {
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

// $vars = array_keys(get_defined_vars());
// for ($i = 0; $i < sizeOf($vars); $i++) {
// 	unset($$vars[$i]);
// }
// unset($vars, $i);