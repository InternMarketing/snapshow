<?php
$images = glob("uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SnapShow Control</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background:#111;
  color:#fff;
  font-family:system-ui;
  padding:20px;
}
img {
  width:160px;
  height:160px;
  object-fit:cover;
  margin:8px;
  border-radius:12px;
}
label {
  display:inline-block;
  text-align:center;
}
button {
  padding:10px 16px;
  font-size:16px;
  border-radius:8px;
  border:none;
  cursor:pointer;
  margin:6px;
}
</style>
</head>
<body>

<h1>🎛 SnapShow Control Panel</h1>

<form method="POST">

<?php foreach ($images as $img): ?>
<label>
<input type="checkbox" name="files[]" value="<?= basename($img) ?>"><br>
<img src="<?= htmlspecialchars($img) ?>">
</label>
<?php endforeach; ?>

<br><br>

<button formaction="/delete.php">🗑 Delete Selected</button>
<button formaction="/download-selected.php">⬇ Download Selected</button>

</form>

<br>
<a href="/download.php">
<button>📦 Download ALL as ZIP</button>
</a>

</body>
</html>
