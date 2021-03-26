<?php

function animecheck($string)
{
    $string = strtolower($string);
    $dict = array(
        '/waifu' => 'waifu',
        '/neko' => 'neko',
        '/shinobu' => 'shinobu',
        '/megumin' => 'megumin',
        '/bully' => 'bully',
        '/cuddle' => 'cuddle',
        '/cry' => 'cry',
        '/hug' => 'hug',
        '/awoo' => 'awoo',
        '/kiss' => 'kiss',
        '/lick' => 'lick',
        '/pat' => 'pat',
        '/smug' => 'smug',
        '/bonk' => 'bonk',
        '/yeet' => 'yeet',
        '/blush' => 'blush',
        '/smile' => 'smile',
        '/wave' => 'wave',
        '/smile' => 'smile',
        '/wave' => 'wave',
        '/highfive' => 'highfive',
        '/handhold' => 'handhold',
        '/nom' => 'nom',
        '/bite' => 'bite',
        '/glomp' => 'glomp',
        '/kill' => 'kill',
        '/slap' => 'slap',
        '/happy' => 'happy',
        '/wink' => 'wink',
        '/poke' => 'poke',
        '/dance' => 'dance',
        '/cringe' => 'cringe',
        '/blush' => 'blush'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}

$ngecekanime = animecheck($adanParse_plain_nokarakter[0]);
if ($ngecekanime == false) {
    $exuser = explode('@', strtolower($adanParse_plain_nokarakter[0]));
    $konf = animecheck($exuser[0]);
    if ($konf == false) {
        $animecek = false;
    } else {
        $animecek = true;
        $animeget = $konf;
    }
} else {
    $animecek = true;
    $animeget = $ngecekanime;
}

if ($animecek == true) {
    $imganimedec = json_decode(file_get_contents('https://waifu.pics/api/sfw/' . $animeget));
    $content = array('chat_id' => $chat_id, 'photo' => $imganimedec->url, 'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    $telegram->sendPhoto($content);
} else {
}
