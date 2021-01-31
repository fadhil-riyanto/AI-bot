<?php
function cariKodeNomorSurah($teks)
{
    $listSurah = file_get_contents(__DIR__ . '\..\json_data\quran\list_surat.json');
    $listSurah_dec = json_decode($listSurah);
    foreach ($listSurah_dec->hasil as $listSurah_for) {
        if (strtolower($listSurah_for->nama) == strtolower($teks)) {
            $nomorSurah = $listSurah_for->nomor;
            return true;
        }
    }
    return false;
}
var_dump(cariKodeNomorSurah('Al Hajja'));
echo $nomorSurah;
