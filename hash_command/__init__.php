<?php
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
function cek_apakah_hash_tersedia($cek)
{
	$cek = substr($cek, 1);
	$algos = hash_algos();
	foreach ($algos as $al) {
		if ($al == $cek) {
			return true;
		}
	}
	return false;
}
$cekisada = cek_apakah_hash_tersedia(strtolower($adanParse_plain[0]));

if ($cekisada == true) {
	$hashname = substr(strtolower($adanParse_plain[0]), 1);

	$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
	$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
	$udahDiparse_hash = str_replace($adanParse_plain[0] . ' ', '', $text_plain_nokarakter);
	if ($azanHilangcommand == null) {
		$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt ' . $hashname . ', gunakan command <pre>/' . $hashname . ' {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
			'Contoh : <pre>/' . $hashname . ' indonesia</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma ' . $hashname . ' adalah' . PHP_EOL . PHP_EOL .
			'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash($hashname, $udahDiparse_hash) . '</pre>';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	}
	exit;
} elseif ($cekisada == false) {
}

// if ($azanHilangcommand == null) {
// 	$reply = 'Hai ' . $username . PHP_EOL . 'Untuk menggunakan encrypt MD2, gunakan command <pre>/md2 {teks atau kata}</pre>' . PHP_EOL . PHP_EOL .
// 		'Contoh : <pre>/md2 indonesia</pre>';
// 	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 	$telegram->sendMessage($content);
// } else {
// 	$reply = 'Hai ' . $username . ', Hasil convert text to hash dengan algoritma MD2 adalah' . PHP_EOL . PHP_EOL .
// 		'Teks : ' . $udahDiparse . PHP_EOL . '---------------' .  PHP_EOL .  'Hash : <pre>' .  hash('md2', $udahDiparse_hash) . '</pre>';
// 	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
// 	$telegram->sendMessage($content);
// }
