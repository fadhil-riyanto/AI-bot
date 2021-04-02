<?php
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
$reply = 'DEBUG :  ' .  $udahDiparse;
$content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
$telegram->sendMessage($content);



require __DIR__ .  '/../madeline/madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();

    $me = yield $MadelineProto->getSelf();

    $MadelineProto->logger($me);

    if (!$me['bot']) {

        yield $MadelineProto->messages->sendMessage(['peer' => '@scriptiseng', 'message' => 'test userge']);
    }
    yield $MadelineProto->echo('OK, done!');
});
