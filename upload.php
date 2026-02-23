<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SnapShow Upload</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/assets/upload.css">
<style>
#qrcode { display:none; margin:15px auto; }
</style>
</head>
<body>

<div class="container">
  <h2>📸 Upload Your Photos</h2>

  <button class="qr-btn" id="showQrBtn">Show QR Code</button>
  <div id="qrcode"></div>

  <form id="uploadForm" enctype="multipart/form-data">
    <input type="file" name="photos[]" multiple accept="image/*" required>
    <br>
    <button type="submit" class="upload-btn">Upload</button>
  </form>

  <div id="status"></div>

  <br>
  <a href="/gallery.php"><button class="gallery-btn">View Gallery</button></a>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script>
// Toggle QR code display
const qrBtn = document.getElementById("showQrBtn");
const qrContainer = document.getElementById("qrcode");
qrBtn.addEventListener("click", () => {
  if (qrContainer.style.display === "none") {
    qrContainer.style.display = "block";
    QRCode.toCanvas(qrContainer, window.location.href, function(error){
      if(error) console.error(error);
    });
  } else {
    qrContainer.style.display = "none";
  }
});

// Upload via AJAX
document.getElementById("uploadForm").addEventListener("submit", async function(e){
  e.preventDefault();
  const status = document.getElementById("status");
  status.textContent = "Uploading...";

  const formData = new FormData(this);

  try {
    const res = await fetch("upload-handler.php", { method:"POST", body: formData });
    const data = await res.json();

    if(data.success && data.files.length){
      status.textContent = `✅ Upload successful! ${data.files.length} file(s) uploaded.`;
      this.reset();
    } else if(!data.success){
      status.textContent = `❌ Upload failed: ${data.error || "Unknown error"}`;
    } else {
      status.textContent = "❌ No valid files uploaded.";
    }
  } catch(err){
    status.textContent = `❌ Upload error: ${err.message}`;
  }
});
</script>

</body>
</html>
