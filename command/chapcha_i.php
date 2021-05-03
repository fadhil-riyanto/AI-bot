<?php
//$azanHilangcommand = str_replace($adanParse_plain_nokarakter[0], '', $text_plain_nokarakter);

$parsedata = explode(' ', $text_plain_nokarakter);
function getUseridFromeditmessage($userID)
{
    global $chat_id;
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID && $d['chatid'] == $chat_id) {
            return true;
        }
    }
}
$verifikasichapcha = getUseridFromeditmessage($parsedata[1]);
if ($verifikasichapcha == true) {
    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
    $anggota = file_get_contents($file);
    $data = json_decode($anggota, true);
    foreach ($data as $d) {
        if ($d['userid'] == $userID && $d['chatid'] == $chat_id) {
            if ($d['percobaan'] > 3) {
                $content = array('chat_id' => $chat_id, 'message_id' => $d['msgid']);
                $msgUdahDikirim = $telegram->deleteMessage($content);

                $reply = 'ups, ' . $username . ' gagal memecahkan chapcha';
                $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                $telegram->sendMessage($content);

                //banned
                $ban = array('chat_id' => $chat_id, 'user_id' => $userID);
                $telegram->kickChatMember($ban);

                $ban = array('chat_id' => $chat_id, 'user_id' => $userID);
                $telegram->unbanChatMember($ban);

                $anggota = file_get_contents($file);
                $data = json_decode($anggota, true);
                foreach ($data as $key => $d) {
                    if ($d['userid'] === $userID) {
                        array_splice($data, $key, 1);
                    }
                }
                $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                $anggota = file_put_contents($file, $jsonfile);
            } else {
                if ($parsedata[2] == $d['pharse']) {

                    $content = array('chat_id' => $chat_id, 'message_id' => $d['msgid']);
                    $msgUdahDikirim = $telegram->deleteMessage($content);

                    $permissionchat = '{
                        "can_send_messages": true,
                        "can_send_media_messages": true,

                        "can_send_polls": true,
                        "can_send_other_messages": true,
                        "can_add_web_page_previews": true,
                        "can_change_info": false,
                        "can_invite_users": true,
                        "can_pin_messages": false
                    }';
                    $restik = array('chat_id' => $chat_id, 'user_id' => $userID, 'permissions' => $permissionchat);
                    $telegram->restrictChatMember($restik);

                    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                    // $db->where("gid", $chat_id);
                    // $user = $db->getOne("grup_data");
                    $user = $db->row(
                        "SELECT * FROM grup_data WHERE gid = ?",
                        $chat_id
                    );

                    if ($user['welcome_text'] == null) {
                        $reply = 'Halo, apa kabar mu?';
                        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                        $telegram->sendMessage($content);
                    } else {
                        $result = $telegram->getData();
                        $memberanyarpertama = $d['first_name'];
                        $memberanyarkedua = $d['last_name'];
                        $memberanyarid = $d['userid'];

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
                        $content = array('chat_id' => $chat_id, 'text' => $reply, 'parse_mode' => 'html');
                        $telegram->sendMessage($content);
                    }




                    $anggota = file_get_contents($file);
                    $data = json_decode($anggota, true);
                    foreach ($data as $key => $d) {
                        if ($d['userid'] === $userID) {
                            array_splice($data, $key, 1);
                        }
                    }
                    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                    $anggota = file_put_contents($file, $jsonfile);

                    //hapus record json
                } elseif ($parsedata[2] != $d['pharse']) {
                    $file = __DIR__ . "/../json_data/chapcha_new_member.json";
                    $anggota = file_get_contents($file);
                    $data = json_decode($anggota, true);
                    foreach ($data as $key => $d) {
                        if ($d['userid'] === $userID) {
                            $data[$key]['percobaan'] = $d['percobaan'] + 1;
                        }
                    }
                    $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                    $anggota = file_put_contents($file, $jsonfile);

                    $jawabquery = $telegram->getData();
                    $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'ups, kamu salah', 'show_alert' => true);
                    $telegram->answerCallbackQuery($alswecl);
                }
            }
        } elseif ($d['userid'] != $userID) {
            // $jawabquery = $telegram->getData();
            // $alswecl = array('callback_query_id' => $jawabquery['callback_query']['id'], 'text' => 'ups, chapcha ini bukan untuk anda', 'show_alert' => true);
            // $telegram->answerCallbackQuery($alswecl);
        }
    }
}
