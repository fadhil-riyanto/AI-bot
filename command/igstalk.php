<?php
$azanHilangcommand = str_replace($adanParse[0], '', $text);
$udahDiparse = str_replace($adanParse[0] . ' ', '', $text);
$instagram = @new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
try {
    $account = @$instagram->getAccount($udahDiparse);
    $igid = $account->getId();
    $userig = $account->getUsername();
    $fullnameig = $account->getFullName();
    $bioig = $account->getBiography();
    $pictig = $account->getProfilePicUrl();
    $linkig = $account->getExternalUrl();
    $totalpostig = $account->getMediaCount();
    $pengikutig = $account->getFollowsCount();
    $mengikutiig = $account->getFollowedByCount();
    $apakahprivateacc = $account->isPrivate();
    $apakahverified = $account->isVerified();
    $notfoundig = false;
} catch (InstagramScraper\Exception\InstagramNotFoundException $e) {
    $notfoundig = true;
}
if ($adanParse[1] == null) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Maaf, Gunakan pattern' . PHP_EOL . PHP_EOL . '<pre>/igstalk {username}</pre>' . PHP_EOL . PHP_EOL . 'Contoh : <pre>/igstalk kevin</pre>';
    $content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} elseif ($notfoundig == true) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Maaf, tidak ditemukan, Mungkin kamu salah ketik atau mungkin akun yang kamu cari sudah dibanned sama instagram';
    $content = array('chat_id' => $chat_id, 'text' => $reply,  'reply_to_message_id' => $message_id, 'parse_mode' => 'html', 'disable_web_page_preview' => true);
    $telegram->sendMessage($content);
    exit;
} elseif ($notfoundig == false) {
    $reply = 'Hai ' . $username . PHP_EOL . 'Info Username instagram' . PHP_EOL . PHP_EOL .
        'id :' . $igid . PHP_EOL .
        'username :' . $userig . PHP_EOL .
        'fullname :' . $fullnameig . PHP_EOL .
        'follower : ' . $pengikutig . PHP_EOL .
        'followed : ' . $mengikutiig . PHP_EOL .
        'bio : ' . $bioig . PHP_EOL .
        'link : ' . $linkig;

    $option = array(
        array($telegram->buildInlineKeyBoardButton("Akun", $url = "https://www.instagram.com/" . $userig))
    );
    $keyb = $telegram->buildInlineKeyBoard($option);

    $konten = array('chat_id' => $chat_id, 'photo' => $pictig, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true, 'caption' => $reply);
    $telegram->sendPhoto($konten);
    // $content = array('chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $keyb,  'reply_to_message_id' => $message_id, 'disable_web_page_preview' => true);
    // $telegram->sendMessage($content);
    //keyboard inline biar ga ribet buka link repo


    exit;
}
