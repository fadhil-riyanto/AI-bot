<?php
require __DIR__ . '/vendor/autoload.php';
echo "
==== SELAMAT DATANG DI FADHIL ENGINE BOT ====
> Pilihan
1. Install webhook
2. install database
3. Check all data
2. Get dataset list
";
$commandGet = readline('masukkan pilihan');
echo $commandGet;
