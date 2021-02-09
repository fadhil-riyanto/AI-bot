<?php
$nama = 'Reina';
$data = file_get_contents('http://f2426d0b0215.ngrok.io/line/group/chat/?id=ce261b40226bd36f043e8e7e3e0e1d930&frontend=false&display=100');
$data1 = json_decode($data);
foreach ($data1->group->members->contact as $kontak) {
    if ($kontak->name == $nama) {
        echo 'Nama : ' . $kontak->name . PHP_EOL;
        echo 'gambar : ' . $kontak->picture;
    }
}
