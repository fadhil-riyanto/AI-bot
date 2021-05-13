<?php
// $reply = $text_plain_nokarakter;
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// die();

require __DIR__ . '/calc_initdb.php';
$calc_split = explode(' ', strtolower($text_plain_nokarakter));
$deteksiid = $calc_db_cache->findOneBy(["userid", "=", (int)$calc_split[1]]);
//deteksi sama dengan
require __DIR__ . '/keyboard.php';
if ($calc_split[2] == '=') {
    $resultnomor = str_replace(' ', '', $deteksiid['stdin_input']);
    $regex = '/([-+]?\d+([-+*\/][-+]?\d+)+)/i';
    preg_match_all($regex, $resultnomor, $matcher);
    $angka = $matcher[0][0];
    eval("\$hsl = $angka;");
    $calc_db_cache->updateById(
        $deteksiid['_id'],
        [
            "stdin_input" => $hsl
        ]
    );
    $hasilbagus = $angka . ' = ' . $hsl;
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'message_id' => $deteksiid['msgid'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $editdebug = $telegram->editMessageText($content);
    die();
} elseif ($calc_split[2] == 'ac') {
    $hsl = null;
    $calc_db_cache->updateById(
        $deteksiid['_id'],
        [
            "stdin_input" => $hsl
        ]
    );
    $hasilbagus = 0;
    $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'message_id' => $deteksiid['msgid'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $editdebug = $telegram->editMessageText($content);
    die();
}
$calc_db_cache->updateById(
    $deteksiid['_id'],
    [
        "stdin_input" => $deteksiid['stdin_input'] . ' ' . $calc_split[2]
    ]
);
$hasilbagus = str_replace(' ', '', $deteksiid['stdin_input']) . ' ' . $calc_split[2];
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'message_id' => $deteksiid['msgid'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$editdebug = $telegram->editMessageText($content);
$deteksiid = $calc_db_cache->findOneBy(["userid", "=", (int)$calc_split[1]]);
die();
