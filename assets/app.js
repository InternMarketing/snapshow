let selected = new Set();
let refreshTimer = null;

const gallery = document.getElementById("gallery");

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

function bindThumbs() {
    document.querySelectorAll(".thumb").forEach((el, i) => {
        el.onclick = () => toggleSelect(el);
        el.ondblclick = () => openModal(i);
    });
}

function toggleSelect(el) {
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

document.getElementById("downloadBtn")?.addEventListener("click", () => {
    [...selected].forEach(f => {
        const a = document.createElement("a");
        a.href = "uploads/" + f;
        a.download = f;
        a.click();
    });
});

startRefresh();
bindThumbs();

/* MODAL */
const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");
let index = 0;
let imgs = [];

function openModal(i) {
    imgs = [...document.querySelectorAll(".thumb img")].map(i => i.src);
    index = i;
    modal.style.display = "flex";
    modalImg.src = imgs[index];
}

document.getElementById("close").onclick = () => modal.style.display = "none";
document.getElementById("prev").onclick = () => modalImg.src = imgs[--index < 0 ? index = imgs.length - 1 : index];
document.getElementById("next").onclick = () => modalImg.src = imgs[++index % imgs.length];
