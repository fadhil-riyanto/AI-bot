<?php
require __DIR__ . '/../include/cek_resi_hack.php';
$strorange = __DIR__ . '/../json_data/binderbyte_api.json';


//$hapusTulis = 
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($adanParse[1] == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Maaf, anda harus memasukkan jenis ekspedisi dan nomor resi' . PHP_EOL . PHP_EOL . '<pre>/resi sicepat (nomor resi kamu)</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} else {
    preg_match('/([a-zA-Z_+\- ]+)\s([a-zA-Z0-9_+\- ]+)/i', $udahDiparse, $hasilresi);
    $resichecker = resi_chek_apakah_tersedia($strorange, $hasilresi[1], $hasilresi[2]);

    if ($resichecker == 'courier null') {
        $reply = 'maaf, expedisi tidak ditemukan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } elseif ($resichecker == 'data null') {
        $reply = 'maaf, resi tidak ditemukan atau mungkin info terpending';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $tmp_resi = json_decode($resichecker);
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
        $templates = '📦 Ekspedisi ' . $tmp_resi->data->summary->courier . PHP_EOL .  PHP_EOL .
            '📮 Status' . PHP_EOL .
            '├ Ybs - (YBS) Yang Bersangkutan' . PHP_EOL .
            '├ ' . $tmp_resi->data->summary->date . PHP_EOL .
            '└ ' . $tmp_resi->data->summary->status . PHP_EOL . PHP_EOL .
            '📃 Resi' . PHP_EOL .
            '├ ' . $tmp_resi->data->summary->awb . PHP_EOL .
            '├ Service: ' . $tmp_resi->data->summary->service . PHP_EOL . PHP_EOL .
            '💁🏼 Pengirim' . PHP_EOL .
            '├ ' . $tmp_resi->data->detail->shipper . PHP_EOL .
            '└ ' . $tmp_resi->data->detail->origin . PHP_EOL . PHP_EOL .
            '🎯 Penerima' . PHP_EOL .
            '├ ' . $tmp_resi->data->detail->receiver . PHP_EOL .
            '└ ' . $tmp_resi->data->detail->destination . PHP_EOL . PHP_EOL .
            '🚧 POD Detail' . PHP_EOL . PHP_EOL .
            implode($tmplate_history, PHP_EOL . PHP_EOL);
        $reply = $templates;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }


    exit;
}
