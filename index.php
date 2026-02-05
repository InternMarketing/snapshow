<?php
session_start();
$_SESSION['viewer'] = true;
?>
<!DOCTYPE html>
<html>
<head>
  <title>SnapShow Upload</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1>Upload Your Photos 📸</h1>

<form action="upload.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="images[]" multiple accept="image/*" required>
  <br><br>
  <button type="submit">Upload</button>
</form>

</body>
</html>