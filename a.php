<?php
$mx = dns_get_record('fadhilriyanto.eu.org', DNS_MX);
foreach($mx as $smx){
	echo ($smx['target']);
}