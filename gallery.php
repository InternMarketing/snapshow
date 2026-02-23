<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/gallery.css">
</head>
<body>

<h1>Gallery</h1>

<!-- NAVIGATION / ACTIONS -->
<div class="actions">
    <a href="upload.php" class="back-btn">← Back to Upload</a>
    <button id="downloadSelected">Download Selected</button>
</div>

<div id="gallery" class="gallery"></div>

<script>
const gallery = document.getElementById("gallery");
const downloadBtn = document.getElementById("downloadSelected");

function loadGallery() {
    fetch("/feed.php")
        .then(r => r.json())
        .then(images => {
            gallery.innerHTML = "";
            images.forEach(img => {
                const item = document.createElement("div");
                item.className = "item";

                item.innerHTML = `
                    <input type="checkbox" value="${img}">
                    <img src="/uploads/${img}" alt="">
                `;

                gallery.appendChild(item);
            });
        });
}

downloadBtn.onclick = () => {
    const files = Array.from(
        gallery.querySelectorAll("input[type=checkbox]:checked")
    ).map(cb => cb.value);

    if (!files.length) {
        alert("No files selected");
        return;
    }

    const form = document.createElement("form");
    form.method = "POST";
    form.action = "/download-selected.php";

    files.forEach(f => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "files[]";
        input.value = f;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
    form.remove();
};

loadGallery();
setInterval(loadGallery, 3000);
</script>

</body>
</html>
