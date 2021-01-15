<?php
class filter_pesan
{
	public function hyphenize($string)
	{
		$dict = array(
			"km"      => "kamu",
			"yoi"      => "ya",
			"yg"      => "yang",
			"gk"      => "gak",
			"tg"    => "telegram"
			// replace teks lainnya disini
		);
		return strtolower(
			preg_replace(
				array('#[\\s-]+#', '#[^A-Za-z0-9. -]+#'),
				array(' ', ''),

				$this->cleanString(
					str_replace(
						array_keys($dict),
						array_values($dict),
						urldecode($string)
					)
				)
			)
		);
	}
	public function cleanString($text)
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
}

$a = new AIengine();
echo $a->hyphenize('Halo, km main -telegram gk??');
//$stringfilter = str_replace($kata, $ganti, $string);

//echo $string;
//echo $stringfilter;

// $file = file_get_contents("slangword.json");
// $h = json_decode($file);
//var_dump($h);
// echo $h->;
// $data = array("");
// $a =  preg_replace('/km/', 'kamu', $teks);
// // $b =  preg_replace('/syg/', 'sayang', $a);
// // $c =  preg_replace('/tg/', 'telegram', $b);
// // $d =  preg_replace('/pk/', 'pak', $c);
// // $e =  preg_replace('/yoi/', 'ya', $d);

// $q = mysqli_query($koneksi, "SELECT * FROM `data_ai` WHERE `data_key_ai` SOUNDS LIKE _utf8 '$a' ");
// $tes_jumlah_row = @mysqli_affected_rows($koneksi);
// $dataAI = mysqli_fetch_assoc($q);

// var_dump($dataAI);
/*
$teksParse = explode(' ', $teks);
foreach ($h->dataSlang as $slangWord) {
	if ($slangWord->slang == 'kjm') {
		echo $slangWord->pembenaran;
		exit;
	} else {
		echo "tidak ditemukan";
		exit;
	}
}

foreach ($teksParse as $cekKata) {
	if ($cekKata == 'kjm') {
		echo $slangWord->pembenaran;
		exit;
	} else {
		echo "tidak ditemukan";
		exit;
	}
}
*/