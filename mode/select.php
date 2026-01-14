<?php
require_once "config.php";
require_once "log.php";

logScan($job, "select");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>เลือกเอกสาร</title>
</head>
<body>
  <h2><?=$DOCS[$job]['title']?></h2>
  <ul>
    <?php foreach ($DOCS[$job]['versions'] as $key => $v): ?>
      <li>
        <a href="download.php?job=<?=$job?>&v=<?=$key?>">
          <?=$DOCS[$job]['title']?> (<?=$key?>)
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
