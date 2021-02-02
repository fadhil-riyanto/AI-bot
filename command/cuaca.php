<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
	$reply = 'Maaf, gunakan pattern ' . PHP_EOL .
		'<pre>/cuaca {namakota}.</pre>' . PHP_EOL . PHP_EOL .
		'contoh /cuaca jakarta';
	$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
	$telegram->sendMessage($content);
} else {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://api.weatherapi.com/v1/current.json?key=" . API_WEATHER_KEY . '&q=' . urlencode($udahDiparse));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output_weat = curl_exec($ch);
	curl_close($ch);

	// var_dump($weat);
	$h_weat = json_decode($output_weat);
	if ($h_weat->error->code == 1006) {
		$reply = 'Ups, kota tidak ditemukan';
		$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
		$telegram->sendMessage($content);
	} else {
		switch ($h_weat->current->condition->code) {
			case '1000':
				$kondisi_cuaca = 'Cerah';
				break;
			case '1003':
				$kondisi_cuaca = 'Berawan';
				break;
			case '1006':
				$kondisi_cuaca = 'Berawan';
				break;
			case '1009':
				$kondisi_cuaca = 'Mendung';
				break;
			case '1030':
				$kondisi_cuaca = 'Kabut';
				break;
			case '1063':
				$kondisi_cuaca = 'Kemungkinan hujan tidak merata';
				break;
			case '1066':
				$kondisi_cuaca = 'Kemungkinan salju tidak merata';
				break;
			case '1069':
				$kondisi_cuaca = 'Hujan es tidak merata mungkin';
				break;
			case '1072':
				$kondisi_cuaca = 'Mungkin gerimis beku tidak merata';
				break;
			case '1087':
				$kondisi_cuaca = 'Petir mungkin terjadi';
				break;
			case '1114':
				$kondisi_cuaca = 'Berhembus salju';
				break;
			case '1117':
				$kondisi_cuaca = 'Badai salju';
				break;
			case '1135':
				$kondisi_cuaca = 'Kabut';
				break;
			case '1147':
				$kondisi_cuaca = 'Kabut beku';
				break;
			case '1150':
				$kondisi_cuaca = 'Gerimis ringan tidak merata';
				break;
			case '1153':
				$kondisi_cuaca = 'Gerimis ringan';
				break;
			case '1168':
				$kondisi_cuaca = 'Gerimis yang membekukan';
				break;
			case '1171':
				$kondisi_cuaca = 'Gerimis beku lebat';
				break;
			case '1180':
				$kondisi_cuaca = 'Hujan ringan tidak merata';
				break;
			case '1183':
				$kondisi_cuaca = 'Gerimis';
				break;
			case '1186':
				$kondisi_cuaca = 'Hujan sedang';
				break;
			case '1189':
				$kondisi_cuaca = 'Hujan sedang';
				break;
			case '1192':
				$kondisi_cuaca = 'Terkadang hujan deras';
				break;
			case '1195':
				$kondisi_cuaca = 'Hujan deras';
				break;
			case '1198':
				$kondisi_cuaca = 'Hujan dingin ringan';
				break;
			case '1201':
				$kondisi_cuaca = 'Hujan beku sedang atau lebat';
				break;
			case '1204':
				$kondisi_cuaca = 'Hujan es ringan';
				break;
			case '1207':
				$kondisi_cuaca = 'Hujan es sedang atau berat';
				break;
			case '1210':
				$kondisi_cuaca = 'Salju ringan tidak merata';
				break;
			case '1213':
				$kondisi_cuaca = 'Salju ringan';
				break;
			case '1216':
				$kondisi_cuaca = 'Salju sedang tidak merata';
				break;
			case '1219':
				$kondisi_cuaca = 'Salju sedang';
				break;
			case '1222':
				$kondisi_cuaca = 'Salju lebat tidak merata';
				break;
			case '1225':
				$kondisi_cuaca = 'Salju lebat';
				break;
			case '1237':
				$kondisi_cuaca = 'Pelet es';
				break;
			case '1240':
				$kondisi_cuaca = 'Pancuran hujan ringan';
				break;
			case '1243':
				$kondisi_cuaca = 'Pancuran hujan sedang atau lebat';
				break;
			case '1246':
				$kondisi_cuaca = 'Hujan deras';
				break;
			case '1249':
				$kondisi_cuaca = 'Hujan es ringan';
				break;
			case '1252':
				$kondisi_cuaca = 'Hujan es sedang atau lebat';
				break;
			case '1255':
				$kondisi_cuaca = 'Hujan salju ringan';
				break;
			case '1258':
				$kondisi_cuaca = 'Hujan salju sedang atau lebat';
				break;
			case '1261':
				$kondisi_cuaca = 'Hujan es butiran es';
				break;
			case '1264':
				$kondisi_cuaca = 'Hujan butiran es sedang atau deras';
				break;
			case '1273':
				$kondisi_cuaca = 'Hujan ringan tidak merata dengan guntur';
				break;
			case '1276':
				$kondisi_cuaca = 'Hujan sedang atau lebat disertai guntur';
				break;
			case '1279':
				$kondisi_cuaca = 'Salju ringan tidak merata dengan guntur';
				break;
			case '1282':
				$kondisi_cuaca = 'Salju sedang atau lebat disertai guntur';
				break;

			default:
				$kondisi_cuaca = 'Hubungi @fadhil_riyanto untuk bug kondisi cuaca!';
				break;
		}

		$reply = '📌 <b>' . $h_weat->location->name . '</b>' . PHP_EOL . PHP_EOL .
			'ℹ️ <b>Info cuaca</b>' .  PHP_EOL .
			'Negara : ' . $h_weat->location->country . PHP_EOL .
			'Waktu lokal : ' . $h_weat->location->localtime . PHP_EOL .
			'Zona waktu : ' . $h_weat->location->tz_id . PHP_EOL . PHP_EOL .
			'ℹ️ <b>Info Sederhana</b>' .  PHP_EOL .
			'Suhu celcius : ' . $h_weat->current->temp_c . PHP_EOL .
			'Suhu farenheit : ' . $h_weat->current->temp_f . PHP_EOL .
			'kelembaban : ' . $h_weat->current->humidity . PHP_EOL .
			'awan : ' . $h_weat->current->cloud . PHP_EOL .
			'kondisi : ' .  $kondisi_cuaca . PHP_EOL .
			'Ultraviolet : ' . $h_weat->current->uv . PHP_EOL .
			// 'ℹ️ <b>Info Lebih lanjut</b>' .  PHP_EOL .
			'Kecepatan angin (MPH) : ' . $h_weat->current->wind_mph . PHP_EOL .
			'Kecepatan angin (KPH) : ' . $h_weat->current->wind_kph . PHP_EOL;
		// 'derajat angin : ' . $h_weat->current->wind_degree . PHP_EOL .
		// 'arah angin : ' . $h_weat->current->wind_dir . PHP_EOL .
		// 'tekanan mb : ' . $h_weat->current->pressure_mb . PHP_EOL .
		// 'tekanan masuk : ' . $h_weat->current->pressure_in . PHP_EOL .
		// 'presipitasi Mm : ' . $h_weat->current->precip_mm . PHP_EOL .
		// 'presipitasi In : ' . $h_weat->current->precip_in . PHP_EOL .

		// 'feelslike_c : ' . $h_weat->current->feelslike_c . PHP_EOL .
		// 'feelslike_f : ' . $h_weat->current->feelslike_f . PHP_EOL .
		// 'vis_km : ' . $h_weat->current->vis_km . PHP_EOL .
		// 'vis_miles : ' . $h_weat->current->vis_miles . PHP_EOL .

		// 'gust_mph : ' . $h_weat->current->gust_mph . PHP_EOL .
		// 'gust_kph : ' . $h_weat->current->gust_kph . PHP_EOL;


		$content = array('chat_id' => $chat_id, 'text' => $reply, 'disable_web_page_preview' => true, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true, 'parse_mode' => 'html');
		$telegram->sendMessage($content);
	}
}
