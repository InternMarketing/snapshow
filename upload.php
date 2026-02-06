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

  <form action="upload-handler.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple accept="image/*" required>
    <br><br>
    <button type="submit">Upload</button>
  </form>

  <br>

  <!-- QR BUTTON -->
  <button id="showQR">Show QR Code</button>
</div>

<!-- FULLSCREEN QR OVERLAY -->
<div id="qrOverlay">
  <div class="qr-box">
    <!-- IMPORTANT: THIS MUST BE A DIV, NOT CANVAS -->
    <div id="qrCanvas"></div>
    <p>Scan to upload photos</p>
    <button id="closeQR">Close</button>
  </div>
</div>

<!-- ✅ QR LIBRARY (MUST LOAD FIRST) -->
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

<!-- ✅ YOUR SCRIPT (AFTER QR LIBRARY) -->
<script src="assets/upload.js"></script>

</body>
</html>
