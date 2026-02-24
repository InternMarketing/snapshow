<?php
$event = $_GET['event'] ?? 'event';
$images = array_merge(
    glob("uploads/*.jpg"),
    glob("uploads/*.jpeg"),
    glob("uploads/*.png"),
    glob("uploads/*.webp")
);
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<title>Gallery</title>
<link rel="stylesheet" href="assets/gallery.css">
</head>
<body>

<h1>Gallery</h1>
<a href="upload.php">Return to Upload</a>

<form method="post" action="download-selected.php?event=<?= urlencode($event) ?>">
<div class="grid">
<?php foreach ($images as $i => $img): ?>
<div class="cell">
    <input type="checkbox" name="files[]" value="<?= htmlspecialchars($img) ?>">
    <img src="<?= htmlspecialchars($img) ?>" data-index="<?= $i ?>">
</div>
<?php endforeach; ?>
</div>

<button type="submit">Download Selected</button>
</form>

<div id="modal">
    <span id="close">×</span>
    <span id="prev">❮</span>
    <img id="modalImg">
    <span id="next">❯</span>
</div>

<script src="assets/gallery.js"></script>
</body>
</html>
