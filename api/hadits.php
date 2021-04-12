<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['kitab']) && isset($_GET['nomor'])) {
    $br = $_GET['query'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://server-data.000webhostapp.com/proxyj.php?uri=https://hadits-api-zhirrr.vercel.app/books/" . urlencode($_GET['kitab']) . '/' . urlencode($_GET['nomor']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $decss = json_decode($output);
    $desssssss = base64_decode($decss->data);
    render_json(json_decode($desssssss)->data);
} else {
    render_json(array(
        'error' => 'parameter query dibutuhkan'
    ));
}
