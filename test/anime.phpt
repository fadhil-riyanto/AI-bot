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
