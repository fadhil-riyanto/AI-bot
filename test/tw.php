<?php
header('Content-type: image/jpeg');
// Buat image nya
$jpg_image = imagecreatefromjpeg('sunset.jpg');
$lebar = imagesx($jpg_image);
$berat = imagesy($jpg_image);
// Alokasikan warna R G B
$white = imagecolorallocate($jpg_image, 255, 195, 0);
// Font
$font_path = __DIR__ . '/Montserrat-Bold.ttf';
$text = "Matahari terbenam";
$ukuran = 50;
// dapatkan koordinat
$box = imageftbbox($ukuran, 0, $font_path, $text);
//hitung berdasar koordinat box teks
$koordinat_x = (200 - $box[2] - $box[0]) / 2;
$koordinat_y = (200 - $box[1] - $box[7]) / 2;
$koordinat_y -= $box[7];
// build image
imagettftext($jpg_image, $ukuran, 0, $koordinat_x, $koordinat_y, $white, $font_path, $text);
imagejpeg($jpg_image);
// hapus ram
imagedestroy($jpg_image);
