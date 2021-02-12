<?php
require __DIR__ . '/../vendor/autoload.php';

function cariIgstalk($username)
{
    $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
    try {
        $account = $instagram->getAccount($username);
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
        $arrayjson = array(
            
        );
    } catch (InstagramScraper\Exception\InstagramNotFoundException $e) {
        echo 'error : ' . $e->getMessage();
    }
}
cariIgstalk('kevinn4930809');
