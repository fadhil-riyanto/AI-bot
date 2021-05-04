<?php

use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;

$memberanyar = $telegram->member_baru();

$result = $telegram->getData();
$memberanyarpertama = $result['message']['new_chat_member']['first_name'];
$memberanyarkedua = $result['message']['new_chat_member']['last_name'];
$memberanyarid = $result['message']['new_chat_member']['id'];
//$memberanyar = true;
if (isset($memberanyar)) {
    if ($usernameBelumdiparse == ID_BOT) {
        exit;
    }
    function generateRandomStringgg($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $randommmmmmmmm = generateRandomStringgg();
    // $db = new MysqliDb(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // $db->where("gid", $chat_id);
    // $user = $db->getOne("grup_data");
    $user = $db->row(
        "SELECT * FROM grup_data WHERE gid = ?",
        $chat_id
    );
    if ($user['set_welcome_mode'] == 'true') {
        if ($user['captcha'] == 'true') {

            $permissionchat = '{"can_send_messages": false}';
            $restik = array('chat_id' => $chat_id, 'user_id' => $userID, 'permissions' => $permissionchat, 'until_date' => time() + 20);
            $telegram->restrictChatMember($restik);

            $phraseBuilder = new PhraseBuilder(4, '0123456789');
            $builder = new CaptchaBuilder(null, $phraseBuilder);
            $builder->build($width = 300, $height = 80, $font = null);
            $builder->save(__DIR__ . '/../tmp/' . $randommmmmmmmm . '.jpg');

            function random_angka_digit($digits)
            {
                return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            }

            $jawabanchapcha = $builder->getPhrase();

            //JSON penyimpanan



            //Keyboard ===================================
            //generate randomm angka
            $numrandkeyboard1 = random_angka_digit(4);
            $numrandkeyboard2 = random_angka_digit(4);
            $numrandkeyboard3 = random_angka_digit(4);
            $numrandkeyboard4 = random_angka_digit(4);
            $numrandkeyboard5 = random_angka_digit(4);
            $numrandkeyboard6 = random_angka_digit(4);
            $numrandkeyboard7 = random_angka_digit(4);
            $numrandkeyboard8 = random_angka_digit(4);
            $numrandkeyboard9 = random_angka_digit(4);

            $keylist_chapcha_atas0 = array(
                $telegram->buildInlineKeyBoardButton($numrandkeyboard1, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard1),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard2, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard2),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard3, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard3),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard4, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard4),
                $telegram->buildInlineKeyBoardButton($jawabanchapcha, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $jawabanchapcha)
            );
            $keylist_chapcha_atas1 = array(
                $telegram->buildInlineKeyBoardButton($numrandkeyboard5, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard5),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard6, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard6),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard7, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard7),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard8, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard8),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard9, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard9)
            );

            $keylist_chapcha_bawah0 = array(
                $telegram->buildInlineKeyBoardButton($numrandkeyboard5, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard5),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard6, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard6),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard7, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard7),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard8, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard8),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard9, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard9)
            );
            $keylist_chapcha_bawah1 = array(
                $telegram->buildInlineKeyBoardButton($numrandkeyboard1, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard1),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard2, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard2),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard3, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard3),
                $telegram->buildInlineKeyBoardButton($numrandkeyboard4, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $numrandkeyboard4),
                $telegram->buildInlineKeyBoardButton($jawabanchapcha, $url = "",  $callback_data = "/chapcha_i " . $userID . " " . $jawabanchapcha)
            );
            //bagian atas
            shuffle($keylist_chapcha_atas0);
            shuffle($keylist_chapcha_atas1);
            $option0 = array($keylist_chapcha_atas0, $keylist_chapcha_atas1);

            //bagian bawah
            shuffle($keylist_chapcha_bawah0);
            shuffle($keylist_chapcha_bawah1);
            $option1 = array($keylist_chapcha_bawah0, $keylist_chapcha_bawah1);

            $randomatasbawah = array($option0, $option1);
            $keyb = $telegram->buildInlineKeyBoard($randomatasbawah[random_int(0, 1)]);
            //kirim gambar
            $bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
            $url        = $bot_url . "sendPhoto?chat_id=" . $chat_id;

            $post_fields = array(
                'chat_id'   => $chat_id,
                'reply_to_message_id' => $message_id,
                'reply_markup' => $keyb,
                'caption' => "Klik angka yang sama dengan gambar, anda memiliki kesempatan 3 kali!",
                'photo'     => new CURLFile(realpath('tmp/' . $randommmmmmmmm . '.jpg'))
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type:multipart/form-data"
            ));
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            $output = curl_exec($ch);


            // $reply = $output;
            // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
            // $telegram->sendMessage($content);

            $hasiljsonOutputcurl = json_decode($output, true);

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
            $cheker = getUseridFromeditmessage($userID);
            if ($cheker == true) {
                $file = __DIR__ . "/../json_data/chapcha_new_member.json";
                $anggota = file_get_contents($file);
                $data = json_decode($anggota, true);
                foreach ($data as $key => $d) {
                    if ($d['userid'] === $userID) {
                        $data[$key]['pharse'] = $jawabanchapcha;
                        $data[$key]['percobaan'] = 1;
                        $data[$key]['msgid'] = $hasiljsonOutputcurl['result']['message_id'];
                    }
                }
                $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                $anggota = file_put_contents($file, $jsonfile);
            } elseif ($cheker == null) {
                $file = __DIR__ . "/../json_data/chapcha_new_member.json";
                $anggota = file_get_contents($file);
                $data = json_decode($anggota, true);

                $data[] = array(
                    "userid" => $userID,
                    "first_name" => $memberanyarpertama,
                    "last_name" => $memberanyarkedua,
                    "chatid" => $chat_id,
                    "pharse" => $jawabanchapcha,
                    "percobaan" => 1,
                    "msgid" => $hasiljsonOutputcurl['result']['message_id']
                );

                $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
                $anggota = file_put_contents($file, $jsonfile);
            }
        } elseif ($user['captcha'] == 'false') {
            if ($user['welcome_text'] == null) {
                $reply = 'Halo, apa kabar mu?';
                $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
                $telegram->sendMessage($content);
            } else {

                $memberanyarpertama = $result['message']['from']['first_name'];
                $memberanyarkedua = $result['message']['from']['last_name'];
                $memberanyarid = $result['message']['from']['id'];

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
                $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id);
                $telegram->sendMessage($content);
            }
        }
    } else {
    }
    exit;
}
