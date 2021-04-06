<?php
require __DIR__ . '/middleware.php';
if (isset($_GET['query']) && isset($_GET['method'])) {
    $method = strtolower($_GET['method']);
    $q = $_GET['query'];
    if ($method == 'caa') {
        $m = dns_get_record($q, DNS_CAA);
    } elseif ($method == 'mx') {
        $m = dns_get_record($q, DNS_MX);
    } elseif ($method == 'ns') {
        $m = dns_get_record($q, DNS_NS);
    } elseif ($method == 'ptr') {
        $m = dns_get_record($q, DNS_PTR);
    } elseif ($method == 'soa') {
        $m = dns_get_record($q, DNS_SOA);
    } elseif ($method == 'txt') {
        $m = dns_get_record($q, DNS_TXT);
    } elseif ($method == 'aaaa') {
        $m = dns_get_record($q, DNS_AAAA);
    } elseif ($method == 'srv') {
        $m = dns_get_record($q, DNS_SRV);
    } elseif ($method == 'naptr') {
        $m = dns_get_record($q, DNS_NAPTR);
    } elseif ($method == 'a6') {
        $m = dns_get_record($q, DNS_A6);
    } elseif ($method == 'a') {
        $m = dns_get_record($q, DNS_A);
    } elseif ($method == 'cname') {
        $m = dns_get_record($q, DNS_CNAME);
    } elseif ($method == 'hinfo') {
        $m = dns_get_record($q, DNS_HINFO);
    } else {
        $m = array(
            "error" => "method tidak ditemukan"
        );
    }

    render_json($m);
}
