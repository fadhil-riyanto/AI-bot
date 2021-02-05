<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/include/konstanta.php';
echo "
==== SELAMAT DATANG DI FADHIL ENGINE BOT ====
> Pilihan
1. Install webhook
2. install database
3. Check all data
2. Get dataset list
";

echo '
=========================
* Bot Installer
-------------------------
* oleh: fadhil riyanto
* email: id.fadhil.riyanto@gmail.com 
* telegram : @fadhil_riyanto
* grup telegram: @tgdev_php
-------------------------
* Release: Versi ' . FVER . '
* Tanggal: ' . FUP . '
* Website: ' . FWEB . '
=========================

';

echo 'Ingin melanjutkan proses installasi (Ya/Tidak/Kosong BATAL)? ';

$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
if (strtolower(trim($line)) != 'ya') {
	echo '- Proses installasi dibatalkan!' . PHP_EOL . PHP_EOL;
	echo 'Terimakasih.' . PHP_EOL;
	exit;
}
$myfile = fopen('pengaturan/set_install.json', 'w') or die('Gagal membuat file!' . PHP_EOL . 'Pastikan direktori /pengaturan dapat ditulisi.');
echo 'Masukkan token bot: ';
$line = fgets($handle);
echo '
------------------------
+ Proses...
';

$TOKEN = trim($line);

$method = 'getMe';
$url = 'https://api.telegram.org/bot' . $TOKEN . '/' . $method;

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$datas = curl_exec($ch);
echo curl_error($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo '________________________' . PHP_EOL;
if ($status != 200) {
	echo 'Token ERROR!' . PHP_EOL;
} else {
	$data = json_decode($datas);
	echo 'Nama Bot             : ' . $data->result->first_name . PHP_EOL;
	echo 'Username Bot         : ' . $data->result->username . PHP_EOL;
	echo 'id Bot               : ' . $data->result->id . PHP_EOL;
	echo 'apakah bisa join grup: ' . $data->result->can_join_groups . PHP_EOL;
}
echo '________________________' . PHP_EOL;
