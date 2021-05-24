<?php

$sms_db_cache_dir = __DIR__ . "/sms_db";
$sms_db_cache = new \SleekDB\Store("sms_db", $sms_db_cache_dir);
