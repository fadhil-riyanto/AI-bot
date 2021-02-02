<?php
// $azanHilangcommand = str_replace($adanParse[0], '', $text);
// $udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
if (1) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://fakerapi.it/api/v1/persons?_locale=id_ID&_quantity=1");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'User-Agent: request'
    ));
    $output_faker = curl_exec($ch);
    curl_close($ch);
    $json_tanpa_kodenegara  = json_decode($output_faker, true);

    if ($json_tanpa_kodenegara['code'] == 200) {
        $reply = 'Hai ' . $username . ', Faker data berhasil dibuat' . PHP_EOL . PHP_EOL .
            'Nama depan : ' . $json_tanpa_kodenegara['data'][0]['firstname'] . PHP_EOL .
            'Nama belakang : ' . $json_tanpa_kodenegara['data'][0]['lastname'] . PHP_EOL .
            'Email : ' . $json_tanpa_kodenegara['data'][0]['email'] . PHP_EOL .
            'No HP : ' . $json_tanpa_kodenegara['data'][0]['phone'] . PHP_EOL .
            'Ulang tahun : ' . $json_tanpa_kodenegara['data'][0]['birthday'] . PHP_EOL .
            'Gender : ' . $json_tanpa_kodenegara['data'][0]['gender'] . PHP_EOL .
            // DATA ALAMAT
            'Alamat Jalan : ' . $json_tanpa_kodenegara['data'][0]['address']['street'] . PHP_EOL .
            'Nomor bangunan : ' . $json_tanpa_kodenegara['data'][0]['address']['buildingNumber'] . PHP_EOL .
            'Kota : ' . $json_tanpa_kodenegara['data'][0]['address']['city'] . PHP_EOL .
            'Zip : ' . $json_tanpa_kodenegara['data'][0]['address']['zipcode'] . PHP_EOL .
            'Negara : ' . $json_tanpa_kodenegara['data'][0]['address']['country'] . PHP_EOL .
            'latitude : ' . $json_tanpa_kodenegara['data'][0]['address']['latitude'] . PHP_EOL .
            'longitude : ' . $json_tanpa_kodenegara['data'][0]['address']['longitude'] . PHP_EOL .
            'website : ' . $json_tanpa_kodenegara['data'][0]['website'] . PHP_EOL;
        //$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        //$telegram->sendMessage($content);
        $option = array(
            //First row
            // array($telegram->buildInlineKeyBoardButton("Button 1", $url = '', $callback_data = '/corona'), $telegram->buildInlineKeyBoardButton("Button 2", $url = "http://link2.com")),
            // //Second row 
            // array($telegram->buildInlineKeyBoardButton("Button 3", $url = "http://link3.com"), $telegram->buildInlineKeyBoardButton("Button 4", $url = "http://link4.com"), $telegram->buildInlineKeyBoardButton("Button 5", $url = "http://link5.com")),
            // //Third row
            array($telegram->buildInlineKeyBoardButton("Buat data lagi!", $url = "", $callback_data = '/faker@fadhil_riyanto_bot'))
        );
        $keyb = $telegram->buildInlineKeyBoard($option);
        $content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    } else {
        $reply = 'Hai ' . $username . ', Maaf, ada kesalahan di sistem kami.';
        $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
        $telegram->sendMessage($content);
    }
}
