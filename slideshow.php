<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow Slideshow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div id="stage"></div>

<!-- QR Toggle Button -->
<div id="qrToggleBtn">QR</div>

<!-- QR Overlay -->
<div id="qrOverlay">
    <img
        src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=/upload.php"
        alt="Upload QR Code"
    >
    <div class="qr-label">Upload Photos</div>
</div>

<script src="assets/app.js"></script>
</body>
</html>
