<?php
/*$udahDiparse = 'aceh barat daya';
$azanDapatkankota = file_get_contents('https://api.banghasan.com/sholat/format/json/kota/nama/'.urlencode($udahDiparse));
$h = json_decode($azanDapatkankota);
foreach($h->kota as $azanKode){
	if($azanKode->nama == strtoupper($udahDiparse)){
		//echo $azanKode->id;
		$azangetJadwal = file_get_contents('https://api.banghasan.com/sholat/format/json/jadwal/kota/'.$azanKode->id.'/tanggal/'.date('Y-m-d'));
		$jsonHasilazancurl = json_decode($azangetJadwal);
		$reply = 'Jadwal azan dikota '.strtolower($udahDiparse).' Adalah'.PHP_EOL . PHP_EOL . PHP_EOL .
					'subuh : '.$jsonHasilazancurl->jadwal->data->subuh . PHP_EOL . 
					'imsak : '.$jsonHasilazancurl->jadwal->data->imsak . PHP_EOL . 
					'terbit : '.$jsonHasilazancurl->jadwal->data->terbit . PHP_EOL . 
					'dhuha : '.$jsonHasilazancurl->jadwal->data->dhuha . PHP_EOL . 
					'dzuhur : '.$jsonHasilazancurl->jadwal->data->dzuhur . PHP_EOL . 
					'ashar : '.$jsonHasilazancurl->jadwal->data->ashar . PHP_EOL . 
					'maghrib : '.$jsonHasilazancurl->jadwal->data->maghrib . PHP_EOL . 
					'isya : '.$jsonHasilazancurl->jadwal->data->isya . PHP_EOL . 
					'tanggal : '.$jsonHasilazancurl->jadwal->data->tanggal . PHP_EOL . PHP_EOL . 
					'Sumber : api.banghasan.com';
		echo $reply;
	}elseif(file_get_contents('https://api.banghasan.com' == null)){
		$reply = 'Server api.banghasan.com down';
		echo $reply;
	}else{
		$reply = 'maaf, kota tidak ditemukan';
		echo $reply;
	}
}

    $json = '{
				"hello": ["world"], "goodbye": []}';
	$json1 = '{
  "status": "ok",
  "query": {
    "format": "json",
    "nama": "semarang"
  },
  "kota": [
    {
      "id": "735",
      "nama": "KOTA SEMARANG"
    },
    {
      "id": "728",
      "nama": "SEMARANG"
    }
  ]
}';
    $decoded = json_decode($json1);
    print "Is hello empty? " . empty($decoded->{'status'});
    print "\n";
    print "Is goodbye empty? " . empty($decoded->{'kota'});
    print "\n";
	
	 $input = 'https://www.google.com/';

    $input = trim($input, '/');
    if (!preg_match('#^http(s)?://#', $input)) {
        $input = 'http://' . $input;
    }
    $urlParts = parse_url($input);
    // Remove www.
    $domain_name = preg_replace('/^www\./', '', $urlParts['host']);

    echo $domain_name;
	*/
	$kata = 'satu dua tiga empat lima enam tujuh lapan sembilan speuluh sebelah';
	if (str_word_count($kata) > 4 ){
	echo substr($kata,0,10)."[..]" ;
	} else {
	echo $kata;
	}
?>