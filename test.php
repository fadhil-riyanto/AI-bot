<?php
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com/users/fadhil-riyanto");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'User-Agent: request'
	));
    $output = curl_exec($ch); 
    curl_close($ch);
$jsons = json_decode($output);    

echo $jsons->login;