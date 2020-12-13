<?php
elseif('/short' == $dns_parse[0] || '/short@fadhil_riyanto_bot' == $dns_parse[0]){
	if(filter_var($dns_parse[1], FILTER_VALIDATE_URL)){
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://chogoon.com/srt/api/?url=".$dns_parse[1]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
		$json_shorturl = json_decode($output);
		$reply = 'maaf, anda salah. gunakan syntax'. PHP_EOL .
					'/azan {kota}'. PHP_EOL .PHP_EOL .
					'Contoh /azan jakarta';
		$content = array('chat_id' => $chat_id, 'text' => $json_shorturl);
		$telegram->sendMessage($content);
	}
	exit;
}