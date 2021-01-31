<?php
// $angka = 1;
// $ayat = 6;
$udahDiparse = 'al mulk';
$preg1_surah = preg_match('/([a-zA-Z_+\- ]+)\s([-+]?\s*\d+(?:\s*)+)/i', $udahDiparse, $hasilayat);
if ($preg1_surah == 0) {
    preg_match('/([a-zA-Z_+\- ]+)/i', $udahDiparse, $hasilayat);
}
$qs_trimmed = rtrim($hasilayat[1], " ");
function cariKodeNomorSurah($teks)
{
    global $nomorSurah;
    global $ketSurah;
    global $artiSurah;
    global $ayatSurah;
    global $namaSurah;
    global $typeSurah;
    $listSurah = file_get_contents(__DIR__ . '\..\json_data\quran\list_surat.json');
    $listSurah_dec = json_decode($listSurah);
    foreach ($listSurah_dec->hasil as $listSurah_for) {
        if (strtolower($listSurah_for->nama) == strtolower($teks)) {
            $nomorSurah = $listSurah_for->nomor;
            $ketSurah = $listSurah_for->keterangan;
            $artiSurah = $listSurah_for->arti;
            $ayatSurah = $listSurah_for->ayat;
            $namaSurah = $listSurah_for->nama;
            $typeSurah = $listSurah_for->type;
            return true;
        }
    }
    return false;
}
$angkaBoolQS = cariKodeNomorSurah($qs_trimmed);
$angka = $nomorSurah;
if (isset($hasilayat[2])) {
    $ayat = $hasilayat[2];
}
if ($angkaBoolQS == false) {
    $reply =  "ups, ga nemu";
} elseif ($angkaBoolQS == true and empty($hasilayat[2])) {
    $reply =  '<b>' . $nomorSurah . '. ' . $namaSurah .  ' (' . $artiSurah . ')</b>' . PHP_EOL .
        $ayatSurah . ' Ayat, ' . $typeSurah .   PHP_EOL . PHP_EOL . $ketSurah;
} elseif ($angkaBoolQS == true || empty($hasilayat[2]) == false) {
    $qjson_get_data = file_get_contents(__DIR__ . '\..\json_data\quran\\'  . $angka . '.json');
    $a = json_decode($qjson_get_data);
    $reply = '<b>' . $nomorSurah . '. ' . $namaSurah .  ' (' . $artiSurah . ')</b>' . PHP_EOL .
        $ayatSurah . ' Ayat, ' . $typeSurah .   PHP_EOL . PHP_EOL .
        $a->$angka->text->$ayat . PHP_EOL . PHP_EOL .
        'Translate : ' . $a->$angka->translations->id->text->$ayat;
}
echo $reply;
