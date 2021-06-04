<?php
//$hapusTulis = 
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$curlImage = file_get_contents('https://salism3api.pythonanywhere.com/write/?text=' . urlencode($udahDiparse));
$parsecJsons = json_decode($curlImage);
if ($adanParse[1] == null) {
	$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Pattern kosong, gunakan format' . PHP_EOL . PHP_EOL . '<pre>/tulis {your text}</pre>';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
} elseif ($parsecJsons->success == true) {
	$konten = array('chat_id' => $chat_id, 'photo' => $parsecJsons->images[0], 'caption' => 'Hai ' . $username . ', Gambar berhasil dibuat!', 'reply_to_message_id' => $message_id,);
	$telegram->sendPhoto($konten);

	exit;
} else {
	$reply = 'Hai ' . $username . PHP_EOL . 'Maaf, sepertinya ada yang error di sistem kami';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
	exit;
}
