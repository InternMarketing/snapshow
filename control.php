<?php
$uploadDir = __DIR__ . "/uploads/";
$images = glob($uploadDir . "*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SnapShow Control Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  background:#111;
  color:#fff;
  font-family:system-ui;
  padding:20px;
}

h1 {
  margin-bottom:20px;
}

.grid {
  display:flex;
  flex-wrap:wrap;
  gap:12px;
}

label {
  display:inline-block;
  text-align:center;
  background:#1a1a1a;
  padding:10px;
  border-radius:12px;
}

img {
  width:160px;
  height:160px;
  object-fit:cover;
  border-radius:12px;
  display:block;
  margin-top:6px;
}

button {
  padding:10px 16px;
  font-size:16px;
  border-radius:8px;
  border:none;
  cursor:pointer;
  margin:6px 6px 0 0;
}

.actions {
  margin-top:20px;
}
</style>
</head>
<body>

<h1>🎛 SnapShow Control Panel</h1>

<form method="POST">

<div class="grid">
<?php foreach ($images as $img): ?>
  <label>
    <input type="checkbox" name="files[]" value="<?= basename($img) ?>">
    <img src="/uploads/<?= htmlspecialchars(basename($img)) ?>">
  </label>
<?php endforeach; ?>
</div>

<div class="actions">
  <button formaction="/delete.php">🗑 Delete Selected</button>
  <button formaction="/download-selected.php">⬇ Download Selected</button>
</div>

</form>

<br>

<a href="/download.php">
  <button>📦 Download ALL as ZIP</button>
</a>

</body>
</html>
