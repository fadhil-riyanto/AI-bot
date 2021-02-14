<?php
$reply = 'Hai ' . $username . ', Saya senang mendengar niat baik anda untuk donasi' . PHP_EOL . PHP_EOL .
	'Tapi, saya tidak menerima donasi apapun. semua free dan semua biaya ditanggung pembuat.' . PHP_EOL . PHP_EOL .
	'Semoga niat baik anda untuk donasi akan dicatat sebagai amal (Karna niat dan belum dilakukan itu sudah dicatat sebagai pahala oleh malaikat)';
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id);
$telegram->sendMessage($content);
