<?php


require __DIR__ . '/../include/simple_html_dom.php';

$storeddata = __DIR__ . '/../json_data/corona_scrapper_cache.txt';
$getfilestore = file_get_contents($storeddata);
if ($getfilestore == null) {
	$html = file_get_html('https://www.worldometers.info/coronavirus/country/indonesia/');

	foreach ($html->find('div[class=maincounter-number]') as $elements) {
		$corona_crawl[] = preg_replace('/\s+/', '', $elements->plaintext);
	}
	$writecachecov = time() + $delay_cov . '#' . $corona_crawl[0] . '#' . $corona_crawl[1] . '#' . $corona_crawl[2];
	file_put_contents($storeddata, $writecachecov);

	$kasus = $corona_crawl[0];
	$mati = $corona_crawl[1];
	$sembuh = $corona_crawl[2];
} else {
	$ex_coviddata = explode('#', $getfilestore);

	$delay_cov = 1200;
	$math1_covid = $ex_coviddata[0] + $delay_cov;
	$math2_covid = $math1_covid - time();
	if ($math2_covid > 0) {
		$kasus = $ex_coviddata[1];
		$mati = $ex_coviddata[2];
		$sembuh = $ex_coviddata[3];
	} elseif ($math2_covid < 0) {
		$html = file_get_html('https://www.worldometers.info/coronavirus/country/indonesia/');

		foreach ($html->find('div[class=maincounter-number]') as $elements) {
			$corona_crawl[] = preg_replace('/\s+/', '', $elements->plaintext);
		}
		$writecachecov = time() + $delay_cov . '#' . $corona_crawl[0] . '#' . $corona_crawl[1] . '#' . $corona_crawl[2];
		file_put_contents($storeddata, $writecachecov);

		$kasus = $corona_crawl[0];
		$mati = $corona_crawl[1];
		$sembuh = $corona_crawl[2];
	}
}


$reply =  'Hai ' . $username . PHP_EOL .
	'jumlah kasus Corona sekarang adalah' . PHP_EOL . PHP_EOL .
	'kasus   ' . $kasus . PHP_EOL .
	'meninggal ' . $mati . PHP_EOL .
	'sembuh   ' . $sembuh . PHP_EOL . PHP_EOL .
	'Dan Jangan lupa selalu pakai masker dan jaga kesehatan yaaa';
$option = array(
	//First row
	// array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
	// //Second row 
	// array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
	// //Third row


	array($telegram->buildInlineKeyBoardButton("covid19", $url = "https://covid19.go.id/"), $telegram->buildInlineKeyBoardButton("kemenkes", $url = "https://www.kemkes.go.id/"))
);
$keyb = $telegram->buildInlineKeyBoard($option);


$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
