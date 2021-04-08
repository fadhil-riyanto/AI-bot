<?php
require __DIR__ . '/middleware.php';
include __DIR__ . '/../include/src_ppwhois/Phois/Whois/Whois.php';
if (isset($_GET['domain'])) {
    $sld = $_GET['domain'];
    $domain = new Phois\Whois\Whois($sld);
    $whois_answer = $domain->info();
    render_json(array(
        "data" => $whois_answer
    ));
} else {
    render_json(array(
        'error' => 'parameter tidak lengkap, dibutuhkan domain'
    ));
}
