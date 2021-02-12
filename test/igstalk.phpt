<?php
require __DIR__ . '/../vendor/autoload.php';
$instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());

// For getting information about account you don't need to auth:


try {
    $account = $instagram->getAccount('id_fadhil_riyant90730927509o');
    echo "Account info:\n";
    echo "Id: {$account->getId()}\n";
    echo "Username: {$account->getUsername()}\n";
    echo "Full name: {$account->getFullName()}\n";
    echo "Biography: {$account->getBiography()}\n";
    echo "Profile picture url: {$account->getProfilePicUrl()}\n";
    echo "External link: {$account->getExternalUrl()}\n";
    echo "Number of published posts: {$account->getMediaCount()}\n";
    echo "Number of followers: {$account->getFollowsCount()}\n";
    echo "Number of follows: {$account->getFollowedByCount()}\n";
    echo "Is private: {$account->isPrivate()}\n";
    echo "Is verified: {$account->isVerified()}\n";
} catch (InstagramScraper\Exception\InstagramNotFoundException $e) {
    echo 'error : ' . $e->getMessage();
}
// // Available fields
