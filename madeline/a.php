<?php


require __DIR__ .  '/madeline.php';

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
