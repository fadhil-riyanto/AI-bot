<?php
function bahasa($txt){
    static $lang = array(
    // home page
    'html_dir' => 'ltr',
    'friends' => 'Friedns',
    'requests' => 'Requests',
    'continue_reading' => 'Continue reading',


   // ==========================================

    );
    return $lang[$txt];
}