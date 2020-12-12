<?php
echo 'working';
include(__DIR__ . '/vendor/autoload.php');
$telegram = new Telegram('1489990155:AAGb7YFsVA-G2Vs28R6fQQZ8uxMm3ouCFDg');
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');
date_default_timezone_set('Asia/Jakarta');
$text = strtolower(mysqli_real_escape_string($koneksi, $telegram->Text()));
$chat_id = $telegram->ChatID();

//$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '%".$text."' ");
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$text' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);

if ($text == '/start' ||
	$text == '/start@fadhil_riyanto_bot') {
	$reply = 'Hai, ada apa .... hihi';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif($text == '/berhenti' ||
		$text == '/berhenti@fadhil_riyanto_bot'){
	exit;
} elseif($text == '/mention'||
		$text == '/mention@fadhil_riyanto_bot'){
	$reply = 'Hai...kenapa memanggil saya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
}
elseif ($text == 'ini jam berapa?' || 
		$text === '/waktu' ||
		$text === 'ini jam berapa ya?' ||
		$text === 'jam sekarang!' || 
		$text === 'lihat jam' || 
		$text === 'waktu' || 
		$text == '/waktu@fadhil_riyanto_bot' ||
		$text === 'sekarang jam berapa?' || 
		$text === 'sekarang jam berapa') {
	$reply = 'Sekarang jam ' . date('h:i:s a') . ', dihape kamu apa tidak cocok jamnya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif ($text == '/info' || 
		  $text == '/info@fadhil_riyanto_bot'||
		  $text == 'info bot fadhil riyanto') {
	$reply = 'Hi....' . PHP_EOL . PHP_EOL . 'Saya bot Fadhil Riyanto. Hobi saya bermain komputer dan membuat program'. PHP_EOL . PHP_EOL . 'Teknologi yang saya gunakan ialah. '. PHP_EOL . 'Server: nginx' . PHP_EOL . 'Database: Mysql'. PHP_EOL . 'Forward: ngrok' .PHP_EOL . 'PHP: 8.0 ts' .PHP_EOL . 'Versi: 8.3.3' .PHP_EOL . PHP_EOL . ' Dibuat dengan Cinta oleh @fadhil_riyanto'. PHP_EOL .PHP_EOL .  'Semoga bot ini mebantu';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif ($text === '/corona' ||
		  $text == '/corona@fadhil_riyanto_bot') {
  $file_korona = @file_get_contents('https://api.kawalcorona.com/indonesia/');
  $file_korona_jsonParse = json_decode($file_korona, true);
  if ($file_korona_jsonParse != NULL) {
    foreach ($file_korona_jsonParse as $corona_jadi) {
      $reply =  'positif   ' . $corona_jadi['positif'] . PHP_EOL . 'sembuh    ' . $corona_jadi['sembuh'] . PHP_EOL . 'meninggal ' . $corona_jadi['meninggal'] . PHP_EOL . 'dirawat   ' . $corona_jadi['dirawat'] . PHP_EOL;
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
	//$reply_1 = 'Ga jelas skip?!!!';
	//$konten = array('chat_id' => $chat_id, 'text' => $reply_1);
	//$telegram->sendMessage($konten);
}
