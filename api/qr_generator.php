<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['data'])) {
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://api.qrserver.com/v1/create-qr-code/?size=720x720&data=" . urlencode($_GET['data']));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // $output = curl_exec($ch);
    // curl_close($ch);
    // $hasil = json_decode($output);
    // render_json($hasil);
    //$typed = image_type_to_mime_type(exif_imagetype("https://api.qrserver.com/v1/create-qr-code/?size=720x720&data=" . urlencode($_GET['data'])));
    header('Content-type: image/jpeg');
    imagejpeg(imagecreatefromjpeg("https://api.qrserver.com/v1/create-qr-code/?size=720x720&data=" . urlencode($_GET['data'])));
}
