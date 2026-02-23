<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/upload.css">

    <style>
        /* Safety: ensure QR is not hidden */
        #qrCode {
            margin-top: 20px;
            display: none;
            text-align: center;
        }
    </style>
</head>
<body>

    <main class="upload-container">

        <h1>Upload Your Photos</h1>

        <!-- SHOW QR BUTTON -->
        <button id="showQR" type="button">
            Show QR Code
        </button>

        <!-- QR CODE CONTAINER -->
        <div id="qrCode"></div>

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

        <!-- STATUS MESSAGE -->
        <p id="status"></p>

    </main>

    <!-- IMPORTANT: QR LIBRARY MUST LOAD FIRST -->
    <script src="assets/qrcode.min.js"></script>

    <!-- THEN upload.js -->
    <script src="assets/upload.js"></script>

</body>
</html>
