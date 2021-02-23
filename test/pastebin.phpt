<?php
require __DIR__ . '/../vendor/autoload.php';

use \Brush\Pastes\Draft;
use \Brush\Accounts\Developer;
use \Brush\Exceptions\BrushException;

$draft = new Draft(); // drafts represent unsent pastes
$draft->setContent('Some random content'); // set the paste content
$developer = new Developer('8HPm65nBCWQV0pfOH3PLNFNTSkdiAkQD');

try {
    // send the draft to Pastebin; turn it into a full blown Paste object
    $paste = $draft->paste($developer);

    // print out the URL of the new paste
    echo $paste->getUrl(); // e.g. https://pastebin.com/JYvbS0fC
} catch (BrushException $e) {
    // some sort of error occurred; check the message for the cause
    echo $e->getMessage();
}
