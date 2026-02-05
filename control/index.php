<?php
$uploadDir = __DIR__ . '/../uploads';
$images = [];

if (is_dir($uploadDir)) {
  foreach (scandir($uploadDir) as $file) {
    if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
      $images[] = $file;
    }
  }
}

sort($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SnapShow Control Panel</title>
  <link rel="stylesheet" href="control.css">
</head>
<body>

<h1>🎛️ SnapShow Control Panel</h1>

<div class="actions">
  <button onclick="selectAll()">Select All</button>
  <button onclick="clearSelection()">Clear</button>
  <button class="danger" onclick="deleteSelected()">Delete</button>
  <button onclick="downloadSelected()">Download</button>
</div>

<form id="imageForm">
  <div class="grid">
    <?php foreach ($images as $img): ?>
      <label class="thumb">
        <input type="checkbox" value="<?= htmlspecialchars($img) ?>">
        <img src="/uploads/<?= rawurlencode($img) ?>">
        <span><?= htmlspecialchars($img) ?></span>
      </label>
    <?php endforeach; ?>
  </div>
</form>

<script src="control.js"></script>
</body>
</html>
