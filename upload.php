<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SnapShow Upload</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin:0;
  font-family:system-ui;
  background:#0f172a;
  color:#fff;
  display:flex;
  justify-content:center;
  align-items:center;
  min-height:100vh;
  text-align:center;
}

.container {
  background:#1e293b;
  padding:30px;
  border-radius:16px;
  width:90%;
  max-width:400px;
}

input[type="file"] {
  margin:20px 0;
}

button {
  padding:12px 18px;
  font-size:16px;
  border:none;
  border-radius:10px;
  cursor:pointer;
  margin:8px 4px;
}

.upload-btn {
  background:#38bdf8;
  color:#000;
}

.gallery-btn {
  background:#22c55e;
  color:#000;
}

#status {
  margin-top:15px;
  font-size:14px;
}
</style>
</head>
<body>

<div class="container">
  <h2>📸 Upload Your Photos</h2>

  <form id="uploadForm" enctype="multipart/form-data">
    <input 
      type="file" 
      name="photos[]" 
      multiple 
      accept="image/*" 
      required
    >
    <br>
    <button type="submit" class="upload-btn">
      Upload
    </button>
  </form>

  <div id="status"></div>

  <br>

  <a href="/gallery.php">
    <button class="gallery-btn">
      View Gallery
    </button>
  </a>
</div>

<script>
document.getElementById("uploadForm").addEventListener("submit", async function(e) {
  e.preventDefault();

  const status = document.getElementById("status");
  status.textContent = "Uploading...";

  const formData = new FormData(this);

  try {
    const res = await fetch("upload-handler.php", {
      method: "POST",
      body: formData
    });

    const data = await res.json();

    if (data.success) {
      status.textContent = "✅ Upload successful!";
      this.reset();
    } else {
      status.textContent = "❌ Upload failed.";
    }

  } catch (err) {
    status.textContent = "❌ Upload error.";
  }
});
</script>

</body>
</html>
