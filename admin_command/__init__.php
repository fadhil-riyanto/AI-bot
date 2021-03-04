<?php

function deteksi_grup()
{
    global $chat_id;
    $pregs = substr($chat_id, 0, 1);
    if ($pregs == '-') {
        return true;
    }
}
if (deteksi_grup() == true) {
    $delaycached = 20;
    $getlistjsonadmin = __DIR__ . '/../json_data/group_command/adminlist.json';
    function getUseridFromeditmessageinit($chat_id)
    {
        global $grupid;
        global $getlistjsonadmin;
        $anggota = file_get_contents($getlistjsonadmin);
        $data = json_decode($anggota, true);
        foreach ($data as $d) {
            if ($d['gid'] == $chat_id) {
                $grupid = $d['gid'];
                return true;
            }
        }
    }
    $cheker = getUseridFromeditmessageinit($chat_id);
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
                    //exit;
                } elseif ($timedelay < 0) {
                    foreach ($data as $key => $d) {
                        if ($d['gid'] == $grupid) {
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
                            $admins =  $id_admin;
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
    if (
        $adanParse[0] == '/pin' || $adanParse[0] == '/unpin' || $adanParse[0] == '/adminlist' ||
        $adanParse[0] == '/set_welcome' || $adanParse[0] == '/test_welcome' || $adanParse[0] == '/set_chapcha_mode' ||
        $adanParse[0] == '/set_goodbye' || $adanParse[0] == '/set_welcome_mode' || $adanParse[0] == '/set_goodbye_mode' ||
        $adanParse[0] == '/set_rules' || $adanParse[0] == '/promote' || $adanParse[0] == '/demote' || $adanParse[0] == '/clear_rules' ||
        $adanParse[0] == '/admin_mode'
    ) {
        $reply = 'Maaf, command ini hanya berlaku di grup saja';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
    exit;
}

function is_admin_grup($userID)
{
    global $admins;
    foreach ($admins as $adminss) {
        if ($adminss == $userID) {
            return true;
        }
    }
    return false;
}
$isadmin = is_admin_grup($userID);
if ($isadmin == true) {
    $kamu_admin = true;
} elseif ($isadmin == false) {
    $kamu_admin = false;
}

if ($kamu_admin == true) {
    $adanParseadmin = explode(' ', $text);
    if ($adanParseadmin[0] == '/pin') {
        require 'pin.php';
    } elseif ($adanParseadmin[0] == '/unpin') {
        require 'unpin.php';
    } elseif ($adanParseadmin[0] == '/adminlist') {
        require 'adminlist.php';
    } elseif ($adanParseadmin[0] == '/set_welcome') {
        require 'set_welcome.php';
    } elseif ($adanParseadmin[0] == '/test_welcome') {
        require 'test_welcome.php';
    } elseif ($adanParseadmin[0] == '/set_chapcha_mode') {
        require 'set_chapcha_mode.php';
    } elseif ($adanParseadmin[0] == '/set_goodbye') {
        require 'set_goodbye.php';
    } elseif ($adanParseadmin[0] == '/set_welcome_mode') {
        require 'set_welcome_mode.php';
    } elseif ($adanParseadmin[0] == '/set_goodbye_mode') {
        require 'set_goodbye_mode.php';
    } elseif ($adanParseadmin[0] == '/set_rules') {
        require 'set_rules.php';
    } elseif ($adanParseadmin[0] == '/promote') {
        require 'promote.php';
    } elseif ($adanParseadmin[0] == '/demote') {
        require 'demote.php';
    } elseif ($adanParseadmin[0] == '/clear_rules') {
        require 'clear_rules.php';
    } elseif ($adanParseadmin[0] == '/admin_mode') {
        require 'admin_mode.php';
    }
} elseif ($kamu_admin == false) {
    if (
        $adanParse[0] == '/pin' || $adanParse[0] == '/unpin' || $adanParse[0] == '/adminlist' ||
        $adanParse[0] == '/set_welcome' || $adanParse[0] == '/test_welcome' || $adanParse[0] == '/set_chapcha_mode' ||
        $adanParse[0] == '/set_goodbye' || $adanParse[0] == '/set_welcome_mode' || $adanParse[0] == '/set_goodbye_mode' ||
        $adanParse[0] == '/set_rules' || $adanParse[0] == '/promote' || $adanParse[0] == '/demote' || $adanParse[0] == '/clear_rules' ||
        $adanParse[0] == '/admin_mode'
    ) {
        $reply = 'ups, kamu bukan admin';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
//require all
