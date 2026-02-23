<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/upload.css">
</head>
<body>

    <main class="upload-container">

        <h1>Upload Your Photos</h1>

        <!-- ACTION BUTTONS -->
        <div class="action-buttons">
            <button id="showQR" type="button">
                Show QR Code
            </button>

            <a href="gallery.php" class="gallery-btn">
                View Gallery
            </a>
        </div>

        <!-- QR CODE -->
        <div id="qrWrapper">
            <div id="qrCode"></div>
        </div>

        <!-- UPLOAD FORM -->
        <form id="uploadForm" enctype="multipart/form-data">
            <input
                type="file"
                id="images"
                name="images[]"
                accept="image/*"
                multiple
                required
            >

            <button type="submit">
                Upload Images
            </button>
        </form>

        <p id="status"></p>

    </main>

    <!-- Scripts -->
    <script src="assets/qrcode.min.js"></script>
    <script src="assets/upload.js"></script>

</body>
</html>
