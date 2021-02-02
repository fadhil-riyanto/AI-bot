<?php
if (detect_grup() == true) {
    $reply = 'Hai ' . $username . ', Maaf, menu ini hanya bisa diakses via PM';
    $option = array(
        //First row
        // array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
        // //Second row 
        // array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
        // //Third row
        array($telegram->buildInlineKeyBoardButton("PM", $url = 'https://t.me/fadhil_riyanto_bot'))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);

    $content = array('chat_id' => $chat_id, 'text' => $reply, 'disable_web_page_preview' => true, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} else {
    $reply = 'Hai ' . $username . ', Selamat datang di buku panduan bot ini';
    $option = array(
        //First row
        array(
            $telegram->buildInlineKeyBoardButton("corona", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot corona'),
            $telegram->buildInlineKeyBoardButton("userid", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot userid')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("waktu", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot waktu'),
            $telegram->buildInlineKeyBoardButton("info", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot info')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("panggil", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot panggil'),
            $telegram->buildInlineKeyBoardButton("start", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot start')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("short", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot short'),
            $telegram->buildInlineKeyBoardButton("tanggal", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot tanggal')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("bug", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot bug'),
            $telegram->buildInlineKeyBoardButton("azan", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot azan')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("donate", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot donate'),
            $telegram->buildInlineKeyBoardButton("gempa", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot gempa')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("help", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot help'),
            $telegram->buildInlineKeyBoardButton("wiki", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot wiki')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("tulis", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot tulis'),
            $telegram->buildInlineKeyBoardButton("get_ip", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_ip')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("get_mx", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_mx'),
            $telegram->buildInlineKeyBoardButton("get_ns", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_ns')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("get_aaaa", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_aaaa'),
            $telegram->buildInlineKeyBoardButton("get_txt", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_txt')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("get_cname", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot cname'),
            $telegram->buildInlineKeyBoardButton("get_github_user", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot get_github_user')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("ip_geo", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ip_geo'),
            $telegram->buildInlineKeyBoardButton("faker", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot faker')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("sha512", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha512'),
            $telegram->buildInlineKeyBoardButton("sha384", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha384')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("sha256", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha256'),
            $telegram->buildInlineKeyBoardButton("sha1", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot sha1')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("md5", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot md5'),
            $telegram->buildInlineKeyBoardButton("md4", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot md4')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("md2", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot md2'),
            $telegram->buildInlineKeyBoardButton("base64_encode", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot base64_encode')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("base64_decode", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot base64_decode'),
            $telegram->buildInlineKeyBoardButton("ripemd128", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd128')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("ripemd160", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd160'),
            $telegram->buildInlineKeyBoardButton("ripemd256", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd256')
        ),
        array(
            $telegram->buildInlineKeyBoardButton("ripemd320", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot ripemd320'),
            $telegram->buildInlineKeyBoardButton("whirlpool", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot whirlpool')
        ), array(
            $telegram->buildInlineKeyBoardButton("capture", $url = "", $callback_data = '/callback_q@fadhil_riyanto_bot capture')

        ),

    );
    $keyb = $telegram->buildInlineKeyBoard($option);

    $file = __DIR__ . "/../json_data/editMsgIDdelete.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID) {
            $idPesan = $d['msgid'];
        }
    }

    $content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $idPesan, 'reply_markup' => $keyb, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $msgUdahDikirim = $telegram->editMessageText($content);
    $msgidUntukedit = $msgUdahDikirim['result']['message_id'];
    $msgPenanda = $msgUdahDikirim['error_code'];
    if ($msgPenanda == 400) {
        $content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $msgUdahDikirim = $telegram->sendMessage($content);
        $msgidUntukedit = $msgUdahDikirim['result']['message_id'];
    }

    function getUseridFromeditmessage($userID)
    {
        $file = __DIR__ . "/../json_data/editMsgID.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $d) {
            if ($d['userid'] == $userID) {
                return true;
            }
        }
    }
    $cheker = getUseridFromeditmessage($userID);
    if ($cheker == true) {
        $file = __DIR__ . "/../json_data/editMsgID.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['userid'] === $userID) {
                $data[$key]['msgid'] = $msgidUntukedit;
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    } elseif ($cheker == null) {
        $file = __DIR__ . "/../json_data/editMsgID.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);

        $data[] = array(
            "userid" => $userID,
            "msgid" => $msgidUntukedit
        );

        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    }
    // $_SESSION['user_' . $userID] = $msgidUntukedit;
    // sleep(10);
    // $reply = 'help diedi';
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'message_id' => $msgidUntukedit, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    // $telegram->editMessageText($content);
    exit;
}
