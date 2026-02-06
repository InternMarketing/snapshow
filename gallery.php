<?php
$uploadDir = __DIR__ . '/uploads';
$images = [];

if (is_dir($uploadDir)) {
    foreach (glob($uploadDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) as $f) {
        $images[] = '/uploads/' . basename($f);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SnapShow Gallery</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: system-ui;
  background: #000;
  color: #fff;
  text-align: center;
}
.gallery {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
  padding: 10px;
}
.gallery img {
  width: 150px;
  border-radius: 6px;
}
button {
  margin: 15px;
  padding: 10px 20px;
}
</style>
</head>
<body>

<h2>Thank you for sharing ❤️</h2>

<a href="upload.php">
  <button type="button">⬅ Upload More Photos</button>
</a>

<div class="gallery">
<?php foreach ($images as $img): ?>
  <img src="<?= $img ?>?v=<?= time() ?>">
<?php endforeach; ?>
</div>

</body>
</html>
