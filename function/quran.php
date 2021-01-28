<?php
echo (quran_surah("Al Muslk"));
function quran_surah($input)
{
    $preg1 = preg_match('/([a-zA-Z_+\- ]+)\s([-+]?\s*\d+(?:\s*)+)/i', $input, $hasil);
    if ($preg1 == 0) {
        preg_match('/([a-zA-Z_+\- ]+)/i', $input, $hasil);
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.banghasan.com/quran/format/json/surat');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $dataRawquran = curl_exec($ch);
    curl_close($ch);
    $jsonparse = json_decode($dataRawquran);
    foreach ($jsonparse->hasil as $quranfor) {
        if (strtolower($quranfor->nama) == strtolower($hasil[1])) {
            if (isset($hasil[2])) {
                $ayat = file_get_contents('https://api.banghasan.com/quran/format/json/surat/' . $quranfor->nomor . '/ayat/' . $hasil[2]);
                $jsonayat = json_decode($ayat);
                foreach ($jsonayat->ayat->data->ar as $ayat_for) {
                    $hasilAyat1 = $ayat_for->teks . PHP_EOL;
                }
                foreach ($jsonayat->ayat->data->idt as $ayat_for) {
                    $hasilAyat2 = $ayat_for->teks . PHP_EOL;
                }
                foreach ($jsonayat->ayat->data->id as $ayat_for) {
                    $hasilAyat3 = $ayat_for->teks . PHP_EOL;
                }
                return $jsonayat->surat->nomor . '. ' . $jsonayat->surat->nama . PHP_EOL .
                    $jsonayat->surat->ayat . ' ayat, ' . $jsonayat->surat->type . PHP_EOL . PHP_EOL .
                    'ayat ke ' . $jsonayat->query->ayat2[0] . PHP_EOL .
                    $hasilAyat1 . PHP_EOL . $hasilAyat2 . PHP_EOL . PHP_EOL . $hasilAyat3;
            } else {
                return $quranfor->nomor . '. ' . $quranfor->nama .  PHP_EOL .
                    $quranfor->ayat . ' ayat, ' . $quranfor->type .  PHP_EOL . PHP_EOL .
                    'keterangan : ' . $quranfor->keterangan . PHP_EOL;
            }
        }
    }
}
