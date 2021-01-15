<?php
$json = '{
  "kota": [
    {
      "slang": "km",
      "fix": "kamu"
    },
    {
      "slang": "yh",
      "fix": "yah"
    }
  ]
}';
$kata = 'km kenapa?';
$json_dec = json_decode($json);
foreach($json_dec->kota as $for_json_dec){
	foreach
}

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