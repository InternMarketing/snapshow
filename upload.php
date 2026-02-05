<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Share Your Photos</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/snapshow/assets/upload.css">
</head>
<body>

<div class="container">

  <h1>📸 Share Your Photos</h1>

  <label class="upload-btn">
    Select Photos
    <input type="file" id="fileInput" multiple accept="image/*">
  </label>

  <div id="progress"></div>

  <div id="thankyou" class="hidden">
    <h2>✨ Thank you for sharing!</h2>
    <p>You can download all shared photos below.</p>
  </div>

  <div id="gallery"></div>

  <button id="downloadSelected" class="hidden">
    ⬇ Download Selected
  </button>

</div>

<script src="/snapshow/assets/upload.js"></script>
</body>
</html>