<?php
echo 'working';
include(__DIR__ . '/vendor/autoload.php');
$telegram = new Telegram('1489990155:AAGb7YFsVA-G2Vs28R6fQQZ8uxMm3ouCFDg');
$koneksi = @mysqli_connect('freedb.tech', 'freedbtech_ai_bot_fadhil_riyanto', 'R^&V*&(H7679U7TV6I987vt**(&^u^&*y^ct%yurtytTY&T%TY&YBTRHY&U7ytR', 'freedbtech_ai_bot_fadhil_riyanto');
date_default_timezone_set('Asia/Jakarta');
$text = strtolower(mysqli_real_escape_string($koneksi, $telegram->Text()));
$chat_id = $telegram->ChatID();

//$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '%".$text."' ");
$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` LIKE _utf8 '$text' ");
$tes_jumlah_row = @mysqli_affected_rows($koneksi);

if ($text == '/start') {
	$reply = 'Hai, ada apa .... hihi';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif ($text === 'ini jam berapa?' || $text === '/waktu' || $text === 'ini jam berapa ya?' || $text === 'jam sekarang!' || $text === 'lihat jam' || $text === 'waktu' || $text === 'sekarang jam berapa?' || $text === 'sekarang jam berapa') {
	$reply = 'Sekarang jam ' . date('h:i:s a') . ', dihape kamu apa tidak cocok jamnya?' . PHP_EOL;
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
} elseif ($text === '/wiki' || $text === 'cari informasi' || $text === 'buka wikipedia' || $text === 'cari informasi' || $text === 'carikan' || $text === 'cari') {
	$reply = 'ingin cari apa?';
	$content = array('chat_id' => $chat_id, 'text' => $reply);
	$telegram->sendMessage($content);
	exit;
	$wiki_matang = $text;
	if ($text != null) {
		$hapus_wiki = str_replace('/wiki', '', $text);
		$no_underskor = str_replace(' ', '_', $hapus_wiki);
		//get data
		$wiki_get_datanya = file_get_contents('https://id.wikipedia.org/w/api.php?action=query&prop=extracts&format=xml&exintro=&titles=' . $no_underskor);
		$wiki_get_datanya_ubahKeXML = simplexml_load_string($wiki_get_datanya);
		$wiki_matang = $wiki_get_datanya_ubahKeXML->query->pages->page->extract;
		$wiki_escape = strip_tags($wiki_matang);
		if ($wiki_escape != NULL) {
			$reply = $wiki_hitung;
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		} else {
			$reply = 'Maaf nih, Data tidak ditemukan';
			$content = array('chat_id' => $chat_id, 'text' => $reply);
			$telegram->sendMessage($content);
		}
	}
} elseif ($tes_jumlah_row > 0) {
	foreach ($q as $respon) {

		$reply = $respon['data_res_ai'] . PHP_EOL;
		$content = array('chat_id' => $chat_id, 'text' => $reply);
		$telegram->sendMessage($content);
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
