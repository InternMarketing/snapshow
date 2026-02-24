let currentIndex = 0;
let images = [];

async function fetchImages() {
    const res = await fetch("feed.php");
    images = await res.json();
}

function showImage() {
    if (!images.length) return;
    document.getElementById("slideImage").src = images[currentIndex];
}

async function poll() {
    await fetchImages();
    showImage();
}

setInterval(poll, 3000);
poll();

document.getElementById("toggleQR").onclick = () => {
    document.getElementById("qrWrapper").classList.toggle("hidden");
};
