let selected = new Set();
let refreshTimer = null;

const gallery = document.getElementById("gallery");

function isMobile() {
    return (
        /Android|iPhone|iPad|iPod/i.test(navigator.userAgent) ||
        window.matchMedia("(max-width: 768px)").matches
    );
}

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
            const newGallery = doc.getElementById("gallery");
            if (newGallery) {
                gallery.innerHTML = newGallery.innerHTML;
                bindThumbs();
            }
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

/* DELETE */
document.getElementById("deleteBtn")?.addEventListener("click", () => {
    fetch("delete.php", {
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
        // 📱 Mobile → individual downloads
        [...selected].forEach(f => {
            const a = document.createElement("a");
            a.href = "uploads/" + f;
            a.download = f;
            document.body.appendChild(a);
            a.click();
            a.remove();
        });
        selected.clear();
        startRefresh();
    } else {
        // 🖥️ Desktop → ZIP
        fetch("download.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify([...selected])
        })
        .then(r => r.blob())
        .then(blob => {
            const a = document.createElement("a");
            a.href = URL.createObjectURL(blob);
            a.download = "selected_images.zip"; // server will override name
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(a.href);
            selected.clear();
            startRefresh();
        });
    }
});

startRefresh();
bindThumbs();

/* MODAL VIEWER */
const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");
let index = 0;
let imgs = [];

function openModal(i) {
    imgs = [...document.querySelectorAll(".thumb img")].map(img => img.src);
    index = i;
    modal.style.display = "flex";
    modalImg.src = imgs[index];
}

document.getElementById("close").onclick = () => modal.style.display = "none";
document.getElementById("prev").onclick = () => {
    index = (index - 1 + imgs.length) % imgs.length;
    modalImg.src = imgs[index];
};
document.getElementById("next").onclick = () => {
    index = (index + 1) % imgs.length;
    modalImg.src = imgs[index];
};
