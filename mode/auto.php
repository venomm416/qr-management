<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../log.php";

$dataFile = __DIR__ . "/../data.json";
$data = json_decode(file_get_contents($dataFile), true);

$job = $_GET['job'] ?? DEFAULT_JOB;

if (!isset($data[$job]['latest'])) {
    http_response_code(404);
    exit("Document not found");
}

logScan($job, "auto");

header("Location: " . $data[$job]['latest']);
exit;


// echo "AUTO MODE OK<br>";
// echo "Job: " . $job;