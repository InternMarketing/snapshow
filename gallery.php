<?php
session_start();
if (!isset($_SESSION['viewer'])) die("Access denied");

$images = glob("uploads/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html>
<head>
<title>Thank You!</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.gallery img { width:150px; margin:5px }
</style>
</head>
<body>

<h2>Thank you for sharing! ❤️</h2>

<form method="POST" action="download.php">
<div class="gallery">
<?php foreach ($images as $img): ?>
  <label>
    <input type="checkbox" name="files[]" value="<?= htmlspecialchars($img) ?>">
    <img src="<?= htmlspecialchars($img) ?>">
  </label>
<?php endforeach; ?>
</div>

<br>
<button type="submit">Download Selected</button>
</form>

</body>
</html>