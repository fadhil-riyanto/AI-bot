<?php
$inputAyat = "al baqarah 28";

$preg1_surah = preg_match('/([a-zA-Z_+\- ]+)\s([-+]?\s*\d+(?:\s*)+)/i', $inputAyat, $hasilayat);
if ($preg1_surah == 0) {
    preg_match('/([a-zA-Z_+\- ]+)/i', $inputAyat, $hasilayat);
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.banghasan.com/quran/format/json/surat');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataRawquran = curl_exec($ch);
curl_close($ch);
$jsonparseSurah = json_decode($dataRawquran);
foreach ($jsonparseSurah->hasil as $quranfor) {
    if (strtolower($quranfor->nama) == strtolower($hasilayat[1])) {
        $nomorSurah = $quranfor->nomor;
        $namaSurah = $quranfor->nama;
        $ayatSurah = $quranfor->ayat;
        $typeSurah = $quranfor->type;
        $keteranganSurah = $quranfor->keterangan;
        $ayat_bools = true;
        if (isset($hasilayat[2])) {
            $ayatnum = true;
        }
        // return $nomorSurah;
    } else {
        $ayat_bool = true;
    }
}
if (isset($ayatnum) == true) {
    $ayatjson = json_decode(file_get_contents('https://api.banghasan.com/quran/format/json/surat/' . $nomorSurah . '/ayat/' . $hasilayat[2]));
    $reply =  $ayatjson->surat->nomor . '. ' . $ayatjson->surat->nama . ' / ' .
        $ayatjson->surat->ayat . ' ayat, ' . $ayatjson->surat->type . PHP_EOL . 'ayat ke ' . $ayatjson->query->ayat . PHP_EOL . PHP_EOL .
        $ayatjson->ayat->data->ar[0]->teks . PHP_EOL .
        $ayatjson->ayat->data->idt[0]->teks . PHP_EOL .
        $ayatjson->ayat->data->id[0]->teks . PHP_EOL;
} elseif (isset($ayat_bools) == true) {
    $reply = $nomorSurah . '. ' . $namaSurah .  PHP_EOL .
        $ayatSurah . ' ayat, ' . $typeSurah .  PHP_EOL . PHP_EOL .
        'keterangan : ' . $keteranganSurah . PHP_EOL;
} elseif ($ayat_bool == true) {
    $reply = 'gk nemu';
}
echo $reply;
