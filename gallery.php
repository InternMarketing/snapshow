<?php
$images = glob("uploads/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
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
h2 { margin: 20px 0; }
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
  font-size: 1rem;
  cursor: pointer;
}
</style>
</head>
<body>

<h2>Thank you for sharing ❤️</h2>

<a href="upload.php">
  <button type="button">⬅ Upload More Photos</button>
</a>

<form method="POST" action="download.php">
  <div class="gallery">
    <?php foreach ($images as $img): ?>
      <label>
        <input type="checkbox" name="files[]" value="<?= htmlspecialchars($img) ?>">
        <br>
        <img src="<?= htmlspecialchars($img) ?>?v=<?= filemtime($img) ?>">
      </label>
    <?php endforeach; ?>
  </div>

  <button type="submit">⬇ Download Selected</button>
</form>

</body>
</html>
