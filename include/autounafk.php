<?php
function deteksi_grupP()
{
    global $chat_id;
    $pregs = substr($chat_id, 0, 1);
    if ($pregs == '-') {
        return true;
    }
}
if (deteksi_grupP() == true) {
    $delaycached = 20;
    $getlistjsonadmin = __DIR__ . '/../json_data/afkstatus.json';
    function GETuseridafk($userID)
    {
        global $getlistjsonadmin, $timed, $alasan, $uid_afk;
        $anggota = file_get_contents($getlistjsonadmin);
        $data = json_decode($anggota, true);
        foreach ($data as $d) {
            if ($d['userid'] == $userID) {
                $uid_afk = $d['userid'];
                $timed = $d['time_afk'];
                $alasan = $d['alasan'];
                return true;
            }
        }
        return false;
    }

    $cekher = GETuseridafk($getreplyianid);
    $cekher_diri = GETuseridafk($userID);
    if ($cekher_diri == true) {
        $reply = "anda sudah tidak afk";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);

        $file = __DIR__ . '/../json_data/afkstatus.json';
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);

        foreach ($data as $key => $d) {
            if ($d['userid'] === $userID) {
                array_splice($data, $key, 1);
            }
        }

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);

        $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $db->where('userid', $userID);
        $user = $db->getOne("afk_user_data");

        $db->delete('afk_user_data');
        exit;
    }
    if ($cekher == true) {
        $reply = "Maaf ," . $afkforstname . ' ' . $afklastname . ' sedang AFK sejak ' . $timed . PHP_EOL .
            'Alasan : ' . $alasan;
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } elseif ($cekher == false) {
        if (isset($getreplyianid)) {
            $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $db->where("userid", $getreplyianid);
            $user = $db->getOne("afk_user_data");
            if ($user['userid'] == null) {
            } else {
                if ($getreplyianid == $userID) {
                    if (substr($text_plain_nokarakter, 0, 1) == '/') {
                    } else {
                        exit;
                    }
                } else {
                    //disini update dan edit json

                    // Mengencode data menjadi json
                    $file = __DIR__ . '/../json_data/afkstatus.json';
                    $anggota = file_get_contents($file);
                    $data = json_decode($anggota, true);

                    $data[] = array(
                        'userid'     => $user['userid'],
                        'time_afk'   => $user['time_afk'],
                        'alasan' => $user['alasan'],
                        'username' => $user['username']
                    );

                    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                    $anggota = file_put_contents($file, $jsonfile);

                    $reply = "Maaf ," . $afkforstname . ' ' . $afklastname . ' sedang AFK sejak ' . $user['time_afk'] . PHP_EOL .
                        'Alasan : ' . $user['alasan'];
                    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                    $telegram->sendMessage($content);
                    exit;
                }
            }
        } else {
        }
    }
}
