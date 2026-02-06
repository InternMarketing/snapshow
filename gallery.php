<?php
$UPLOAD_DIR = '/app/uploads';
$images = [];

foreach (glob($UPLOAD_DIR . '/*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE) as $file) {
    $images[] = '/uploads/' . basename($file);
}
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SnapShow Gallery</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body { background:#111; color:#fff; font-family:system-ui; margin:0; padding:20px }
img { width:160px; height:160px; object-fit:cover; margin:8px; border-radius:12px }
a.button {
  display:inline-block;
  padding:10px 16px;
  background:#2563eb;
  color:#fff;
  border-radius:8px;
  text-decoration:none;
}
</style>
</head>
<body>

<h1>🖼 Gallery</h1>

<a href="upload.php" class="button">⬆ Upload More</a>
<a href="download.php" class="button">⬇ Download ZIP</a>

<div>
<?php foreach ($images as $img): ?>
  <img src="<?= htmlspecialchars($img) ?>">
<?php endforeach; ?>
</div>

</body>
</html>
