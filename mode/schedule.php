<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../log.php";

$today = date("Y-m-d");
$selected = array_key_first($DOCS[$job]['versions']);

foreach ($DOCS[$job]['schedule'] as $date => $ver) {
  if ($today >= $date) {
    $selected = $ver;
  }
}

logScan($job, "schedule", $selected);

header("Location: download.php?job=$job&v=$selected");
exit;
