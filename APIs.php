<?php
error_reporting(0);
// function
function gempa($domain)
{
    $mxzone = dns_get_record($domain, DNS_MX);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
function dapatkan_mx($domain)
{
    $mxzone = dns_get_record($domain, DNS_MX);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
function dapatkan_ns($domain)
{
    $mxzone = dns_get_record($domain, DNS_NS);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
function dapatkan_a($domain)
{
    $mxzone = dns_get_record($domain, DNS_A);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['ip'] . PHP_EOL;
    }
}
function dapatkan_aaaa($domain)
{
    $mxzone = dns_get_record($domain, DNS_AAAA);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['ipv6'] . PHP_EOL;
    }
}

function dapatkan_txt($domain)
{
    $mxzone = dns_get_record($domain, DNS_TXT);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['txt'] . PHP_EOL;
    }
}

function dapatkan_cname($domain)
{
    $mxzone = dns_get_record($domain, DNS_CNAME);
    foreach ($mxzone as $data_mx) {
        header('type: text/plain');
        print '👉 ' . $data_mx['target'] . PHP_EOL;
    }
}
//URI
if (isset($_GET['method'])) {
    $method = @$_GET['method'];
    $dns     = @$_GET['dns'];
} else {
    echo 'null';
}

switch (@$method) {
    case 'mx':
        dapatkan_mx($dns);
        break;

    case 'ns':
        dapatkan_ns($dns);
        break;

    case 'a':
        dapatkan_a($dns);
        break;

    case 'aaaa':
        dapatkan_aaaa($dns);
        break;

    case 'txt':
        dapatkan_txt($dns);
        break;

    case 'cname':
        dapatkan_cname($dns);
        break;

    default:
        # code...
        break;
}
