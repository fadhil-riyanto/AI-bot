<?php
$arr = [
    '/pin', '/unpin',
    '/set_welcome', '/test_welcome', '/set_chapcha_mode',
    '/set_goodbye', '/set_welcome_mode', '/set_goodbye_mode',
    '/set_rules', '/promote', '/demote', '/clear_rules',
    '/admin_mode', '/unpinall', '/mute', '/set_admin_title',
    '/unmute', '/ban', '/sban', '/kick',
    '/skick', '/unban', '/init', '/addword',
    '/delword', '/filter_action_mode',
    '/filter_action', '/filter_notify'
];
$input = "/makan";

foreach ($arr as $a) {
    if ($a == $input) {
        $ditemukan = true;
    }
}

var_dump($ditemukan);
