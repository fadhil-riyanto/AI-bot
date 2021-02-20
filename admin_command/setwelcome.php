<?php
require __DIR__ . '/../include/parse_welcome.php';
$azanHilangcommand = str_replace($adanParse_plain[0], '', $text_plain);
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($azanHilangcommand == null) {
    $reply = 'isikan parameter!!';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    //$q = mysqli_query($koneksi, "SELECT * FROM `grup_data` WHERE `gid` LIKE '$udahDiparse' ");
    if ($koneksi === false) {
        $reply = 'ups, fitur ini sedang tidak tersedia karna mysql mati';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
    }

    // Attempt insert query execution
    $sql = "SELECT * FROM `grup_data` WHERE `gid` LIKE '$chat_id'";
    $query = mysqli_query($koneksi, $sql);
    $tes_jumlah_row = @mysqli_affected_rows($koneksi);
    $grupdata = mysqli_fetch_assoc($query);


    if ($tes_jumlah_row > 0) {
        $sql = "UPDATE `grup_data` SET `gid`='$c' WHERE  `data_key_ai`='$hhh' AND `data_res_ai`='hmhm' LIMIT 1";
        $query = mysqli_query($koneksi, $sql);
    }
}
