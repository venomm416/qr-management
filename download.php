<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/log.php";

/* =====================
   Load data.json
   ===================== */

$dataFile = __DIR__ . "/data.json";

if (!file_exists($dataFile)) {
    http_response_code(500);
    exit("Data file not found");
}

$data = json_decode(file_get_contents($dataFile), true);

if (!is_array($data)) {
    http_response_code(500);
    exit("Invalid data format");
}

/* =====================
   Resolve job
   ===================== */

$job = $_GET['job'] ?? DEFAULT_JOB;

if (!isset($data[$job]['latest'])) {
    http_response_code(404);
    exit("Document not found");
}

$url = $data[$job]['latest'];

/* =====================
   Optional filename
   ===================== */
/*
 * ถ้าอยากตั้งชื่อไฟล์ตอน download
 * - ใช้ชื่อไฟล์จาก URL เป็นค่า default
 * - หรือจะกำหนดเองใน data.json ภายหลังก็ได้
 */

$filename = basename(parse_url($url, PHP_URL_PATH)) ?: "document.pdf";

/* =====================
   Log
   ===================== */

logScan($job, "download");

/* =====================
   Serve file
   ===================== */

// ===== Local file =====
if (!preg_match('/^https?:\/\//i', $url)) {

    $filePath = realpath(__DIR__ . "/" . $url);

    if (!$filePath || !file_exists($filePath)) {
        http_response_code(404);
        exit("File not found");
    }

    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"$filename\"");
    header("Content-Length: " . filesize($filePath));

    readfile($filePath);
    exit;
}

// ===== External file =====
header("Content-Disposition: inline; filename=\"$filename\"");
header("Location: $url");
exit;
