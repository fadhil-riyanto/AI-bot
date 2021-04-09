<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['text'])) {
    $br = $_GET['text'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://kbbi-api-zhirrr.vercel.app/api/kbbi?text=" . urlencode($br));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    render_json(json_decode($output));
} else {
    render_json(array(
        'error' => 'parameter tidak lengkap, dibutuhkan domain'
    ));
}
