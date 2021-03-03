<?php
if ($adanParse[0] == '/afk' || $adanParse[0] == '/afk') {
    require 'afk.php';
} elseif ($adanParse[0] == '/unafk' || $adanParse[0] == '/unafk') {
    require 'unafk.php';
} elseif ($adanParse[0] == '/invitelink' || $adanParse[0] == '/invitelink') {
    require 'invitelink.php';
}
