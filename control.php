<?php
session_start();

if (!isset($_SESSION['event_name'])) {
    header('Location: /event.php');
    exit;
}

$EVENT = $_SESSION['event_name'];

$uploadDir = __DIR__ . '/uploads';
$images = [];

if (is_dir($uploadDir)) {
    foreach (glob($uploadDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) as $f) {
        $images[] = '/uploads/' . basename($f);
    }
}

sort($images);
?>
<!DOCTYPE html>
<html lang="en">
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
  margin:0;
}

/* STATUS BANNER */
.status-banner {
  position: sticky;
  top: 0;
  z-index: 1000;
  background: linear-gradient(90deg, #b45309, #f59e0b);
  color: #000;
  padding: 12px 16px;
  font-weight: 600;
  text-align: center;
}
.status-banner small {
  display:block;
  font-weight:400;
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
}
</style>
</head>
<body>

<div class="status-banner">
  ⚠️ Temporary Storage Active
  <small>Download the archive regularly during the event</small>
</div>

<h1>📂 SnapShow Control</h1>
<p>Event: <strong><?= htmlspecialchars($EVENT) ?></strong></p>

<form method="POST" action="/delete.php">
<?php foreach ($images as $img): ?>
  <label>
    <input type="checkbox" name="files[]" value="<?= basename($img) ?>"><br>
    <img src="<?= htmlspecialchars($img) ?>?v=<?= time() ?>">
  </label>
<?php endforeach; ?>

<br><br>
<button type="submit">🗑 Delete Selected</button>
</form>

<br><br>

<a href="/zip.php">
  <button type="button">⬇ Download ALL (.tar.gz)</button>
</a>

<script>
/* Auto-regenerate archive every 3 minutes */
setInterval(() => {
    fetch('/zip.php');
}, 180000);
</script>

</body>
</html>
