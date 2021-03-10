<?php
$strorange = __DIR__ . '/../json_data/binderbyte_api.json';
require __DIR__ . '/../include/cek_resi_hack.php';
$tmp_resi = json_decode(resi_chek_apakah_tersedia($strorange, 'pos', '18374204072'));
foreach ($tmp_resi->data->history as $histori_resi) {
    if ($histori_resi->location != null) {
        $tmplate_history[] = '⏰ ' . $histori_resi->date . PHP_EOL .
            '├  ' . ucwords(strtolower($histori_resi->desc)) . PHP_EOL .
            '└ ' . $histori_resi->location;
    } elseif ($histori_resi->location == null) {
        $tmplate_history[] = '⏰ ' . $histori_resi->date . PHP_EOL .
            '└ ' . ucwords(strtolower($histori_resi->desc));
    }
}
if (isset($tmp_resi->data->summary->service)) {
    $ceklayanan = '├ ' . $tmp_resi->data->summary->awb . PHP_EOL .
        '└ Service: ' . $tmp_resi->data->summary->service . PHP_EOL . PHP_EOL;
} else {
    $ceklayanan = '└ ' . $tmp_resi->data->summary->awb . PHP_EOL . PHP_EOL;
}
//cek pengirim
if (isset($tmp_resi->data->detail->shipper)) {
    $shipper_pengirim  = '├ ' . $tmp_resi->data->detail->shipper . PHP_EOL .
        '└ ' . $tmp_resi->data->detail->origin . PHP_EOL . PHP_EOL;
} else {
    $shipper_pengirim  = '└ ' . $tmp_resi->data->detail->origin . PHP_EOL . PHP_EOL;
}
//cek penerima
if (isset($tmp_resi->data->detail->receiver)) {
    $cek_penerima_resi  = '├ ' . $tmp_resi->data->detail->receiver . PHP_EOL .
        '└ ' . $tmp_resi->data->detail->destination . PHP_EOL . PHP_EOL;
} else {
    $cek_penerima_resi  = '└ ' . $tmp_resi->data->detail->destination . PHP_EOL . PHP_EOL;
}

$templates = '📦 Ekspedisi ' . $tmp_resi->data->summary->courier . PHP_EOL .  PHP_EOL .
    '📮 Status' . PHP_EOL .
    '├ Ybs - (YBS) Yang Bersangkutan' . PHP_EOL .
    '├ ' . $tmp_resi->data->summary->date . PHP_EOL .
    '└ ' . $tmp_resi->data->summary->status . PHP_EOL . PHP_EOL .
    '📃 Resi' . PHP_EOL . $ceklayanan .

    '💁🏼 Pengirim' . PHP_EOL . $shipper_pengirim .

    '🎯 Penerima' . PHP_EOL . $cek_penerima_resi .

    '🚧 POD Detail' . PHP_EOL . PHP_EOL . implode(PHP_EOL . PHP_EOL, $tmplate_history);

echo $templates;
