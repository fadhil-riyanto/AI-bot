<?php
if ($gc_command_verify == null) {
    $reply = "ups, command ini hanya berlaku di grup saja.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
}
date_default_timezone_set(TIME_ZONE);
$result = $telegram->getData();
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("userid", $userID);
    // $user = $db->getOne("afk_user_data");
    $user = $db->row(
        "SELECT * FROM afk_user_data WHERE userid = ?",
        $userID
    );
    if ($user['userid'] == null) {
        $timed = date("H:i:s");
        // $data = array(
        //     "userid" => $userID,
        //     "time_afk" =>  $timed,
        //     "alasan" => 'pengguna ini afk tanpa memberi alasan',
        //     "username" => $usernameBelumdiparse
        // );


        // $id = $db->insert('afk_user_data', $data);
        $id = $db->insert('afk_user_data', [
            "userid" => $userID,
            "time_afk" =>  $timed,
            "alasan" => 'pengguna ini afk tanpa memberi alasan',
            "username" => $usernameBelumdiparse
        ]);
        if ($id) {
            $file = __DIR__ . '/../json_data/afkstatus.json';
            $anggota = file_get_contents($file);
            $datass = json_decode($anggota, true);

            $datass[] = array(
                "userid" => $userID,
                "time_afk" =>  $timed,
                "alasan" => $udahDiparse,
                "username" => $usernameBelumdiparse
            );

            $jsonfile = json_encode($datass, JSON_PRETTY_PRINT);
            $anggota = file_put_contents($file, $jsonfile);

            $reply = "anda sedang afk!" . PHP_EOL . 'gunakan /unafk untuk melepas status afk!';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = "ups ada kesalahan internal. Reason : " . $db->getLastError();
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } else {
        // $data = array(
        //     "userid" => $userID,
        //     "time_afk" =>  date("H:i:s"),
        //     "alasan" => 'pengguna ini afk tanpa memberi alasan',
        //     "username" => $usernameBelumdiparse
        //     // active = !active;
        // );
        // $db->where('userid', $userID);
        $verifupdate = $db->update('afk_user_data', [
            "userid" => $userID,
            "time_afk" =>  date("H:i:s"),
            "alasan" => 'pengguna ini afk tanpa memberi alasan',
            "username" => $usernameBelumdiparse
        ], [
            'userid', $userID
        ]);
        if ($verifupdate) {

            $file = __DIR__ . '/../json_data/afkstatus.json';
            $anggota = file_get_contents($file);
            $datass = json_decode($anggota, true);

            $datass[] = array(
                "userid" => $userID,
                "time_afk" =>  $timed,
                "alasan" => $udahDiparse,
                "username" => $usernameBelumdiparse
            );

            $jsonfile = json_encode($datass, JSON_PRETTY_PRINT);
            $anggota = file_put_contents($file, $jsonfile);
            $reply = "anda sedang afk!" . PHP_EOL . 'gunakan /unafk untuk melepas status afk!';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = "ups, ada kesalahan!. Penyebab : " . $db->getLastError();
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    }
} else {
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("userid", $userID);
    // $user = $db->getOne("afk_user_data");
    $user = $db->row(
        "SELECT * FROM afk_user_data WHERE userid = ?",
        $userID
    );
    if ($user['userid'] == null) {
        $timed = date("H:i:s");
        // $data = array(
        //     "userid" => $userID,
        //     "time_afk" =>  $timed,
        //     "alasan" => $udahDiparse,
        //     "username" => $usernameBelumdiparse
        // );


        // $id = $db->insert('afk_user_data', $data);
        $id = $db->insert('afk_user_data', [
            "userid" => $userID,
            "time_afk" =>  $timed,
            "alasan" => $udahDiparse,
            "username" => $usernameBelumdiparse
        ]);
        if ($id) {
            $file = __DIR__ . '/../json_data/afkstatus.json';
            $anggota = file_get_contents($file);
            $datass = json_decode($anggota, true);

            $datass[] = array(
                "userid" => $userID,
                "time_afk" =>  $timed,
                "alasan" => $udahDiparse,
                "username" => $usernameBelumdiparse
            );

            $jsonfile = json_encode($datass, JSON_PRETTY_PRINT);
            $anggota = file_put_contents($file, $jsonfile);

            $reply = "anda sedang afk!" . PHP_EOL . 'gunakan /unafk untuk melepas status afk!';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = "ups ada kesalahan internal.";
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } else {
        // $data = array(
        //     "userid" => $userID,
        //     "time_afk" =>  date("H:i:s"),
        //     "alasan" => $udahDiparse,
        //     "username" => $usernameBelumdiparse
        //     // active = !active;
        // );
        // $db->where('userid', $userID);
        $verifupdate = $db->update('afk_user_data', [
            "userid" => $userID,
            "time_afk" =>  date("H:i:s"),
            "alasan" => $udahDiparse,
            "username" => $usernameBelumdiparse
        ], [
            'userid', $userID
        ]);
        if ($verifupdate) {

            $file = __DIR__ . '/../json_data/afkstatus.json';
            $anggota = file_get_contents($file);
            $datass = json_decode($anggota, true);

            $datass[] = array(
                "userid" => $userID,
                "time_afk" =>  $timed,
                "alasan" => $udahDiparse,
                "username" => $usernameBelumdiparse
            );

            $jsonfile = json_encode($datass, JSON_PRETTY_PRINT);
            $anggota = file_put_contents($file, $jsonfile);
            $reply = "anda sedang afk!" . PHP_EOL . 'gunakan /unafk untuk melepas status afk!';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = "ups, ada kesalahan!.";
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    }
}
