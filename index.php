<?php
echo 'working';
include(__DIR__ . '/vendor/autoload.php');
$telegram = new Telegram('1489990155:AAGb7YFsVA-G2Vs28R6fQQZ8uxMm3ouCFDg');
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');
date_default_timezone_set('Asia/Jakarta');
$text = strtolower(mysqli_real_escape_string($koneksi, $telegram->Text()));
$chat_id = $telegram->ChatID();
$userID = $telegram->UserID();

$adanParse = explode(' ', $text);

//$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '%".$text."' ");
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '$text' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);

if ($text == '/start' ||
	$text == '/start@fadhil_riyanto_bot') {
	$reply = 'Hai, Apa kabar?';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif('/azan' == $adanParse[0] || '/azan@fadhil_riyanto_bot' == $adanParse[0]){
	$adanKota = $adanParse[1];
	$tanggal = date("Y-m-d");
	$adanCurl = file_get_contents('https://api.pray.zone/v2/times/day.json?city='.$adanKota.'&date='.$tanggal);
	$json_adan = json_decode($adanCurl, true);
	
	if($adanParse[1] == null){
		$reply = 'maaf, anda salah. gunakan syntax'. PHP_EOL .
					'/azan {kota}'. PHP_EOL .PHP_EOL .
					'Contoh /azan jakarta';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}elseif($json_adan != null){
		$reply = 'Jadwal azan di'.$adanParse[1]. PHP_EOL .PHP_EOL .
				'Imsak '.$json_adan['results']['datetime'][0]['times']['Imsak']. PHP_EOL .
				'Terbit '.$json_adan['results']['datetime'][0]['times']['Sunrise']. PHP_EOL .
				'Fajar '.$json_adan['results']['datetime'][0]['times']['Fajr']. PHP_EOL .
				'Dzuhur '.$json_adan['results']['datetime'][0]['times']['Dhuhr']. PHP_EOL .
				'Ashar '.$json_adan['results']['datetime'][0]['times']['Asr']. PHP_EOL .
				'Terbenam '.$json_adan['results']['datetime'][0]['times']['Sunset']. PHP_EOL .
				'Maghrib '.$json_adan['results']['datetime'][0]['times']['Maghrib']. PHP_EOL .
				'Isya '.$json_adan['results']['datetime'][0]['times']['Isha']. PHP_EOL .
				'Tengah malam '.$json_adan['results']['datetime'][0]['times']['Midnight']. PHP_EOL . PHP_EOL .
				'Sumber : api.pray.zone';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}else{
		$reply = 'maaf, tidak tersedia';
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	
		
}elseif($text == '/berhenti' ||
		$text == '/berhenti@fadhil_riyanto_bot'){
		$reply = 'bot ter-stop!!';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
} elseif($text == '/userid' ||
		$text == '/userid@fadhil_riyanto_bot'){
	$reply = 'Hai, id kamu adalah' . PHP_EOL . 'ID :' .$userID . PHP_EOL . 'Terimakasih';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} 
elseif($text == '/mention'||
		$text == '/mention@fadhil_riyanto_bot'){
	$reply = 'Hai...kenapa memanggil saya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}elseif ($text == 'ini jam berapa?' || 
		$text === '/waktu' ||
		$text === 'ini jam berapa ya?' ||
		$text === 'jam sekarang!' || 
		$text == 'lihat jam' || 
		$text == 'waktu' || 
		$text == '/waktu@fadhil_riyanto_bot' ||
		$text == 'sekarang jam berapa?' || 
		$text == 'sekarang jam berapa' ||
		$text == 'jam berapa ini' ||
		$text == 'jam berapa ini?'||
		$text == 'jam berapa' ||
		$text == 'jam berapa?') {
	$reply = 'Sekarang jam ' . date('h:i:s a') . ', dihape kamu apa tidak cocok jamnya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif ($text == '/info' || 
		  $text == '/info@fadhil_riyanto_bot'||
		  $text == 'info bot fadhil riyanto') {
	$reply = 'Hi....' . PHP_EOL . PHP_EOL . 'Saya bot Fadhil Riyanto. Hobi saya bermain komputer dan membuat program'. PHP_EOL . PHP_EOL . 'Teknologi yang saya gunakan ialah. '. PHP_EOL . 'Server: nginx' . PHP_EOL . 'Database: Mysql'. PHP_EOL . 'Forward: ngrok' .PHP_EOL . 'PHP: 8.0 ts' .PHP_EOL . 'Versi: 8.3.3' .PHP_EOL . PHP_EOL . ' Dibuat dengan Cinta oleh @fadhil_riyanto'. PHP_EOL .PHP_EOL .  'Semoga bot ini mebantu';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif ($text == '/help' || $text == '/help@fadhil_riyanto_bot'){
	$reply = 'Hi....' . PHP_EOL . PHP_EOL . 
	'Saya punya beberapa command untuk membantu kamu. Diantaranya adalah'. PHP_EOL . PHP_EOL . 
	'/corona - status corona'. PHP_EOL . 
	'/userid - melihat id user' . PHP_EOL . 
	'/waktu - cek waktu terkini'. PHP_EOL . 
	'/info - info bot ini' .PHP_EOL . 
	'/mention - untuk memanggil saya' .PHP_EOL . 
	'/start - memulai bot' .PHP_EOL . 
	'/berhenti - hentikan bot paksa' .PHP_EOL .
	'/tanggal - lihat tanggal' .PHP_EOL .
	'/bug - laporkan bug' .PHP_EOL .
	'/azan - Jadwal azan' .PHP_EOL .
	'/help - melihat semua command'. PHP_EOL .PHP_EOL .  
	'Semoga bot ini membantu';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif($text == '/tanggal' || $text == '/tanggal@fadhil_riyanto_bot'){
	$reply = 'sekarang '.date('l, d F Y');
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}elseif($text == '/bug' || $text == '/bug@fadhil_riyanto_bot'){
	$reply = 'Silahkan PM @fadhil_riyanto'. PHP_EOL . PHP_EOL . 'Jangan lupa sertakan Screenshot dan letak bug nya. yaaaa' . PHP_EOL . PHP_EOL . 'Dengan kamu melaporkan bug, kamu telah membantu saya untuk membuat bot lebih baik lagi';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}elseif($text == null){
	
}
elseif ($text === '/corona' ||
		  $text == '/corona@fadhil_riyanto_bot') {
  $file_korona = @file_get_contents('https://api.kawalcorona.com/indonesia/');
  $file_korona_jsonParse = json_decode($file_korona, true);
  if ($file_korona_jsonParse != NULL) {
    foreach ($file_korona_jsonParse as $corona_jadi) {
      $reply =  'Sepertinya jumlah kasus Corona adalah' .PHP_EOL . PHP_EOL . 'positif   ' . $corona_jadi['positif'] . PHP_EOL . 'sembuh    ' . $corona_jadi['sembuh'] . PHP_EOL . 'meninggal ' . $corona_jadi['meninggal'] . PHP_EOL . 'dirawat   ' . $corona_jadi['dirawat'] . PHP_EOL . PHP_EOL . 'Jangan lupa pakai masker dan jaga kesehatan';
	  $content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
    }
  } else {
    $reply = 'server mati sepertinya, coba lagi nanti' . PHP_EOL;
    $content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
  }
} elseif ($tes_jumlah_row > 0) {
	foreach ($q as $respon) {

		$reply = $respon['data_res_ai'] . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
		exit;
	}
} elseif ($tes_jumlah_row === 0) {

	$reply = '... Percakapan ini saya simpan untuk pembendaharaan kata kata agar bot lebih pintar lagi '.PHP_EOL.'Balas oke';
	mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$text', 'null')");
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}
