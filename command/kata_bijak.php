<?php
$getfaktanJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/katabijak.json');
$getfaktanJSONsaxDec = json_decode($getfaktanJSONsax);
$jawabanSebelumfaktan = array(
    'aku punya kata kata menarik nih....',
    'ngab, gw punya kata menarik nie',
    'nih dengerin ngab...',
    'the kata kata bijak, biar pinter....wkwk',
    'noh gw kasi kata bijak di dunia',
    'ini bang'
);
$reply = $jawabanSebelumfaktan[random_int(0, 5)] . PHP_EOL .  '-------------' . PHP_EOL . $getfaktanJSONsaxDec[random_int(1, 17911)]->kataBijak;
// echo $reply;
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
