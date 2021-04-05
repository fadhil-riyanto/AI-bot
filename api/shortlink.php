<?php
require __DIR__ . '/middleware.php';
require __DIR__ . '/../pengaturan/env.php';
if (isset($_GET['query'])) {
    $br = $_GET['query'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://cutt.ly/api/api.php?key=" . CUTLLY_API . '&short=' . $br);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);

    $json_shorturl = json_decode($output, true);
    if ($output == null) {
        $res = array(
            'status' => 'server down',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 1) {
        $res = array(
            'status' => 'link telah sebelumnya di pendekkan',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 2) {
        $res = array(
            'status' => 'itu bukanlah tautan',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 3) {
        $res = array(
            'status' => 'link telah digunakan',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 4) {
        $res = array(
            'status' => 'errror, kontak pembuat nya',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 5) {
        $res = array(
            'status' => 'link tidak lolos validasi',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 6) {
        $res = array(
            'status' => 'link berasal dari domain yang di blokir',
            'url' => 'null'
        );
    } elseif ($json_shorturl["url"]["status"] == 7) {
        $res = array(
            'status' => 'sukses',
            'url' => $json_shorturl["url"]["shortLink"]
        );
    } else {
        $res = array(
            'status' => 'eror',
            'url' => null
        );
    }

    echo json_encode($res, JSON_PRETTY_PRINT);
}
