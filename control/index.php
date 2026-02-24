<?php
$images = glob("../uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Control Panel</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Control Panel</h2>

<div id="controls">
    <button id="deleteBtn">Delete Selected</button>
    <button id="downloadBtn">Download Selected</button>
</div>

<div id="gallery" class="grid">
<?php foreach ($images as $img): ?>
<div class="thumb" data-file="<?= basename($img) ?>">
    <img src="../uploads/<?= basename($img) ?>">
</div>
<?php endforeach; ?>
</div>

<div id="modal">
    <span id="close">×</span>
    <img id="modalImg">
    <span id="prev">‹</span>
    <span id="next">›</span>
</div>

<script src="../assets/app.js"></script>
</body>
</html>
