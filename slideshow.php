<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Slideshow</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div id="stage">
    <img id="slideImage">
</div>

<button id="toggleQR">QR</button>

<div id="qrWrapper" class="hidden">
    <div id="qrcode"></div>
</div>

<script src="assets/qrcode.min.js"></script>
<script src="assets/app.js"></script>

<script>
document.getElementById("toggleQR").onclick = () => {
    document.getElementById("qrWrapper").classList.toggle("hidden");
};

window.addEventListener("load", () => {
    new QRCode(document.getElementById("qrcode"), {
        text: location.origin + "/upload.php",
        width: 160,
        height: 160
    });
});
</script>

</body>
</html>
