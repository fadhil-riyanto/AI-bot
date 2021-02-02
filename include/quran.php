<?php
if (isset($_GET['surah'])) {
    $inputAyat = $_GET['surah'];
}
// <?php
// $inputAyat = "al fatihaha 1";

$preg1_surah = preg_match('/([a-zA-Z_+\- ]+)\s([-+]?\s*\d+(?:\s*)+)/i', $inputAyat, $hasilayat);
if ($preg1_surah == 0) {
    preg_match('/([a-zA-Z_+\- ]+)/i', $inputAyat, $hasilayat);
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.npoint.io/99c279bb173a6e28359c/data');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$dataRawquran = curl_exec($ch);
curl_close($ch);
$jsonparseSurah = json_decode($dataRawquran);
foreach ($jsonparseSurah as $quranfor) {
    if (strtolower($quranfor->nama) == strtolower($hasilayat[1])) {
        $nomorSurah = $quranfor->nomor;
        $namaSurah = $quranfor->nama;
        $ayatSurah = $quranfor->ayat;
        $typeSurah = $quranfor->type;
        $keteranganSurah = $quranfor->keterangan;
        $ayat_bools = true;
        if (isset($hasilayat[2])) {
            $ayatnum = true;
        } else {
            $ayatnum = false;
        }
        // return $nomorSurah;
    } else {
        $ayat_bool = true;
    }
}
if (@$ayatnum == true) {
    $ayatjson = json_decode(file_get_contents('https://api.npoint.io/99c279bb173a6e28359c/surat/' . $nomorSurah));
    foreach ($ayatjson as $ayatjsons) {
        if ($ayatjsons->nomor == $hasilayat[2]) {
            echo $ayatjsons->ar . PHP_EOL;
            echo $ayatjsons->id;
        }
    }
} elseif (@$ayat_bools == true) {
    echo 'ga';
}
