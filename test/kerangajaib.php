<?php
function kerang_ajaib($teks)
{
    $lowercasesemua = strtolower($teks);
    if ($lowercasesemua == 'kapan') {
        $ret = "kapan apanya sih?";
    } elseif ($lowercasesemua == 'kapan?') {
        $ret = "kapan apanya sih?";
    } elseif ($lowercasesemua == 'apakah') {
        $ret = "kenapa?";
    } elseif ($lowercasesemua == 'apakah?') {
        $ret = "kenapa?";
    } elseif ($lowercasesemua == 'kerang ajaib') {
        $ret = "kenapa kk?";
    } elseif ($lowercasesemua == 'kerang ajaib?') {
        $ret = "kenapa kk?";
    }
    $meledak = explode(" ", $lowercasesemua);
    if ($meledak[0] == "kapan") {
        if ($meledak[1] == "aku") {
            if ($meledak[2] == "menikah") {
                $ret = "mungkin tahun depan #eh";
            } elseif ($meledak[2] == "sunat") {
                $ret = "emang blom sunat? wkwk";
            } elseif ($meledak[2] == "mati") {
                $ret = "ga tahu awokawok";
            } elseif ($meledak[2] == "tidur") {
                $ret = "hmhm, baru saja kamu tidur";
            } elseif ($meledak[2] == "nikah") {
                $ret = "mungkin tahun depan #eh";
            }
        } elseif ($meledak[1] == "kamu") {
            if ($meledak[2] == "mandi") {
                $ret = "barusan #eh";
            } elseif ($meledak[2] == "dibuat") {
                $ret = "pastinya dah lama, wkwk";
            } elseif ($meledak[2] == "mati") {
                $ret = "developer bot ini nangis loh kamu ngomong gitu";
            } elseif ($meledak[2] == "tidur") {
                $ret = "hmhm, baru saja mungkin";
            } elseif ($meledak[2] == "nikah") {
                $ret = "doain cepet nikah, masih nunggu 7 tahun lagi awokawok #eh";
            }
        }
    } elseif ($meledak[0] == "sama") {
        if ($meledak[1] == "siapa") {
            if ($meledak[2] == "aku") {
                if ($meledak[3] == "menikah") {
                    $ret = "yang pasti tidak sesama jenis haha";
                } elseif ($meledak[3] == "kawin") {
                    $ret = "yang pasti tidak sesama jenis haha";
                } elseif ($meledak[3] == "tidur") {
                    $ret = "sama bantal bayangan #awokawok";
                } elseif ($meledak[3] == "menikah") {
                    $ret = "yang pasti tidak sesama jenis haha";
                }
            }
        }
    }
    return $ret;
}

var_dump(kerang_ajaib("sama siapa aku menikah"));
