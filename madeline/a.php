<?php
if (isset($_GET['u'])) {

    if (!file_exists('madeline.php')) {
        copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
    }
    include 'madeline.php';

    $MadelineProto = new \danog\MadelineProto\API('session.madeline');
    $MadelineProto->async(true);
    $MadelineProto->loop(function () use ($MadelineProto) {
        yield $MadelineProto->start();

        $me = yield $MadelineProto->getSelf();

        $MadelineProto->logger($me);

        if (!$me['bot']) {
            $Vector_of_User = yield $MadelineProto->users->getUsers(['id' => [$_GET['u']]]);
            //file_put_contents('ngetes.txt', );
            echo json_encode($Vector_of_User, JSON_PRETTY_PRINT);
        }
        //yield $MadelineProto->echo('OK, done!');
    });
}
