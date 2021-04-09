<?php
require __DIR__ . '/middleware.php';
$getQuotesJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/merge_province_postal_full.min.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);
$jumlah =  count($getQuotesJSONsaxDec);
// echo $jumlah;
if (isset($_GET['short'])) {
    $shortby = strtolower($_GET['short']);
    if (isset($_GET['query'])) {
        $querys = $_GET['query'];
        if ($shortby == 'district' || $shortby == 'kecamatan' || $shortby == 'sub_district') {
            foreach ($getQuotesJSONsaxDec as $kodeposs) {
                if (strtolower($kodeposs->sub_district) == strtolower($querys)) {
                    header('Content-Type: application/json', true, 200);
                    $a[] = array(
                        "urban" => $kodeposs->urban,
                        "sub_district" => $kodeposs->sub_district,
                        "city" => $kodeposs->city,
                        "province_code," => $kodeposs->province_code,
                        "postal_code," => $kodeposs->postal_code
                    );
                }
            }
            //header('Content-Type: application/json', true, 200);
            echo render_json($a);
        } elseif ($shortby == 'urban' || $shortby == 'desa') {
            foreach ($getQuotesJSONsaxDec as $kodeposs) {
                if (strtolower($kodeposs->urban) == strtolower($querys)) {
                    header('Content-Type: application/json', true, 200);
                    $a[] = array(
                        "urban" => $kodeposs->urban,
                        "sub_district" => $kodeposs->sub_district,
                        "city" => $kodeposs->city,
                        "province_code," => $kodeposs->province_code,
                        "postal_code," => $kodeposs->postal_code
                    );
                }
            }
            // header('Content-Type: application/json', true, 200);
            echo render_json($a);
        } elseif ($shortby == 'kota' || $shortby == 'city') {
            foreach ($getQuotesJSONsaxDec as $kodeposs) {
                if (strtolower($kodeposs->city) == strtolower($querys)) {
                    header('Content-Type: application/json', true, 200);
                    $a[] = array(
                        "urban" => $kodeposs->urban,
                        "sub_district" => $kodeposs->sub_district,
                        "city" => $kodeposs->city,
                        "province_code," => $kodeposs->province_code,
                        "postal_code," => $kodeposs->postal_code
                    );
                }
            }
            // header('Content-Type: application/json', true, 200);
            echo render_json($a);
        } else {
            echo render_json(array(
                "error" => "method penyortiran tidak ditemukan"
            ));
        }
    }
}
