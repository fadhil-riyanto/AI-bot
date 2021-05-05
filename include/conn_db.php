<?php
try {
    //code...
    $db = \ParagonIE\EasyDB\Factory::fromArray([
        DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USERNAME,
        DB_PASSWORD
    ]);
} catch (Exception $e) {
    $alasan_db_error = $e;
    $db_error_koneksi = true;
}
