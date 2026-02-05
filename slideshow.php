<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SnapShow Stage</title>
  <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

  <div id="stage-wrapper">
    <div class="side-beam left"></div>
    <div class="side-beam right"></div>

    <div id="stage">
      <div id="spotlight"></div>
      <div id="image-container"></div>
    </div>
  </div>

  <script src="/assets/app.js"></script>
</body>
</html>
