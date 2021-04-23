<?php

if ($bahasa_pilihan == 'id_id') {
    require __DIR__ . '/id_ID.php';
} elseif ($bahasa_pilihan == 'en_en') {
    require __DIR__ . '/en_EN.php';
} else {
    require __DIR__ . '/id_ID.php';
}
