<?php
require __DIR__ . '/vendor/autoload.php';
for($i=1;$i<100;$i++){
	$client = new \GuzzleHttp\Client();
	$response = $client->request('GET', 'https://lolhuman.herokuapp.com/?id=1612358665633;msg=Premium%20Auto%20Visitor');
	echo $i;
}