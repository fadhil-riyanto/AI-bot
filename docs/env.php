<?php
error_reporting(1);
function SERVER_ALAMAT_addr_indez_apis()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
        $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return $protocol . $domainName;
}

$envsystem_base = SERVER_ALAMAT_addr_indez_apis() . '/api/';

//dev
$htmltitle = 'Fadhil Riyanto';
$namaapis = 'Fadhil Riyanto';
$devname = 'Fadhil Riyanto';
$githublinkdev = 'https://github.com/fadhil-riyanto';

// INDEX 
$selamatdatang = 'Selamat datang!!!';
$titleindex = 'Fadhil Rest Api';
$body = <<<EOF
kenalin, namaku fadhil, asal dari semarang. Rest API ini free dengan apikey. untuk dapat apikeynya kamu bisa kontak saya di telegram.<br>
Mohon jangan membuat flood dan membuat banjir yang berlebihan.<br><br>
Jika kamu suka api ini, boleh dong follow akun github saya. <br>
<br>
Makasi 😘<br><br>
<h6 class="m-0 font-weight-bold text-primary">Thanks to</h6>

<ul>
 <li>Allah SWT.</li>
 <li>HP 430 intel i3 ram 4 gb</li>
 <li>Heroku</li>
 <li>Google</li>
</ul>
EOF;

$profilenames = 'Fadhil riyanto';
$profilemode = false;

$nitifypais = array(
    "Akan diberlakukan sistem apikey", "jangan banjir"
);
