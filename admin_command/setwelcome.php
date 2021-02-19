<?php
require __DIR__ . '/../include/parse_welcome.php';
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($azanHilangcommand == null) {
    $reply = 'isikan parameter!!';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    $jsondatagruplist = __DIR__ . '/../json_data/group_command/adminlist.json';
    $data = json_decode($anggota, true);
    foreach ($data as $key => $d) {
        // Perbarui data kedua
        if ($d['gid'] === $chat_id) {
            $data[$key]['welcometext'] = $udahDiparse;
        }
    }
    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
    $anggota = file_put_contents($jsondatagruplist, $jsonfile);
}
