<?php
require "vendor/autoload.php";
function cek_apakah_anime_ada($cek)
{
    $cek = substr($cek, 1);
    $gets = file_get_contents('https://waifu.pics/api/sfw/' . $cek);
	$dec = json_decode($gets);
    if ($dec == null) {
		return false;
	}elseif(isset($dec->message) && $dec->message == "Not Found"){
		return false;
	}else{
		return true;
	}
}
echo var_dump(cek_apakah_anime_ada('/nek'));