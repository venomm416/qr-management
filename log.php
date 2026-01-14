<?php
date_default_timezone_set('Asia/Bangkok');

function logScan($job, $mode, $extra = '-') {
    $time = date("Y-m-d H:i:s");
    $ip   = $_SERVER['REMOTE_ADDR'] ?? '-';
    $ua   = $_SERVER['HTTP_USER_AGENT'] ?? '-';

    $line = "$time | $ip | $job | $mode | $extra | $ua\n";
    file_put_contents(__DIR__ . "/logs/scan.log", $line, FILE_APPEND);
}
