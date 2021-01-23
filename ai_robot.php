<?php

use Buchin\Badwords\Badwords;
// echo robot_artificial_intelegence('fia');
function robot_artificial_intelegence($teks)
{
	require_once __DIR__ . '/vendor/autoload.php';

	global $koneksi;
	// define('DB_HOST', 'freedb.tech');											//WAJIB
	// define('DB_USERNAME', 'freedbtech_ai_bot_fadhil_riyanto');					//WAJIB
	// define('DB_PASSWORD', '789b697698hyufijbbiub*&^BO&it87tbn7to&^7896');		//WAJIB
	// define('DB_NAME', 'freedbtech_ai_bot_fadhil_riyanto');						//WAJIB
	// define('TG_HTTP_API', '1489990155:AAEC3c6I-hmtDfbk9OojmlDjNFt1NeMEjfs');	//WAJIB
	// define('USER_ID_TG_ME', '1393342467');										//WAJIB
	// define('CUTLLY_API', 'fa1d93ba90dedd2ceb7d01e9bade271653373');				//WAJIB
	// define('TIME_ZONE', 'Asia/Jakarta');										//WAJIB
	// define('MAX_EXECUTE_SCRIPT', 20);											//SUNNAH_ROSUL


	// $koneksi = @mysqli_connect(
	// 	DB_HOST,
	// 	DB_USERNAME,
	// 	DB_PASSWORD,
	// 	DB_NAME
	// );
	// $stringPertama = substr($text, 0, 1); //untuk command  slash dan karakter seru
	// $stringKedua = substr($text, 0, 2); // untuk command dengan 2 karakter, biasa di cctip

	// if ($stringPertama == '/') {
	// 	// Jika ditemukan data dengan awalan coommand telegram, maka dia ngga akan diinsert ke database
	// 	// kita menggunakan exit agar dia keluar dari konsol
	// 	exit;
	// }

	$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
	$stemmer  = $stemmerFactory->createStemmer();


	$teksTerfilter_kata_jorok = Badwords::isDirty($teks);
	$stemmer_hasil   = $stemmer->stem($teks);
	$teksTerfilter = hyphenize($stemmer_hasil);


	$q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$teksTerfilter' ");
	$tes_jumlah_row = @mysqli_affected_rows($koneksi);
	$dataAI = mysqli_fetch_assoc($q);
	foreach ($dataAI as $data_res_ai_val) {
		# code...
	}

	// Jika ternyata ada kata kata jorok 
	if ($teksTerfilter_kata_jorok == true) {
		$arrayres = array('respon' => @hyphenize($dataAI['data_res_ai']), 'normalisasi_tulisan' => @$teksTerfilter, 'bad_word' => @$teksTerfilter_kata_jorok, 'stemmer' => $stemmer_hasil, 'affected' => $tes_jumlah_row);
		return json_encode($arrayres);
	} elseif ($tes_jumlah_row > 0) {
		// Jika ternyata kata ada di database (ditemukan)
		$arrayres = array('respon' => @hyphenize($dataAI['data_res_ai']), 'normalisasi_tulisan' => @$teksTerfilter, 'bad_word' => @$teksTerfilter_kata_jorok, 'stemmer' => $stemmer_hasil, 'affected' => $tes_jumlah_row);
		return json_encode($arrayres);
	} else {
		//kalau ngga nemu alternatif pakai API
		//Yg ini
		$data_simsimi = file_get_contents('https://simsumi.herokuapp.com/api?text=' . urlencode($teksTerfilter) . '&lang=id');
		$sim_decode = json_decode($data_simsimi);
		$data_filetr_sim = hyphenize($sim_decode->success);
		//tapi kalau ternyta ip gw kena limit query maka
		if ($data_filetr_sim == 'limit 50 queries per hour.') {
			//kita pakai api yg ini lah bang
			$data_simsimi = file_get_contents('https://chatbot-indo.herokuapp.com/get/' . urlencode($teksTerfilter));
			$sim_decode = json_decode($data_simsimi);
			$data_filetr_sim = hyphenize($sim_decode->msg);
			// lalu dimasukkan ke sql, buat koleksi

			mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$teksTerfilter', '$data_filetr_sim')");
			$arrayres = array('respon' => @$data_filetr_sim, 'normalisasi_tulisan' => @$teksTerfilter, 'bad_word' => @$teksTerfilter_kata_jorok, 'stemmer' => $stemmer_hasil, 'affected' => 'simsimi');
			return json_encode($arrayres);
			exit;
		} else {
			//kalau ternyata belum kena limit, maka langsung aja insert
			mysqli_query($koneksi, "INSERT INTO `data_ai` (`data_key_ai`, `data_res_ai`) VALUES ('$teksTerfilter', '$data_filetr_sim')");
			$arrayres = array('respon' => @$data_filetr_sim, 'normalisasi_tulisan' => @$teksTerfilter, 'bad_word' => @$teksTerfilter_kata_jorok, 'stemmer' => $stemmer_hasil, 'affected' => 'simsimi');
			return json_encode($arrayres);
			exit;
		}
	}
}
function hyphenize($string)
{
	$dict = array(
		'simi' => 'fadhil',
		'sim' => 'fadhil',
		'simsimi' => 'fadhil',
		'sasimi' => 'fadhil',
		'gila' => 'sehat',
		'knp' => 'kenapa',
		'bokep' => 'nonton drakor',
		'bokepan' => 'nonton drakor',
		'yg' => 'yang',
		'?' => null,
		'*' => null,
		'@' => null,
		'!' => null,
		'-' => null,
		'yoi' => 'iya'

		// replace teks lainnya disini
	);
	return strtolower(
		preg_replace(
			array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
			array(' ', ''),

			cleanString(
				str_replace(
					array_keys($dict),
					array_values($dict),
					urldecode($string)
				)
			)
		)
	);
}
function cleanString($text)
{
	$utf8 = array(
		'/[áàâãªä]/u'   =>   'a',
		'/[ÁÀÂÃÄ]/u'    =>   'A',
		'/[ÍÌÎÏ]/u'     =>   'I',
		'/[íìîï]/u'     =>   'i',
		'/[éèêë]/u'     =>   'e',
		'/[ÉÈÊË]/u'     =>   'E',
		'/[óòôõºö]/u'   =>   'o',
		'/[ÓÒÔÕÖ]/u'    =>   'O',
		'/[úùûü]/u'     =>   'u',
		'/[ÚÙÛÜ]/u'     =>   'U',
		'/ç/'           =>   'c',
		'/Ç/'           =>   'C',
		'/ñ/'           =>   'n',
		'/Ñ/'           =>   'N',
		'/–/'           =>   '-',
		'/[’‘‹›‚]/u'    =>   ' ',
		'/[“”«»„]/u'    =>   ' ',
		'/ /'           =>   ' ',
	);
	return preg_replace(array_keys($utf8), array_values($utf8), $text);
}
