const gallery = document.getElementById("gallery");
if (!gallery) return;

let selected = new Set();
let refreshTimer = null;

function isMobile() {
    return /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
}

/* REFRESH */
function startRefresh() {
    if (refreshTimer) return;
    refreshTimer = setInterval(loadGallery, 3000);
}

function stopRefresh() {
    clearInterval(refreshTimer);
    refreshTimer = null;
}

function loadGallery() {
    if (selected.size) return;

    fetch(location.href)
        .then(r => r.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, "text/html");
            gallery.innerHTML = doc.getElementById("gallery").innerHTML;
            bindThumbs();
        });
}

/* SELECTION */
function bindThumbs() {
    document.querySelectorAll(".thumb").forEach((el, i) => {
        el.onclick = () => toggle(el);
        el.ondblclick = () => openModal(i);
    });
}

function toggle(el) {
    const file = el.dataset.file;
    if (selected.has(file)) {
        selected.delete(file);
        el.classList.remove("selected");
    } else {
        selected.add(file);
        el.classList.add("selected");
        stopRefresh();
    }

    if (!selected.size) startRefresh();
}

/* DELETE */
document.getElementById("deleteBtn")?.addEventListener("click", () => {
    fetch("../delete.php", {
        method: "POST",
        body: JSON.stringify([...selected])
    }).then(() => {
        selected.clear();
        loadGallery();
        startRefresh();
    });
});

/* DOWNLOAD */
document.getElementById("downloadBtn")?.addEventListener("click", () => {
    if (!selected.size) return;

    if (isMobile()) {
        [...selected].forEach(f => {
            const a = document.createElement("a");
            a.href = "../uploads/" + f;
            a.download = f;
            a.click();
        });
    } else {
        fetch("../download.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify([...selected])
        })
        .then(r => r.blob())
        .then(blob => {
            const a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = "download.zip";
            a.click();
            URL.revokeObjectURL(a.href);
        });
    }

    selected.clear();
    startRefresh();
});

/* MODAL */
const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");
let imgs = [];
let idx = 0;

function openModal(i) {
    imgs = [...document.querySelectorAll(".thumb img")].map(i => i.src);
    idx = i;
    modal.style.display = "flex";
    modalImg.src = imgs[idx];
}

close.onclick = () => modal.style.display = "none";
prev.onclick = () => modalImg.src = imgs[(--idx + imgs.length) % imgs.length];
next.onclick = () => modalImg.src = imgs[++idx % imgs.length];

bindThumbs();
startRefresh();
