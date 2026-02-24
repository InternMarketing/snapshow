<?php
// upload.php
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Upload</title>
</head>
<body>

<form action="upload-handler.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="event_name" value="SnapShow">
    <input type="file" name="images[]" multiple required>
    <button type="submit">Upload</button>
</form>

<a href="#" id="viewGallery">Go to Gallery</a>

<script>
document.getElementById("viewGallery").addEventListener("click", function (e) {
    e.preventDefault();
    const eventInput = document.querySelector('input[name="event_name"]');
    const eventName = eventInput && eventInput.value ? eventInput.value : "SnapShow";
    window.location.href = "gallery.php?event=" + encodeURIComponent(eventName);
});
</script>

</body>
</html>
