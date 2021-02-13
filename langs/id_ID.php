<?php
function bahasa($txt){
	global $username;
    $lang = array(
    'command_start' => 'Hai' . $username . 'Apa kabarmu!',
    'friends' => 'Friedns',
    'requests' => 'Requests',
    'continue_reading' => 'Continue reading'
    );
    return $lang[$txt];
}