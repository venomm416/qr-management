<?php
function logScan($job, $action, $version = "-") {
  $line = implode(" | ", [
    date("Y-m-d H:i:s"),
    $_SERVER['REMOTE_ADDR'] ?? "-",
    $job,
    $action,
    $version,
    $_SERVER['HTTP_USER_AGENT'] ?? "-"
  ]) . PHP_EOL;

  file_put_contents("logs/scan.log", $line, FILE_APPEND);
}
