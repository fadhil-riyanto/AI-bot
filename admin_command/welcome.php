<?php
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where("gid", $chat_id);
$user = $db->getOne("grup_data");
if ($user['welcome_text'] == null) {
    $reply = 'Halo, apa kabar mu?';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    if ($adanParseadmin[1] == 'on') {
        $data = array(
            'welcome_set' => 'true',
        );
        $db->where('gid', $chat_id);
        if ($db->update('grup_data', $data)) {
            $reply = 'pesan selamat datang dinyalakan';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = 'update failed: ' . $db->getLastError();
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } elseif ($adanParseadmin[1] == 'off') {
        $data = array(
            'welcome_set' => 'false',
        );
        $db->where('gid', $chat_id);
        if ($db->update('grup_data', $data)) {
            $reply = 'pesan selamat datang dimatikan';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = 'update failed: ' . $db->getLastError();
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    }

    $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db->where("gid", $chat_id);
    $user = $db->getOne("grup_data");
    if ($user['welcome_text'] == null) {
        $reply = 'Halo, apa kabar mu?';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $memberanyarpertama = $namaPertama;
        $memberanyarkedua = $namaTerakhir;
        $memberanyarid = $userID;

        $memberbaruname = '<a href="tg://user?id=' . $memberanyarid . '" >' . $memberanyarpertama . ' ' . $memberanyarkedua . '</a>';
        function parsewelcome($string)
        {
            global $memberbaruname;
            global $memberanyarpertama;
            global $memberanyarpertama;
            global $memberanyarid;
            $dict = array(
                '[[username]]' => $memberbaruname,
                '[[first]]' => $memberanyarpertama,
                '[[last]]' => $memberanyarpertama,
                '[[id]]' => $memberanyarid

                // replace teks lainnya disini
            );
            return strtolower(
                str_replace(
                    array_keys($dict),
                    array_values($dict),
                    $string
                )
            );
        }
        $reply = parsewelcome($user['welcome_text']);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
