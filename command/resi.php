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
    $resichecker = resi_chek_apakah_tersedia($strorange, $adanParse_plain[1], $adanParse_plain[2]);
    if ($resichecker == 'error') {
        $reply = 'maaf ada masalah sistem, mohon hubungi ' . PUMBUAT_BOT . ' sekarang juga';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
    }

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
            if ($histori_resi->location != '') {
                $tmplate_history[] = '⏰ ' . $histori_resi->date . PHP_EOL .
                    '├  ' . $histori_resi->desc . PHP_EOL .
                    '└ ' . $histori_resi->location;
            } elseif ($histori_resi->location == '') {
                $tmplate_history[] = '⏰ ' . $histori_resi->date . PHP_EOL .
                    '└ ' . $histori_resi->desc;
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
        //$reply = substr($templates, 0, 100);
        $reply = $templates;
        //$reply = strlen(implode(PHP_EOL . PHP_EOL, $tmplate_history));
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }


    exit;
}
