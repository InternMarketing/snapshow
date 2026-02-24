<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Slideshow</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div id="stage"></div>

<div id="qrToggleBtn">QR</div>
<div id="qrOverlay">
    <div id="qrcode"></div>
</div>

<script src="assets/qrcode.min.js"></script>
<script>
new QRCode(document.getElementById("qrcode"), location.origin + "/upload.php");
document.getElementById("qrToggleBtn").onclick = () => {
    qrOverlay.style.display = qrOverlay.style.display === "block" ? "none" : "block";
};
</script>

<script src="assets/app.js"></script>
</body>
</html>
