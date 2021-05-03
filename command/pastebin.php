<?php

function generateRandomString($req)
{
    $required_length = $req;
    $limit_one = rand();
    $limit_two = rand();
    $randomID = @substr(
        uniqid(
            sha1(
                crypt(
                    md5(
                        rand(
                            min($limit_one, $limit_two),
                            max($limit_one, $limit_two)
                        )
                    ),
                    "rl"
                )
            )
        ),
        0,
        $required_length
    );
    return $randomID;
}


$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if ($azanHilangcommand == null) {
    $reply = "ups, anda harus memasukkan teks yang ingin dijadikan paste.";
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    if (strlen($udahDiparse) > 4094) {
        $reply = "ups, jumlah karakter diperbolehkan hanya 4096 huruf.";
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        exit;
    }
    pastelink:
    $paste_id = generateRandomString(10);
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("paste_id", $paste_id);
    // $user = $db->getOne("pastebin");

    if ($db_error_koneksi === true) {
        $reply = EXCEPTION_SYSTEM_ERROR_MESSAGE;
        $option = array(
            array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = SUPPORT_GROUP))
        );
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
        throw new Exception("DB pastebin error");
        die();
    }

    if ($user['data'] == null) {
        //$db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // $data = array(
        //     "userid" => $userID,
        //     "paste_id" =>  $paste_id,
        //     "data" => $udahDiparse
        // );
        // $id = $db->insert('pastebin', $data);
        $id = $db->insert('pastebin', [
            "userid" => $userID,
            "paste_id" =>  $paste_id,
            "data" => $udahDiparse
        ]);
        if ($id) {
            $reply = "yay, link pastebin telegram kamu https://t.me/" . USERNAME_BOT_NON_AT . '?start=ps_' . $paste_id;
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        } else {
            $reply = EXCEPTION_SYSTEM_ERROR_MESSAGE;
            $option = array(
                array($telegram->buildInlineKeyBoardButton("👥 Support Group", $url = SUPPORT_GROUP))
            );
            $keyb = $telegram->buildInlineKeyBoard($option);
            $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            $telegram->sendMessage($content);
        }
    } else {
        goto pastelink;
    }
}
