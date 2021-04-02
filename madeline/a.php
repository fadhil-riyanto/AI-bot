<?php


require __DIR__ .  '/madeline.php';

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();

    $me = yield $MadelineProto->getSelf();

    $MadelineProto->logger($me);

    if (!$me['bot']) {

        yield $Vector_of_User = $MadelineProto->users->getUsers(['id' => [$_GET['u']],]);
        echo json_encode($Vector_of_User);
    }
    yield $MadelineProto->echo('OK, done!');
});
