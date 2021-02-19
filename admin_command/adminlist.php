<?php
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($azanHilangcommand == null) {
    $content = array('chat_id' => $chat_id);
    $admin_data = $telegram->getChatAdministrators($content);
    foreach ($admin_data['result'] as $adminlist) {
        $daftaradmin = $adminlist['user']['id'];
        $namaadmindepan = $adminlist['user']['first_name'];
        $namaadminblakang = $adminlist['user']['last_name'];
        $fully[] = '<a href="tg://user?id=' . $daftaradmin . '" >' . $namaadmindepan . ' ' . $namaadminblakang . '</a>';
    }
    $reply = implode(PHP_EOL, $fully);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $content = array('chat_id' => $udahDiparse);
    $konformasi = $admin_data = $telegram->getChatAdministrators($content);
    foreach ($admin_data['result'] as $adminlist) {
        $daftaradmin = $adminlist['user']['id'];
        $namaadmindepan = $adminlist['user']['first_name'];
        $namaadminblakang = $adminlist['user']['last_name'];
        $fully[] = '<a href="tg://user?id=' . $daftaradmin . '" >' . $namaadmindepan . ' ' . $namaadminblakang . '</a>';
    }
    $reply = implode(PHP_EOL, $fully);
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    if ($konformasi['ok'] == false) {
        $reply = 'ups, tidak ditemukan';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $konformasi = $telegram->sendMessage($content);
    } else {
    }
}
