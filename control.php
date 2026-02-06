<?php
session_start();
if (!isset($_SESSION['event_name'])) {
    header('Location: /event.php');
    exit;
}

$images = glob("uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
$EVENT = $_SESSION['event_name'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SnapShow Control</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body { background:#111;color:#fff;font-family:system-ui;padding:20px }
img { width:160px;height:160px;object-fit:cover;margin:8px;border-radius:12px }
label { display:inline-block;text-align:center }
button { padding:10px 16px;font-size:16px;border-radius:8px;border:none;cursor:pointer }
</style>
</head>
<body>

<h1>📂 SnapShow Control</h1>
<p>Event: <strong><?= htmlspecialchars($EVENT) ?></strong></p>

<form method="POST" action="/delete.php">
<?php foreach ($images as $img): ?>
<label>
<input type="checkbox" name="files[]" value="<?= basename($img) ?>"><br>
<img src="<?= htmlspecialchars($img) ?>">
</label>
<?php endforeach; ?>

<br><br>
<button type="submit">🗑 Delete Selected</button>
</form>

<br><br>

<a href="/download.php">
<button>⬇ Download ALL as ZIP</button>
</a>

<script>
setInterval(() => {
    fetch('/zip.php');
}, 180000); // every 3 minutes
</script>

</body>
</html>
