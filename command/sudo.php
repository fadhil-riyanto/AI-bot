<?php
if ($userID != $userid_pemilik) {
    $reply = 'Kamu gaada akses untuk menjalankan command ini!' . PHP_EOL . 'command ini hanya bisa dijalankan oleh pemilik bot ini ( @fadhil_riyanto )';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
}
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);


$getStringFromSpasi = explode(' ', $udahDiparse);
if ($getStringFromSpasi[0] == 'debug' || $getStringFromSpasi[0] == 'debugmode') {
    if ($getStringFromSpasi[1] == 'on') {
        $anggota = file_get_contents(__DIR__ . '/../pengaturan/settings.json');

        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['no'] === 1) {
                $data[$key]['debug'] = true;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents(__DIR__ . '/../pengaturan/settings.json', $jsonfile);
        $reply = 'Mode debug dinyalakan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } elseif ($getStringFromSpasi[1] == 'off') {
        $anggota = file_get_contents(__DIR__ . '/../pengaturan/settings.json');

        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['no'] === 1) {
                $data[$key]['debug'] = false;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents(__DIR__ . '/../pengaturan/settings.json', $jsonfile);
        $reply = 'Mode debug dimatikan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($getStringFromSpasi[0] == 'dataset') {
    if ($getStringFromSpasi[1] == 'count') {
        $bucin = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/bucin.json')));
        $faktaunik = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/faktaunik.json')));
        $katabijak = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/katabijak.json')));
        $pantun = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/pantun.json')));
        $quot = count(json_decode(file_get_contents(__DIR__ . '/../json_data/fiturTambahan/quot.json')));
        $reply = 'jumlah dataset di /json_data/fiturTambahan ' . PHP_EOL .
            'bucin : ' . $bucin . PHP_EOL .
            'faktaunik : ' . $faktaunik . PHP_EOL .
            'katabijak : ' . $katabijak . PHP_EOL .
            'pantun : ' . $pantun . PHP_EOL .
            'quot : ' . $quot;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($getStringFromSpasi[0] == 'ram' || $getStringFromSpasi[0] == 'ram_usage') {
    function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    $ramUsage =  convert(memory_get_usage(true)); // 123 kb
    $reply = 'ram used ' . $ramUsage;
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($getStringFromSpasi[0] == 'use_system' || $getStringFromSpasi[0] == 'shell') {
    $udahDiparse = str_replace($adanParse[0] . ' ' . $adanParse[1] . ' ', '', $text);
    $reply = shell_exec($udahDiparse);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($getStringFromSpasi[0] == 'eval' || $getStringFromSpasi[0] == 'exec_value') {
    $udahDiparse = str_replace($adanParse_plain_nokarakter[0] . ' ' . $adanParse_plain_nokarakter[1] . ' ', '', $text_plain_nokarakter);
    // require($filePath);
    require __DIR__ . '/../include/eval_func.php';

    try {
        $result = eval($udahDiparse);
        $content = array('chat_id' => $chat_id, 'text' => $result, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } catch (Exception $e) {
        $reply = 'sintak error, alasan ' . PHP_EOL . PHP_EOL . get_class($e) . ', ' . $e->getMessage();
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        // Report error somehow
    }

    // $a_func = file_get_contents(__DIR__ . '/../include/eval_func.php');
    // file_put_contents(__DIR__ . '/evals_fadhil.php', $a_func . PHP_EOL . $udahDiparse);

    // // try {
    // $result = substr(shell_exec("php " . __DIR__ . '/evals_fadhil.php'), 0, 4090);
    // $content = array('chat_id' => $chat_id, 'text' => $result, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    // } catch (ParseError $e) {
    //     $reply = 'sintak error, alasan ' . PHP_EOL . PHP_EOL . $e;
    //     $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    //     $telegram->sendMessage($content);
    //     // Report error somehow
    // }
    // $reply = 'errormes';
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    // $reply = 'errormes';
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
} elseif ($getStringFromSpasi[0] == 'json' || $getStringFromSpasi[0] == 'jsondebug') {
    $result = $telegram->getData();
    $getJsonraw = file_get_contents('php://input');
    $decs = json_decode($getJsonraw);
    $reply = json_encode($decs, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../json_data/json_dump_sudo.txt', $reply);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif ($getStringFromSpasi[0] == 'del' || $getStringFromSpasi[0] == 'd') {
    $result = $telegram->getData();
    $replymessageid = $result['message']['reply_to_message']['message_id'];
    if (isset($replymessageid)) {
        $content = array('chat_id' => $chat_id, 'message_id' => $replymessageid);
        $telegram->deleteMessage($content);
        //hapus pesan sendiri
        $content = array('chat_id' => $chat_id, 'message_id' => $message_id);
        $telegram->deleteMessage($content);
    } else {
    }
} elseif ($getStringFromSpasi[0] == 'ban' || $getStringFromSpasi[0] == 'blacklist' || $getStringFromSpasi[0] == 'block' || $getStringFromSpasi[0] == 'banned') {
    $data = array(
        "id" => $getStringFromSpasi[1],
        "nama" => $getStringFromSpasi[2]
    );
    $id = $db->insert('blacklist_user', $data);
    if ($id) {
        $reply = 'done';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($getStringFromSpasi[0] == 'unban' || $getStringFromSpasi[0] == 'unblock') {
    $db->where('id', $getStringFromSpasi[1]);
    if ($db->delete('blacklist_user')) {
        $reply = 'done';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'error';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
} elseif ($getStringFromSpasi[0] == 'leavechat' || $getStringFromSpasi[0] == 'leave') {
    $content = array('chat_id' => $chat_id);
    $telegram->leaveChat($content);
}
