<?php
require __DIR__ . '/../include/parse_welcome.php';
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($azanHilangcommand == null) {
    $reply = 'ups, anda harus memasukkan pesan selamat datang.';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    //$q = mysqli_query($koneksi, "SELECT * FROM `grup_data` WHERE `gid` LIKE '$udahDiparse' ");
    //$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("gid", $chat_id);
    // $user = $db->getOne("grup_data");
    $user = $db->row(
        "SELECT * FROM grup_data WHERE gid = ?",
        $chat_id
    );
    if ($user['gid'] == null) {
        // $data = array(
        //     'gid' => $chat_id,
        //     'welcome_text' => $udahDiparse,
        // );
        // $id = $db->insert('grup_data', $data);
        $id = $db->update('grup_data', [
            'welcome_text' => $udahDiparse,
        ], [
            'gid' => $chat_id
        ]);
        if ($id) {
            $reply = 'pesan selamat datang telah disimpan';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = 'update error';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } else {
        // $data = array(
        //     'gid' => $chat_id,
        //     'welcome_text' => $udahDiparse,
        //     // active = !active;
        // );
        // $db->where('gid', $chat_id);
        $id = $db->update('grup_data', [
            'welcome_text' => $udahDiparse,
        ], [
            'gid' => $chat_id
        ]);
        if ($id) {
            $reply = 'pesan selamat datang telah diubah';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = 'update error';
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    }
}
