<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['domain'])) {
    $br = $_GET['domain'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json/" . urlencode($br));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    render_json(json_decode($output));
} else {
    render_json(array(
        'error' => 'parameter tidak lengkap, dibutuhkan domain'
    ));
}
