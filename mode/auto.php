<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../log.php";

logScan($job, "auto");

header("Location: " . $DOCS[$job]['latest']);
exit;
