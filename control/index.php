<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="control.css">
</head>
<body>

<h1>SnapShow Control Panel</h1>

<div class="top-actions">
    <a href="../zip.php" class="zip-btn">Download ALL Photos (ZIP)</a>
    <button id="deleteSelected">Delete Selected</button>
    <button id="downloadSelected">Download Selected</button>
</div>

<div id="gallery" class="gallery"></div>

<script src="control.js"></script>
</body>
</html>
