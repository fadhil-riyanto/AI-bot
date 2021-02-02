<?php
$reply = 'Hai ' . $username . ', Saya senang mendengar anda mau donasi' . PHP_EOL . PHP_EOL .
		'Saya memiliki 2 cara untuk donasi' . PHP_EOL . PHP_EOL .
		'Cara pertama kamu hanya perlu mengirimkan banyak pertanyaan ringan ke bot. Agar apa? agar dia pintar. karena semakin banyak kata maka semakin banyak jumlah kata yang tersimpan (Jangan spam yaa, kasihan CPU server-nya).' . PHP_EOL . PHP_EOL .
		'Cara kedua kamu bisa mengirimkan uang ke saya, jumlah bebas dan seikhlasnya. uang akan digunakan untuk membeli dan memperpanjang hosting database server.' . PHP_EOL . PHP_EOL .
		'Contact @fadhil_riyanto untuk penjelasan lebih lanjut';
	$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id);
	$telegram->sendMessage($content);