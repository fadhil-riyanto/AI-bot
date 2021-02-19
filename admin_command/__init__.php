<?php
if (detect_grup() == true) {
    $delaycached = 20;
    $getlistjsonadmin = __DIR__ . '/../json_data/group_command/adminlist.json';
    function getUseridFromeditmessage($gid)
    {
        global $grupid;
        global $getlistjsonadmin;
        global $chat_id;
        $anggota = file_get_contents($getlistjsonadmin);
        $data = json_decode($anggota, true);
        foreach ($data as $d) {
            if ($d['gid'] == $chat_id) {
                $grupid = $d['gid'];
                return true;
            }
        }
    }
    $cheker = getUseridFromeditmessage($chat_id);
    if ($cheker == true) {
        $anggota = file_get_contents($getlistjsonadmin);
        $data = json_decode($anggota, true);
        foreach ($data as $d) {
            if ($d['gid'] == $grupid) {
                $gidsekarang = $d['gid'];
                $timesekarang = $d['timelapsce'] + $delaycached;
                $timedelay = $timesekarang - time();
                if ($timedelay > 0) {
                    // $reply = 'Maaf, kamu dapat mengirim pesan kembali setelah ' . ($timesekarang - time()) . ' detik';
                    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                    // $telegram->sendMessage($content);

                    $gid =  $d['gid'];
                    $admins =  $d['admin'];
                    exit;
                } elseif ($timedelay < 0) {
                    foreach ($data as $key => $d) {
                        if ($d['gid'] === $grupid) {
                            $content = array('chat_id' => $chat_id);
                            $adminlist = $telegram->getChatAdministrators($content);
                            $endadmin = json_encode($adminlist);
                            $decadmin = json_decode($endadmin, true);
                            foreach ($decadmin['result'] as $adminlists) {
                                $id_admin[] = $adminlists['user']['id'];
                            }
                            $data[$key]['timelapsce'] = time() + $delaycached;
                            $data[$key]['admin'] = $id_admin;

                            //get data
                            $gid =  $d['gid'];
                            $admins =  $d['admin'];
                        }
                    }
                    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                    $anggota = file_put_contents($getlistjsonadmin, $jsonfile);
                }
            }
        }
    } elseif ($cheker == null) {
        $anggota = file_get_contents($getlistjsonadmin);
        $data = json_decode($anggota, true);
        //update admin
        $content = array('chat_id' => $chat_id);
        $adminlist = $telegram->getChatAdministrators($content);
        $endadmin = json_encode($adminlist);
        $decadmin = json_decode($endadmin, true);
        foreach ($decadmin['result'] as $adminlists) {
            $id_admin[] = $adminlists['user']['id'];
        }

        $data[] = array(
            "gid" => $chat_id,
            "timelapsce" => time() + $delaycached,
            "admin" => $id_admin
        );

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($getlistjsonadmin, $jsonfile);

        $gid =  $chat_id;
        $admins =  $id_admin;
    }
} else {
}

function is_admin_grup($userID)
{
    global $admins;
    foreach ($admins as $adminss) {
        if ($adminss == $userID) {
            return true;
        }
    }
}
$isadmin = is_admin_grup($userID);
if ($isadmin == true) {
    $kamu_admin = true;
} else {
    if ($adanParse[0] == '/pin' || $adanParse[0] == '/unpin') {
        $kamu_admin = false;
        $reply = 'ups, kamu bukan admin';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
    }
}

//require all
$adanParseadmin = explode(' ', $text);
if ($adanParseadmin[0] == '/pin') {
    require 'pin.php';
} elseif ($adanParseadmin[0] == '/unpin') {
    require 'unpin.php';
}
