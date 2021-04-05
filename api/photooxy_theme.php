<?php
function themeddatas($string)
{
    $string = strtolower($string);
    $dict = array(
        'shadow' => 'logo-and-text-effects/shadow-text-effect-in-the-sky-394.html',
        'flower_cup' => 'logo-and-text-effects/write-text-on-the-cup-392.html',
        'romantic_messages' => 'logo-and-text-effects/romantic-messages-for-your-loved-one-391.html',
        'burn_paper' => 'logo-and-text-effects/write-text-on-burn-paper-388.html',
        'funny_cup' => 'logo-and-text-effects/put-text-on-the-cup-387.html',
        'hand_love' => 'logo-and-text-effects/create-a-picture-of-love-message-377.html',
        'grass' => 'logo-and-text-effects/make-quotes-under-grass-376.html',
        'tiktok' => 'logo-and-text-effects/make-tik-tok-text-effect-375.html',
        'red_heart' => 'logo-and-text-effects/love-text-effect-372.html',
        'coffe' => 'logo-and-text-effects/put-any-text-in-to-coffee-cup-371.html',
        'wood_heart' => 'logo-and-text-effects/write-art-quote-on-wood-heart-370.html',
        'wooden_board' => 'logo-and-text-effects/writing-on-wooden-boards-368.html',
        '3d_summer' => 'logo-and-text-effects/3d-summer-text-effect-367.html',
        'wolf_metal' => 'logo-and-text-effects/create-a-wolf-metal-text-effect-365.html',
        'nature_3d' => 'logo-and-text-effects/make-nature-3d-text-effects-364.html',
        'underwater' => 'logo-and-text-effects/creating-an-underwater-ocean-363.html',
        'golden_rose' => 'logo-and-text-effects/yellow-roses-text-360.html',
        'summer_nature' => 'logo-and-text-effects/create-vector-nature-typography-355.html',
        'leaf' => 'logo-and-text-effects/create-a-layered-leaves-typography-text-effect-354.html',
        'fall_leaves' => 'logo-and-text-effects/quotes-under-fall-leaves-347.html',
        'neon' => 'logo-and-text-effects/illuminated-metallic-effect-177.html',
        'rainbow' => 'logo-and-text-effects/rainbow-shine-text-223.html',
        'army_camouflage_fabric' => 'logo-and-text-effects/army-camouflage-fabric-text-effect-221.html',
        '3d_glowing' => 'logo-and-text-effects/create-a-3d-glowing-text-effect-220.html',
        'vintage' => 'other-design/vintage-text-style-219.html',
        'candy_text' => 'logo-and-text-effects/honey-text-effect-218.html',
        'white_cube' => 'logo-and-text-effects/3d-text-effect-under-white-cube-217.html',
        'green_leaves' => 'logo-and-text-effects/make-great-quotes-on-nature-211.html',
        'avatar_gradient' => 'logo-and-text-effects/gradient-avatar-text-effect-207.html',
        'glow_rainbow' => 'logo-and-text-effects/glow-rainbow-effect-generator-201.html',
        'stars' => 'logo-and-text-effects/write-stars-text-on-the-night-sky-200.html',
        'fur' => 'logo-and-text-effects/fur-text-effect-generator-198.html',
        'flaming' => 'logo-and-text-effects/realistic-flaming-text-effect-online-197.html',
        'chrome' => 'logo-and-text-effects/create-a-crisp-chromed-text-effect-196.html',
        'embroidery' => 'logo-and-text-effects/create-embroidery-text-online-191.html',
        '3d_rainbow_background' => 'other-design/create-3d-text-on-rainbow-online-189.html',
        'metalic' => 'other-design/create-metallic-text-glow-online-188.html',
        'striking' => 'other-design/striking-3d-text-effect-online-187.html',
        'watermelon' => 'logo-and-text-effects/watermelon-text-style-186.html',
        'web_matrix' => 'logo-and-text-effects/text-under-web-matrix-effect-185.html',
        'multi_material' => 'logo-and-text-effects/multi-material-text-effect-184.html',
        'butter_fly' => 'logo-and-text-effects/butterfly-text-with-reflection-effect-183.html',
        'wooden_3d' => 'logo-and-text-effects/3d-wood-text-black-style-182.html',
        'modern_metal' => 'logo-and-text-effects/create-wallpaper-with-modern-metal-text-179.html',
        'harry_poter' => 'logo-and-text-effects/create-harry-potter-text-on-horror-background-178.html',
        '3bit' => 'logo-and-text-effects/8-bit-text-on-arcade-rift-175.html',
        'coffe_cup' => 'logo-and-text-effects/put-your-text-on-a-coffee-cup--174.html',
        'luxury_royal' => 'logo-and-text-effects/royal-look-text-balloon-effect-173.html',
        'scary' => 'logo-and-text-effects/text-on-scary-cemetery-gate-172.html',
        'woodblock' => 'logo-and-text-effects/carved-wood-effect-online-171.html',
        'smoke' => 'logo-and-text-effects/smoke-typography-text-effect-170.html',
        'sweet_candy' => 'logo-and-text-effects/sweet-andy-text-online-168.html',
        'silk' => 'logo-and-text-effects/simple-text-on-the-silk-167.html',
        'royal' => 'logo-and-text-effects/bevel-text-between-royal-patterns-166.html',
        'orchids_flower' => 'logo-and-text-effects/text-under-flower-165.html',
        'flower' => 'art-effects/flower-typography-text-effect-164.html',
        'party_neon' => 'logo-and-text-effects/create-party-neon-text-effect-161.html',
        'dark_metal' => 'other-design/create-dark-metal-text-with-special-logo-160.html'
    );
    if (isset($dict[$string])) {
        return $dict[$string];
    } else {
        return false;
    }
}

function photo_oxy_class(array $data)
{
    global $adanParse_plain, $text_plain, $adanParse, $telegram, $chat_id, $message_id;
    $baseurl = $data['base'];
    $themed = '/' . $data['theme'];
    $text1 = $data['text_1'];
    $text2 = $data['text_2'];
    if (strlen($text1) <= 3) {
        header('Content-Type: application/json');
        echo json_encode(array(
            'error' => 'karakter dibawah 3'
        ), JSON_PRETTY_PRINT);
    } else {
        if (isset($text2)) {
            $query1 = array(
                'text_1' => $text1,
                'text_2' => $text2
            );
            $query_build_1 = http_build_query($query1);
        } else {
            $query1 = array(
                'text_1' => $text1
            );
            $query_build_1 = http_build_query($query1);
        }



        require __DIR__ . '/../vendor/autoload.php';
        require __DIR__ . '/../include/simple_html_dom.php';
        $baseurldata = 'https://photooxy.com';
        $client = new GuzzleHttp\Client(['base_uri' => $baseurl]);
        $res = $client->request('POST', $themed . '?' . $query_build_1, ['allow_redirects' => false]);
        $htmls = $res->getBody();
        // echo $htmls;

        // // $html = str_get_html($htmls);
        // echo $htmls;
        $html = new simple_html_dom();
        $html->load($htmls);
        $text = $html->find('div[class=thumbnail]', 0)->innertext;
        preg_match_all('@src="([^"]+)"@', $text, $match);
        //var_dump($match);
        if ($match[1][0] == '') {
            header('Content-Type: application/json');
            echo json_encode(array(
                'error' => 'internal sistem'
            ), JSON_PRETTY_PRINT);
            exit;
        }
        $urls = $baseurldata . $match[1][0];
        header('Content-Type: application/json');
        echo json_encode(array(
            'error' => 'tidak',
            'image' => $urls
        ), JSON_PRETTY_PRINT);
    }
}
