<?php
session_start();
if (!isset($_SESSION['event_name'])) {
    header('Location: /event.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SnapShow Upload</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/upload.css">
</head>
<body>

<div class="upload-page">
  <h1>Upload Your Photos 📸</h1>

  <?php if (isset($_GET['success'])): ?>
    <p style="color:#4ade80;">✅ Upload successful! You can upload more.</p>
  <?php endif; ?>

  <form action="upload-handler.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple accept="image/*" required>
    <br><br>
    <button type="submit">Upload</button>
  </form>

  <br>

  <!-- NAV BUTTON -->
  <a href="gallery.php">
    <button>🖼 View Gallery</button>
  </a>

  <br><br>

  <!-- QR BUTTON -->
  <button id="showQR">Show QR Code</button>
</div>

<!-- FULLSCREEN QR OVERLAY -->
<div id="qrOverlay">
  <div class="qr-box">
    <div id="qrCanvas"></div>
    <p>Scan to upload photos</p>
    <button id="closeQR">Close</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script src="assets/upload.js"></script>

</body>
</html>
