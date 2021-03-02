<?php
function SERVER_ALAMAT_addr()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
		$_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	return $protocol . $domainName;
}
function _is_curl_installed()
{
	if (in_array('curl', get_loaded_extensions())) {
		return true;
	} else {
		return false;
	}
}
function waktu_aktif()
{
	$ut = strtok(exec("cat /proc/uptime"), ".");
	$days = sprintf("%2d", ($ut / (3600 * 24)));
	$hours = sprintf("%2d", (($ut % (3600 * 24)) / 3600));
	$min = sprintf("%2d", ($ut % (3600 * 24) % 3600) / 60);
	$sec = sprintf("%2d", ($ut % (3600 * 24) % 3600) % 60);


	return array($days, $hours, $min, $sec);
}
function detect_grup()
{
	global $chat_id;
	$pregs = substr($chat_id, 0, 1);
	if ($pregs == '-') {
		return true;
	}
}
function detect_apakah_pesan_reply_ke_bot()
{
	global $replyid_replian;
	global $id_bot_sendiri;
	global $deteksiApakahGrup;
	if (isset($replyid_replian)) {
		if ($replyid_replian == $id_bot_sendiri) {
			return true;
		} else {
			return false;
		}
	} elseif ($deteksiApakahGrup == null) {
		return true;
	} else {
		return false;
	}
}
function is_valid_domain_name($domain_name)
{
	return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
		&& preg_match("/^.{1,253}$/", $domain_name) //overall length check
		&& preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)); //length of each label
}
function cek_domain($url)
{
	// KEMbalikan BOOL ::
	$validation = FALSE;
	/*Parse URL*/
	$urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
	/*Check host exist else path assign to host*/
	if (!isset($urlparts['host'])) {
		$urlparts['host'] = $urlparts['path'];
	}

	if ($urlparts['host'] != '') {
		/*Add scheme if not found*/
		if (!isset($urlparts['scheme'])) {
			$urlparts['scheme'] = 'http';
		}
		/*Validation*/
		if (checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'], array('http', 'https')) && ip2long($urlparts['host']) === FALSE) {
			$urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
			$url = $urlparts['scheme'] . '://' . $urlparts['host'] . "/";

			if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
				$validation = TRUE;
			}
		}
	}

	if (!$validation) {
		return false;
	} else {
		return true;
	}
}
function hapus_http($url)
{
	$disallowed = array('http://', 'https://');
	foreach ($disallowed as $d) {
		if (strpos($url, $d) === 0) {
			return str_replace($d, '', $url);
		}
	}
	return $url;
}
function tracking_user($userID)
{
	$file = __DIR__ . "/json_data/user_client.json";
	$anggota = file_get_contents($file);
	$data = json_decode($anggota, true);
	foreach ($data as $d) {
		if ($d['userid'] == $userID) {
			return true;
		}
	}
}
function tracking_user_forwaktu($userID)
	{
		global $useridTime;
		$file = __DIR__ . "/json_data/user_delay_time.json";
		$anggota = file_get_contents($file);
		$data = json_decode($anggota, true);
		foreach ($data as $d) {
			if ($d['userid'] == $userID) {
				$useridTime = $d['userid'];
				return true;
			}
		}
	}
	
	