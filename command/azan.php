<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand != null) {
	$azanDapatkankota = file_get_contents('https://api.banghasan.com/sholat/format/json/kota/nama/' . urlencode($udahDiparse));
	$h = json_decode($azanDapatkankota);
	if ($h->kota != null) {
		foreach ($h->kota as $azanKode) {
			if (strtoupper($azanKode->nama) == strtoupper($udahDiparse)) {
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
			} elseif (strtoupper($azanKode->nama) != strtoupper($udahDiparse)) {
				foreach ($h->kota as $kotaref) {
					$daftarditemukan = $kotaref->nama;
					$daftarditemukanid = $kotaref->id;
					$kotareffff[] = "- " . $daftarditemukan . ' (' . $daftarditemukanid . ')';
				}
				$reply = 'Ups, kota yang kamu cari tidak ditemukan...' . PHP_EOL .
					'Coba referensi di bawah ini' . PHP_EOL  . PHP_EOL . implode(PHP_EOL, $kotareffff);
				$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
				$telegram->sendMessage($content);
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
	$reply = 'Maaf, gunakan pattern <pre>/azan nama kota</pre>' . PHP_EOL . PHP_EOL . 'contoh : /azan jakarta';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
}
