<?php
$id = 75795;
$username = 'irvan';
$namaPertama = 'fales';
$namaTerakhir = 'gonzales';
function tracking_user($userID)
{
    $file = __DIR__ . "/json_data/user_client.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID) {
            return true;
        }
    }
}

$chek = tracking_user($id);
if ($chek == true) {
} elseif ($chek == null) {
    $file = __DIR__ . "/json_data/user_client.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);

    $data[] = array(
        "userid" => $id,
        "username" => $username,
        "firstname" => $namaPertama,
        "lastname" => $namaTerakhir
    );

    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);
}
