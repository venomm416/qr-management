<?php
require "config.php";

$job = $_GET['job'] ?? DEFAULT_JOB;

if (!isset($DOCS[$job])) {
  http_response_code(404);
  exit("Job not found");
}

switch (MODE) {
  case "auto":
    include "mode/auto.php";
    break;

  case "select":
    include "mode/select.php";
    break;

  case "schedule":
    include "mode/schedule.php";
    break;
}
