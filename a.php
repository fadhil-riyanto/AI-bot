$json_pendekurl = file_get_contents('https://cutt.ly/api/api.php?key=' . $api_key_cuttly . '&short=' . $adanParse[1]);
				$json_shorturl = json_decode($json_pendekurl, true);
				if ($json_pendekurl == null) {
					$reply = 'server down';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 1) {
					$reply = 'Maaf, link telah dipersingkat';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 2) {
					$reply = 'Maaf, itu bukan tautan';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 3) {
					$reply = 'nama link yang diinginkan sudah digunakan';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 4) {
					$reply = 'API key error';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 5) {
					$reply = 'tidak valid : link tidak lolos validasi. Termasuk karakter yang tidak valid';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 6) {
					$reply = 'Tautan yang diberikan berasal dari domain yang diblokir';
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				} elseif ($json_shorturl["url"]["status"] == 7) {
					$reply = 'Shortlink berhasil. Link anda ' . $json_shorturl["url"]["shortLink"];
					$content = array('chat_id' => $chat_id, 'text' => $reply);
					$telegram->sendMessage($content);
				}