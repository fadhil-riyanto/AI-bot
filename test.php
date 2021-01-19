<?php

// demo.php

// include composer autoloader


// create sentence detector
define('DB_HOST', 'freedb.tech');											//WAJIB
	define('DB_USERNAME', 'freedbtech_ai_bot_fadhil_riyanto');					//WAJIB
	define('DB_PASSWORD', '789b697698hyufijbbiub*&^BO&it87tbn7to&^7896');		//WAJIB
	define('DB_NAME', 'freedbtech_ai_bot_fadhil_riyanto');						//WAJIB
	define('TG_HTTP_API', '1489990155:AAEC3c6I-hmtDfbk9OojmlDjNFt1NeMEjfs');	//WAJIB
	define('USER_ID_TG_ME', '1393342467');										//WAJIB
	define('CUTLLY_API', 'fa1d93ba90dedd2ceb7d01e9bade271653373');				//WAJIB
	define('TIME_ZONE', 'Asia/Jakarta');										//WAJIB
	define('MAX_EXECUTE_SCRIPT', 20);											//SUNNAH_ROSUL

	$koneksi = @mysqli_connect(
		DB_HOST,
		DB_USERNAME,
		DB_PASSWORD,
		DB_NAME
	);
	
require_once __DIR__ . '/vendor/autoload.php';

// create sentence detector
$sentenceDetectorFactory = new \Sastrawi\SentenceDetector\SentenceDetectorFactory();
$sentenceDetector = $sentenceDetectorFactory->createSentenceDetector();

// detect sentence
$text = 'Naufal mana? surya mana?';
$sentences = $sentenceDetector->detect($text);

foreach ($sentences as $i => $sentence) {
    //echo "$i : $sentence<br />\n";
	$query_sentece = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$sentence' ");
	$data_sentece = mysqli_fetch_assoc($query_sentece);
	echo $data_sentece['data_res_ai'] . ' ' ;
}
			/*$query_sentece = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$sentence' ");
			$data_sentece = mysqli_fetch_assoc($query_sentece);*/
			//var_dump($sentence);
		
		
		
		