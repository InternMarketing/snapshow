<?php
$images = glob("uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
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
<a href="upload.php" class="back">Return to Upload</a>

<form method="post" action="download-selected.php">
<div class="grid">
<?php foreach ($images as $img): ?>
<div class="cell">
    <input type="checkbox" name="files[]" value="<?= $img ?>">
    <img src="<?= $img ?>">
</div>
<?php endforeach; ?>
</div>

<button type="submit">Download Selected</button>
</form>

</body>
</html>
