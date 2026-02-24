<?php
session_start();
$event = $_SESSION['event_name'] ?? 'event';
$images = glob("uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Gallery</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h2>Gallery</h2>

<button id="downloadBtn">Download Selected</button>

<div id="gallery" class="grid">
<?php foreach ($images as $img): ?>
<div class="thumb" data-file="<?= basename($img) ?>">
    <img src="uploads/<?= basename($img) ?>">
</div>
<?php endforeach; ?>
</div>

<div id="modal">
    <span id="close">×</span>
    <span id="prev">‹</span>
    <img id="modalImg">
    <span id="next">›</span>
</div>

<script>
const EVENT_NAME = <?= json_encode($event) ?>;
</script>
<script src="assets/gallery.js"></script>
</body>
</html>
