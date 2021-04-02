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
    $reply = "maaf, anda harus memasukkan kata yang ingin di blokir";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $db->where("chat_id", $chat_id);
    $getDataafku = $db->get("filters_word_data");

    foreach ($getDataafku as $katablock) {
        if (strtolower($udahDiparse) == strtolower($katablock['word'])) {
            $kataada = true;
        }
    }
    if ($kataada == true) {
        $reply = "maaf, kata yang anda masukan telah tersedia di database";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        if (str_word_count($udahDiparse) > 1) {
            $reply = "maaf, anda hanya boleh memasukkan 1 kata saja";
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            ran:
            $required_length = 40;
            $limit_one = rand();
            $limit_two = rand();
            $randomID = @substr(uniqid(sha1(crypt(md5(rand(min($limit_one, $limit_two), max($limit_one, $limit_two)))))), 0, $required_length);

            $db->where("uniq_id", $randomID);
            $user = $db->getOne("filters_word_data");
            if ($user['uniq_id'] == null) {
                $data = array(
                    "chat_id" => $chat_id,
                    "word" =>  $udahDiparse,
                    "uniq_id" => $randomID
                );

                $id = $db->insert('filters_word_data', $data);

                if ($id) {
                    $reply = "kata berhasil ditambahkan ke database!";
                    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                    $telegram->sendMessage($content);
                } else {
                    $reply = "ups ada kesalahan internal. Reason : " . $db->getLastError();
                    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                    $telegram->sendMessage($content);
                }
            } else {
                unset($randomID);
                goto ran;
            }
        }
    }
}
