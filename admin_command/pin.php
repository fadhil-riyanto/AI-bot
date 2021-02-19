<?php
$result = $telegram->getData();
$msgid = $result['message']['reply_to_message']['message_id'];
$boolpinchat = 
