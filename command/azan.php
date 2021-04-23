<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand != null) {
	$azanDapatkankota = file_get_contents('https://api.banghasan.com/sholat/format/json/kota/nama/' . urlencode(str_replace('city', 'kota', $udahDiparse)));
	$h = json_decode($azanDapatkankota);
	if ($h->kota != null) {
		foreach ($h->kota as $azanKode) {
			if (strtoupper($azanKode->nama) == strtoupper($udahDiparse)) {
				//echo $azanKode->id;
				$azangetJadwal = file_get_contents('https://api.banghasan.com/sholat/format/json/jadwal/kota/' . $azanKode->id . '/tanggal/' . date('Y-m-d'));
				$jsonHasilazancurl = json_decode($azangetJadwal);
				$reply = bahasa('modul_azan_sukses');
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
	$reply = bahasa('modul_azan_pattern_kosong');
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
}
