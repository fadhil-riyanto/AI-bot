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

    //cek apakah bot ini admin!
    // $checkadmin_get_jsonnya = json_decode(file_get_contents(__DIR__ . '/../json_data/group_command/adminlist.json'), true);
    // foreach ($checkadmin_get_jsonnya as $check_json) {
    //     if ($d['gid'] == $chat_id) {
    //         $arrs_kembalian_json = $d['admin'];
    //     }
    // }

    // $reply = '[DEBUG_FADHIL_BOT_FRAMEWORK] return 1, bot is admin';
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    $daftarcommandadmin = [
        '/pin', '/unpin',
        '/set_welcome', '/test_welcome', '/set_chapcha_mode',
        '/set_goodbye', '/set_welcome_mode', '/set_goodbye_mode',
        '/set_rules', '/promote', '/demote', '/clear_rules',
        '/admin_mode', '/unpinall', '/mute', '/set_admin_title',
        '/unmute', '/ban', '/sban', '/kick',
        '/skick', '/unban', '/init', '/addword',
        '/delword', '/filter_action_mode',
        '/filter_action', '/filter_notify'
    ];
    $explode_key_admin = explode("@", $adanParse_lowercase[0]);
    foreach ($daftarcommandadmin as $daftarcommandadmin_s) {
        if ($daftarcommandadmin_s == $explode_key_admin[0]) {
            $command_ditemukan_admin = true;
        }
    }
    $getlistjsonadmin = __DIR__ . '/../json_data/group_command/adminlist.json';



    //die();

    $delaycached = 20;
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
                            if ($d['admin'] == null) {
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
                            } else {
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
    $apakah_bot_ini_admin = json_decode(file_get_contents($getlistjsonadmin));
    foreach ($apakah_bot_ini_admin as $ngecekadmin_adminfor) {
        if ($ngecekadmin_adminfor->gid == $chat_id) {
            $listadmin_arrays = $ngecekadmin_adminfor->admin;
        }
    }
    foreach ($listadmin_arrays as $apakah_admin) {
        if ($apakah_admin == ID_BOT) {
            $bot_adalah_admin = true;
        }
    }
    if ($command_ditemukan_admin == true) {
        if ($bot_adalah_admin != true) {
            $reply = 'maaf, saya tidak bisa melakukan aksi yang anda perintahkan karna saya bukan admin grup ini.';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
            die();
        } else {
        }
    }
} else {
    if (
        $command_ditemukan_admin == true
    ) {
        $reply = 'Maaf, command ini hanya berlaku di grup saja';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
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
} elseif ($userID == $userid_pemilik) {
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
    } elseif ($adanParseadmin[0] == '/unpinall') {
        require 'unpinall.php';
    } elseif ($adanParseadmin[0] == '/unpinall') {
        require 'unpinall.php';
    } elseif ($adanParseadmin[0] == '/mute') {
        require 'mute.php';
    } elseif ($adanParseadmin[0] == '/set_admin_title') {
        require 'set_admin_title.php';
    } elseif ($adanParseadmin[0] == '/unmute') {
        require 'unmute.php';
    } elseif ($adanParseadmin[0] == '/ban') {
        require 'ban.php';
    } elseif ($adanParseadmin[0] == '/sban') {
        require 'sban.php';
    } elseif ($adanParseadmin[0] == '/kick') {
        require 'kick.php';
    } elseif ($adanParseadmin[0] == '/skick') {
        require 'skick.php';
    } elseif ($adanParseadmin[0] == '/unban') {
        require 'unban.php';
    } elseif ($adanParseadmin[0] == '/init') {
        require 'init.php';
    } elseif ($adanParseadmin[0] == '/addword') {
        require 'addword.php';
    } elseif ($adanParseadmin[0] == '/delword') {
        require 'delword.php';
    } elseif ($adanParseadmin[0] == '/filter_action_mode') {
        require 'filter_action_mode.php';
    } elseif ($adanParseadmin[0] == '/filter_action') {
        require 'filter_action.php';
    } elseif ($adanParseadmin[0] == '/filter_notify') {
        require 'filter_notify.php';
    }
} elseif ($kamu_admin == false) {
    if (
        $command_ditemukan_admin == true

    ) {
        $reply = 'ups, kamu bukan admin';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
//require all
