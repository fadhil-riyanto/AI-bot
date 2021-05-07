<?php
$teks = <<<EOF
Cogratulantions! gratis You've won a $1,000 Walmart gift card. Go to http://bit.ly/123456 to claim now
EOF;
$spam = strtolower($teks);
//level 1, cuma 4 x penyaringan
$dataset_level_low  = array(
    "penghasil", "uang", "gratis", "cepat", "instan", "sah", "rewards", "reward", "mingguan", "reseller",
    "download sekarang", "referal", "referal kamu", "referal anda", "kode otp", "sah", "referal",
    "jackpot", "binomo", "investement", "cogratulations", "binary option", "kode otp", "judi"
);

//deteksi low
foreach ($dataset_level_low as $wb) {
    if (strpos($spam, $wb) !== false) {
        $deteksi_low[] = "*";
    }
}
if (isset($deteksi_low)) {
    $ditemukan = count($deteksi_low);
    if ($ditemukan > 3) {
        $deteksilink = preg_match("#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si", $spam);
        if ($deteksilink == 1) {
            preg_match_all("#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si", $spam, $result_url);
        }
    }
}
