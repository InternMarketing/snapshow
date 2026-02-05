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
    <br>
    <button type="submit">Upload</button>
  </form>

  <br>

  <!-- QR BUTTON -->
  <button id="showQR">Show QR Code</button>

</div>

<!-- QR OVERLAY -->
<div id="qrOverlay">
  <div class="qr-box">
    <canvas id="qrCanvas"></canvas>
    <p>Scan to upload photos</p>
    <button id="closeQR">Close</button>
  </div>
</div>

<script src="assets/qrcode.min.js"></script>
<script src="assets/upload.js"></script>

</body>
</html>
