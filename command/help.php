<?php
if (detect_grup() == true) {
    $reply = 'Hai ' . $username . ', Maaf, menu ini hanya bisa diakses via PM';
    $option = array(
        //First row
        // array($telegram->buildInlineKeyBoardButton("Button 1", $url = "http://link1.com"), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
        // //Second row 
        // array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
        // //Third row
        array($telegram->buildInlineKeyBoardButton("PM", $url = 'http://t.me/' . USERNAME_BOT_NON_AT . '?start=help'))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);

    $content = array('chat_id' => $chat_id, 'text' => $reply, 'disable_web_page_preview' => true, 'reply_markup' => $keyb, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} else {
    require __DIR__ . '/../include/help_menu.php';

    $file = __DIR__ . "/../json_data/editMsgIDdelete.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $key => $d) {
        if ($d['userid'] === $userID) {
            array_splice($data, $key, 1);
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($file, $jsonfile);

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
