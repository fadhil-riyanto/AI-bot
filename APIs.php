<?php
error_reporting(0);
// function
function corona_Provinsi($province)
{
    $a_provinsi_corona = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi'); //get json ke server
    $b_provinsi_corona = json_decode($a_provinsi_corona); //lalu decode
    foreach ($b_provinsi_corona as $bb_b_provinsi_corona) { //loop sampai menemukan yg pas
        if (strtolower($bb_b_provinsi_corona->attributes->Provinsi) == $province) { //jika nama provinsi sama maka
            $reply = 'Provinsi : ' . $bb_b_provinsi_corona->attributes->Provinsi . PHP_EOL . PHP_EOL .
                '😊 Total sembuh : ' . $bb_b_provinsi_corona->attributes->Kasus_Semb . PHP_EOL .
                '😞 Total positif : ' . $bb_b_provinsi_corona->attributes->Kasus_Posi . PHP_EOL .
                '😢 Total meninggal : ' . $bb_b_provinsi_corona->attributes->Kasus_Meni . PHP_EOL;
            header('type: text/plain');
            print($reply);
        }
    }
}
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
                if (isset($jsonayat->ayat->error)) {
                    return 'kosong';
                    exit;
                }
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
function gempa($domain)
{
    $mxzone = dns_get_record($domain, DNS_MX);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
function dapatkan_mx($domain)
{
    $mxzone = dns_get_record($domain, DNS_MX);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
function dapatkan_ns($domain)
{
    $mxzone = dns_get_record($domain, DNS_NS);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
function dapatkan_a($domain)
{
    $mxzone = dns_get_record($domain, DNS_A);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['ip'] . PHP_EOL;
    }
}
function dapatkan_aaaa($domain)
{
    $mxzone = dns_get_record($domain, DNS_AAAA);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['ipv6'] . PHP_EOL;
    }
}

function dapatkan_txt($domain)
{
    $mxzone = dns_get_record($domain, DNS_TXT);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['txt'] . PHP_EOL;
    }
}

function dapatkan_cname($domain)
{
    $mxzone = dns_get_record($domain, DNS_CNAME);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
//URI
if (isset($_GET['method'])) {
    $method = @$_GET['method'];
    $dns     = @$_GET['dns'];
} else {
    echo 'null';
}

switch (@$method) {
    case 'mx':
        dapatkan_mx($dns);
        break;

    case 'ns':
        dapatkan_ns($dns);
        break;

    case 'surah':
        header('type: text/plain');
        echo quran_surah($dns);
        break;

    case 'a':
        dapatkan_a($dns);
        break;

    case 'corona_provinsi':
        corona_Provinsi($dns);
        break;

    case 'aaaa':
        dapatkan_aaaa($dns);
        break;

    case 'txt':
        dapatkan_txt($dns);
        break;

    case 'cname':
        dapatkan_cname($dns);
        break;

    default:
        # code...
        break;
}
