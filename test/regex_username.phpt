<?php
$stringInput = "Starting Nmap 7.70 ( https://nmap.org ) at 2021-02-28 03:49 UTC
Nmap scan report for t.me (149.154.167.99)
Host is up (0.075s latency).
Other addresses for t.me (not scanned): 2001:67c:4e8:1033:4:100:0:a 2001:67c:4e8:1033:6:100:0:a 2001:67c:4e8:1033:3:100:0:a 2001:67c:4e8:1033:5:100:0:a

PORT     STATE    SERVICE
21/tcp   filtered ftp
22/tcp   filtered ssh
23/tcp   filtered telnet
80/tcp   open     http
110/tcp  filtered pop3
143/tcp  filtered imap
443/tcp  open     https
3389/tcp filtered ms-wbt-server

Nmap done: 1 IP address (1 host up) scanned in 2.16 seconds";
echo urlencode($stringInput);
