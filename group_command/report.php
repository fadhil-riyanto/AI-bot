<?php
$content = array('chat_id' => $chat_id);
$admin_data = $telegram->getChatAdministrators($content);
foreach ($admin_data['result'] as $adminlist) {
    $daftaradmin = $adminlist['user']['id'];
    $namaadmindepan = $adminlist['user']['first_name'];
    $namaadminblakang = $adminlist['user']['last_name'];
    $fully[] = '<a href="tg://user?id=' . $daftaradmin . '" >' . $namaadmindepan . ' ' . $namaadminblakang . '</a>';
}
$reply = 'Admin tolong dibantu yak, saya tag orang nya' . PHP_EOL . implode(PHP_EOL, $fully);
$content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
