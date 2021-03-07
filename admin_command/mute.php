<?php


function time_ai($text)
{
    $arr = preg_split('#(?<=\d)(?=[a-z])#i', $text);
    if (is_numeric($arr[0])) {
    } else {
        $arr = preg_split('#(?<=\d) (?=[a-z])#i', $text);
    }
    if (isset($arr[1])) {
        if ($arr[1] == 'm') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'minute') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'menit') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'minit') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'mins') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'min') {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        } elseif ($arr[1] == 'j') {
            $mentah1 = array('time' => $arr[0], 'type' => 'hours');
        } elseif ($arr[1] == 'jam') {
            $mentah1 = array('time' => $arr[0], 'type' => 'hours');
        } elseif ($arr[1] == 'h') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        } elseif ($arr[1] == 'hari') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        } elseif ($arr[1] == 'day') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        } elseif ($arr[1] == 'd') {
            $mentah1 = array('time' => $arr[0], 'type' => 'day');
        }
    } else {
        if ($arr[0] == 'u') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'inf') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'selamanya') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'tanpa batas') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'unlimited') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } elseif ($arr[0] == 'gaada batas') {
            $mentah1 = array('time' => null, 'type' => 'infinity');
        } else {
            $mentah1 = array('time' => $arr[0], 'type' => 'minute');
        }
        //$mentah1 = array('time' => $arr[0], 'type' => 'minute');
    }
    if ($mentah1['time'] == null && $mentah1['type'] == 'infinity') {
        return null;
    } elseif ($mentah1['time'] != null && $mentah1['type'] != 'infinity') {
        if ($mentah1['type'] == 'minute') {
            $timeunik = $mentah1['time'] * 60;
        } elseif ($mentah1['type'] == 'hours') {
            $timeunik = $mentah1['time'] * 60 * 60;
        } elseif ($mentah1['type'] == 'day') {
            $timeunik = $mentah1['time'] * 60 * 60 * 24;
        }
    }

    return time() + $timeunik;
}



$tgpromote = $telegram->getData();
$promote_uid = $tgpromote['message']['reply_to_message']['from']['id'];
$fname_depan = $tgpromote['message']['reply_to_message']['from']['first_name'];
$lname_blakang = $tgpromote['message']['reply_to_message']['from']['last_name'];

$unamepromote = '<a href="tg://user?id=' . $promote_uid . '">' . $fname_depan . ' ' . $lname_blakang . '</a>';

$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);

// $reply = time_ai($udahDiparse);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// exit;
if (isset($promote_uid) && isset($udahDiparse)) {
    $waktu_mute = time_ai($udahDiparse);
    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid,
        'permissions' => '{"can_send_messages": false}',
        'until_date' => $waktu_mute
    );
    $param_jadi = http_build_query($param_promote);
    $req_params = 'https://api.telegram.org/bot' . TG_HTTP_API . '/restrictChatMember?' . $param_jadi;
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $req_params);

    //debug
    $reply = $unamepromote . ', dimute sampai ' . date('Y-m-d h:i:s', $waktu_mute);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} elseif (isset($promote_uid) == true && isset($udahDiparse) == false) {
    $param_promote = array(
        'chat_id' => $chat_id,
        'user_id' => $promote_uid,
        'permissions' => '{"can_send_messages": false}',
        'until_date' => time() + 300
    );
    $param_jadi = http_build_query($param_promote);
    $req_params = 'https://api.telegram.org/bot' . TG_HTTP_API . '/restrictChatMember?' . $param_jadi;
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', $req_params);

    //debug
    $reply = $unamepromote . ', dimute selama 5 menit.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {

    $reply = 'ups, anda harus mereply user yang ingin dimute.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
}
