<?php
$getfaktanJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/faktaunik.json');
$getfaktanJSONsaxDec = json_decode($getfaktanJSONsax);
$jawabanSebelumfaktan = array(
    'aku punya fakta menarik nih....',
    'ngab, gw punya fakta menarik nie',
    'nih dengerin ngab...',
    'the fakta, biar pinter....wkwk',
    'noh gw kasi kata fakta di dunia',
    'ini fakta nya bang'
);
$reply = $jawabanSebelumfaktan[random_int(0, 5)] . PHP_EOL .  '-------------' . PHP_EOL . $getfaktanJSONsaxDec[random_int(1, 17911)]->factsUnique;
// echo $reply;
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
