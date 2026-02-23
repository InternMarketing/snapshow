const gallery = document.getElementById("gallery");
const deleteBtn = document.getElementById("deleteSelected");
const downloadBtn = document.getElementById("downloadSelected");

function loadImages() {
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
                    <a class="single-download" href="/download.php?file=${encodeURIComponent(img)}">
                        Download
                    </a>
                `;

                gallery.appendChild(item);
            });
        });
}

function getSelected() {
    return Array.from(
        gallery.querySelectorAll("input[type=checkbox]:checked")
    ).map(cb => cb.value);
}

deleteBtn.onclick = () => {
    const files = getSelected();
    if (!files.length) return alert("No files selected");

    if (!confirm("Delete selected images?")) return;

    fetch("/delete.php", {
        method: "POST",
        headers: {"Content-Type":"application/json"},
        body: JSON.stringify({ files })
    })
    .then(r => r.json())
    .then(() => loadImages());
};

downloadBtn.onclick = () => {
    const files = getSelected();
    if (!files.length) return alert("No files selected");

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

loadImages();
setInterval(loadImages, 3000);
