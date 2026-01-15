<?php
require_once __DIR__ . "/config.php";

/*
 * index.php
 * ทำหน้าที่เลือก mode เท่านั้น
 * ไม่ยุ่งกับ job / data.json
 */

switch (MODE) {
    case "auto":
        require __DIR__ . "/mode/auto.php";
        break;

    case "select":
        require __DIR__ . "/mode/select.php";
        break;

    case "schedule":
        require __DIR__ . "/mode/schedule.php";
        break;

    default:
        http_response_code(500);
        exit("Invalid mode");
}
