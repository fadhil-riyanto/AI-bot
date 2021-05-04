<?php
// $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// $db->where("gid", $chat_id);
// $user = $db->getOne("grup_data");
$user = $db->row(
    "SELECT * FROM grup_data WHERE gid = ?",
    $chat_id
);
if ($user['welcome_text'] == null) {
    $reply = 'Halo, apa kabar mu?';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
} else {
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("gid", $chat_id);
    // $user = $db->getOne("grup_data");
    if ($user['welcome_text'] == null) {
        $reply = 'Halo, apa kabar mu?';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $memberanyarpertama = $namaPertama;
        $memberanyarkedua = $namaTerakhir;
        $memberanyarid = $userID;

        $memberbaruname = '<a href="tg://user?id=' . $memberanyarid . '" >' . $memberanyarpertama . ' ' . $memberanyarkedua . '</a>';
        function parsewelcome($string)
        {
            global $memberbaruname;
            global $memberanyarpertama;
            global $memberanyarpertama;
            global $memberanyarid;
            $dict = array(
                '[[username]]' => $memberbaruname,
                '[[first]]' => $memberanyarpertama,
                '[[last]]' => $memberanyarpertama,
                '[[id]]' => $memberanyarid

                // replace teks lainnya disini
            );
            return strtolower(
                str_replace(
                    array_keys($dict),
                    array_values($dict),
                    $string
                )
            );
        }
        $reply = parsewelcome($user['welcome_text']);
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
