<?php
$hasilkeluar = $telegram->getData();
$eventsuser_keluar = $hasilkeluar['message']['left_chat_participant'];
$nama_pertama_user_keluar = $hasilkeluar['message']['left_chat_participant']['first_name'];
$nama_akhir_user_keluar = $hasilkeluar['message']['left_chat_participant']['last_name'];
$id_user_keluar = $hasilkeluar['message']['left_chat_participant']['id'];
$username_user_keluar = $hasilkeluar['message']['left_chat_participant']['username'];

if (isset($nama_pertama_user_keluar)) {
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("gid", $chat_id);
    // $user = $db->getOne("grup_data");
    $user = $db->row(
        "SELECT * FROM grup_data WHERE gid = ?",
        $chat_id
    );
    if ($user['set_leaveuser_mode'] == 'true') {
        if ($user['leaveuser_text'] == null) {
            $tagname_html = '<a href="tg://user?id=' . $id_user_keluar . '" >' . $nama_pertama_user_keluar . ' ' . $nama_akhir_user_keluar . '</a>';
            $reply = 'selamat tinggal ' . $tagname_html;
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } elseif ($user['leaveuser_text'] != null) {
            $reply = $user['leaveuser_text'];
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } else {
    }
}
