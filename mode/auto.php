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

if (!isset($data[$job])) {
    http_response_code(404);
    exit("Job not found");
}

$doc = $data[$job];

/* =====================
   Log
   ===================== */

logScan($job, "auto");

/* =====================
   If no file yet → show Coming Soon
   ===================== */

if (empty($doc['latest'])) {
    $title = $doc['title'] ?? "เอกสาร";
    $note  = $doc['note']  ?? "";

    ?>
    <!doctype html>
    <html lang="th">
    <head>
        <meta charset="utf-8">
        <title><?php echo htmlspecialchars($title); ?></title>
        <style>
            body {
                font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
                background: #f5f6f7;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
            }
            .box {
                background: #fff;
                padding: 36px 42px;
                border-radius: 10px;
                box-shadow: 0 6px 16px rgba(0,0,0,0.12);
                text-align: center;
                max-width: 520px;
            }
            .badge {
                display: inline-block;
                background: #ff9800;
                color: #fff;
                font-size: 13px;
                font-weight: 600;
                padding: 4px 10px;
                border-radius: 20px;
                margin-bottom: 14px;
                letter-spacing: 0.5px;
            }
            h1 {
                font-size: 22px;
                margin-bottom: 10px;
            }
            p {
                font-size: 16px;
                color: #555;
                margin: 6px 0;
            }
        </style>
    </head>
    <body>
        <div class="box">
            <div class="badge">COMING SOON</div>
            <h1><?php echo htmlspecialchars($title); ?></h1>

            <?php if ($note): ?>
                <p><?php echo htmlspecialchars($note); ?></p>
            <?php endif; ?>

            <p style="margin-top:14px; color:#777; font-size:14px;">
                เอกสารจะเผยแพร่เมื่อพร้อม
            </p>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/* =====================
   File exists → redirect
   ===================== */

header("Location: " . $doc['latest']);
exit;
