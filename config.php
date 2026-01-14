<?php
/* =====================
   GLOBAL CONFIG
   ===================== */

// โหมดหลัก (ใช้ auto จริง)
define("MODE", "auto");

// งาน default
define("DEFAULT_JOB", "annual");

/* =====================
   JOB CONFIG (Multi-job)
   ===================== */

$DOCS = [

  "annual" => [
    "title" => "รายงานกิจการ ประจำปี 2567",

    // auto mode จะเปิดไฟล์นี้
    // ใช้ได้ทั้ง local / external
    "latest" => "https://apps2.coop.ku.ac.th/doc/pr/annual2567-save.pdf",
    // ตัวอย่าง local:
    // "latest" => "files/annual_latest.pdf",

    // ตอนนี้มีไฟล์เดียว (เผื่อขยาย)
    "versions" => [
      "2567" => [
        "url" => "https://apps2.coop.ku.ac.th/doc/pr/annual2567-save.pdf",
        "filename" => "รายงานกิจการ_ประจำปี_2567.pdf"
      ]
    ],

    // เผื่อใช้ schedule ในอนาคต
    "schedule" => []
  ],

  // 🔹 เพิ่มงานใหม่ในอนาคตได้ตรงนี้
  // "policy" => [ ... ]
];
