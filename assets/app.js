const stage = document.getElementById("stage");
let currentIndex = 0;
let images = [];

function loadImages() {
    fetch("/feed.php")
        .then(r => r.json())
        .then(list => {
            images = list;
            if (images.length && !stage.querySelector("img")) {
                showImage(0);
            }
        });
}

function showImage(index) {
    stage.innerHTML = "";

    const img = document.createElement("img");
    img.src = "/uploads/" + images[index];   // ✅ ABSOLUTE PATH
    img.alt = "";

    stage.appendChild(img);
}

setInterval(() => {
    if (!images.length) return;
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
}, 5000);

loadImages();
setInterval(loadImages, 3000);

/* ========================= */
/* QR TOGGLE LOGIC (ISOLATED) */
/* ========================= */

const qrBtn = document.getElementById("qrToggleBtn");
const qrOverlay = document.getElementById("qrOverlay");

if (qrBtn && qrOverlay) {
    qrBtn.addEventListener("click", () => {
        qrOverlay.style.display =
            qrOverlay.style.display === "block" ? "none" : "block";
    });
}
