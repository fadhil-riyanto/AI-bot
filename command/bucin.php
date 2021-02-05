<?php
$getPantunJSONsax = file_get_contents(__DIR__ . '/../json_data/fiturTambahan/bucin.json');
$getPantunJSONsaxDec = json_decode($getPantunJSONsax);
$jawabanSebelumPAntun = array(
    'aku punya kata kata bucin nih....',
    'ngab, gw punya kata bucin nie',
    'nih dengerin yank...',
    'the bucin human....wkwk',
    'noh gw kasi senjata bucin',
    'ini bucin nya bang'
);
$reply = $jawabanSebelumPAntun[random_int(0, 5)] . PHP_EOL .  '-------------' . PHP_EOL . $getPantunJSONsaxDec[random_int(1, 17911)]->bucin;
// echo $reply;
$content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);
