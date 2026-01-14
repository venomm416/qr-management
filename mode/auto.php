<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../log.php";

/* =====================
   Load data.json
   ===================== */

$dataFile = __DIR__ . "/../data.json";

if (!file_exists($dataFile)) {
    http_response_code(500);
    exit("data.json not found");
}

$data = json_decode(file_get_contents($dataFile), true);

if (!is_array($data)) {
    http_response_code(500);
    exit("Invalid data.json");
}

/* =====================
   Resolve job
   ===================== */

$job = $_GET['job'] ?? DEFAULT_JOB;

if (!isset($data[$job]['latest'])) {
    http_response_code(404);
    exit("Document not found");
}

/* =====================
   Log
   ===================== */

logScan($job, "auto");

/* =====================
   Redirect
   ===================== */

header("Location: " . $data[$job]['latest']);
exit;
