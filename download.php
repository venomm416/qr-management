<?php
require "config.php";
require "log.php";

$job = $_GET['job'] ?? DEFAULT_JOB;
$ver = $_GET['v'] ?? null;

if (!isset($DOCS[$job]['versions'][$ver])) {
  http_response_code(403);
  exit("Not allowed");
}

$data = $DOCS[$job]['versions'][$ver];
$url  = $data['url'];
$name = $data['filename'];

logScan($job, "download", $ver);

// ===== local file =====
if (!str_starts_with($url, "http")) {
  header("Content-Type: application/pdf");
  header("Content-Disposition: inline; filename=\"$name\"");
  readfile($url);
  exit;
}

// ===== external file =====
header("Content-Disposition: inline; filename=\"$name\"");
header("Location: $url");
exit;
