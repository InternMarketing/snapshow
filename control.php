session_start();
if (!isset($_SESSION['event_name'])) {
  header('Location: /event.php');
  exit;
}
$EVENT = $_SESSION['event_name'];
<?php
$images = glob("uploads/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SnapShow Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {
      background:#111;
      color:#fff;
      font-family: system-ui, sans-serif;
      padding:20px;
    }
    img {
      width:160px;
      height:160px;
      object-fit:cover;
      margin:8px;
      border-radius:12px;
      box-shadow:0 10px 20px rgba(0,0,0,.5);
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

<h1>📂 SnapShow Admin</h1>
<p>Private link – keep it secret</p>

<form method="POST" action="/delete.php">
<?php foreach ($images as $img): ?>
  <label>
    <input type="checkbox" name="files[]" value="<?= basename($img) ?>">
    <br>
    <img src="<?= htmlspecialchars($img) ?>">
  </label>
<?php endforeach; ?>

<br><br>
<button type="submit">🗑 Delete Selected</button>
</form>

</body>
</html>
