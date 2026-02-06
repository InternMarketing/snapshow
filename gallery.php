<?php
$images = glob("uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SnapShow Gallery</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin:0;
  background:#000;
  color:#fff;
  font-family:system-ui;
  text-align:center;
}
.gallery {
  display:flex;
  flex-wrap:wrap;
  justify-content:center;
  gap:12px;
  padding:20px;
}
label {
  cursor:pointer;
}
img {
  width:150px;
  border-radius:8px;
}
button {
  padding:12px 18px;
  margin:12px;
  font-size:16px;
  border:none;
  border-radius:8px;
  cursor:pointer;
}
</style>
</head>
<body>

<h2>📸 Event Gallery</h2>

<form method="POST" action="/download-selected.php">
<div class="gallery">
<?php foreach ($images as $img): ?>
  <label>
    <input type="checkbox" name="files[]" value="<?= basename($img) ?>"><br>
    <img src="<?= htmlspecialchars($img) ?>">
  </label>
<?php endforeach; ?>
</div>

<button type="submit">⬇ Download Selected</button>
</form>

<a href="/upload.php"><button>⬆ Upload More Photos</button></a>

</body>
</html>
