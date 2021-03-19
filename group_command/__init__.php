<?php
if ($adanParse[0] == '/afk' ||  '/afk' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'afk.php';
    exit;
} elseif ($adanParse[0] == '/unafk' || '/unafk' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'unafk.php';
    exit;
} elseif ($adanParse[0] == '/invitelink' || '/invitelink' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'invitelink.php';
    exit;
} elseif ($adanParse[0] == '/adminlist' || '/adminlist' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'invitelink.php';
    exit;
} elseif ($adanParse[0] == '/report' || $adanParse[0] == '/r' || '/report' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'report.php';
    exit;
}
