<?php
if ($gc_command_verify == null) {
    $reply = "ups, command ini hanya berlaku di grup saja.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
}
$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db->where('userid', $userID);
$user = $db->getOne("afk_user_data");
if ($user['userid'] == null) {
    $reply = "ups, kamu kan tidak afk...";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    if ($db->delete('afk_user_data')) {
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

        $reply = "anda sudah tidak afk!";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = "ups, anda kan tidak afk...";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
