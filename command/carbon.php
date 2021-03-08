<?php
//$hapusTulis = 
$udahDiparse = str_replace($adanParse_plain[0] . ' ', '', $text_plain);
if ($adanParse[1] == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Pattern kosong, gunakan format' . PHP_EOL . PHP_EOL . '<pre>/tulis {your text}</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} else {
    $data = array("backgroundColor" => "rgba(144, 19, 254, 100)", "code" => urlencode(htmlspecialchars_decode($udahDiparse)), "theme" => "dracula");
    $data_string = json_encode($data);
    $ch = curl_init('https://carbonnowsh.herokuapp.com');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
    ));

    $result = curl_exec($ch);
    $output = __DIR__ . '/../tmp/carbonimg.png';
    file_put_contents($output, $result);
    $bot_url    = "https://api.telegram.org/bot" . TG_HTTP_API . "/";
    $url        = $bot_url . "sendDocument?chat_id=" . $chat_id;

    $post_fields = array(
        'reply_to_message_id' => $message_id,
        'document'     => new CURLFile(realpath('tmp/carbonimg.png'))
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type:multipart/form-data"
    ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $output = curl_exec($ch);
    exit;
}
