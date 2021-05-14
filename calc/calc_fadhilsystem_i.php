<?php
// $reply = $text_plain_nokarakter;
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);
// die();

require __DIR__ . '/calc_initdb.php';
$calc_split = explode(' ', strtolower($text_plain_nokarakter));
if ($calc_split[1] != $userID) {
    $jawabquery = $telegram->getData();
    $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'maaf, anda tidak bisa menekan tombol ini', 'show_alert' => true);
    $telegram->answerCallbackQuery($alswecl);
    die();
}
$deteksiid = $calc_db_cache->findOneBy(["userid", "=", (int)$calc_split[1]]);

// $reply = json_encode($deteksiid);
// $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
// $telegram->sendMessage($content);

//deteksi sama dengan
require __DIR__ . '/keyboard.php';
if ($calc_split[2] == '=') {
    $resultnomor = str_replace(' ', '', $deteksiid['stdin_input']);
    $regex = '/([-+]?\d+([-+*\/][-+]?\d+)+)/i';
    preg_match_all($regex, $resultnomor, $matcher);
    $angka = $matcher[0][0];
    try {

        eval("\$hsl = $angka;");
        $calc_db_cache->updateById(
            $deteksiid['_id'],
            [
                "stdin_input" => $hsl
            ]
        );
    } catch (\Throwable $th) {
        $hsl_expected = 'inputan tidak valid';
        $calc_db_cache->updateById(
            $deteksiid['_id'],
            [
                "stdin_input" => null
            ]
        );
        //throw $th;
    }


    if (isset($hsl_expected)) {
        $hasilbagus = $hsl_expected;
        $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'message_id' => $deteksiid['msgid'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $editdebug = $telegram->editMessageText($content);
    } else {
        $hasilbagus = str_replace(' ', '', $angka . ' = ' . $hsl);
        $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'message_id' => $deteksiid['msgid'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
        $editdebug = $telegram->editMessageText($content);
    }

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
$hasilbagus = str_replace(' ', '', $deteksiid['stdin_input'] . ' ' . $calc_split[2]);
$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'message_id' => $deteksiid['msgid'], 'text' => $hasilbagus, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
$editdebug = $telegram->editMessageText($content);
$deteksiid = $calc_db_cache->findOneBy(["userid", "=", (int)$calc_split[1]]);
die();
