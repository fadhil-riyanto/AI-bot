<?php
if ($adanParse[0] == '/afk' ||  '/afk' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'afk.php';
} elseif ($adanParse[0] == '/unafk' || '/unafk' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'unafk.php';
} elseif ($adanParse[0] == '/invitelink' || '/invitelink' . USERNAME_BOT . '' == $adanParse[0]) {
    require 'invitelink.php';
}
