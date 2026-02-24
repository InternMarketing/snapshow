let images = [];
let index = 0;

async function poll() {
    const res = await fetch("feed.php");
    const data = await res.json();

    // normalize feed.php output (object or string)
    const normalized = data.map(item =>
        typeof item === "string" ? item : item.file
    );

    if (JSON.stringify(normalized) !== JSON.stringify(images)) {
        images = normalized;
        index = images.length - 1;
        updateImage();
    }
}

function updateImage() {
    if (!images.length) return;
    document.getElementById("slideImage").src = images[index];
}

setInterval(poll, 3000);
poll();

document.getElementById("toggleQR").onclick = () => {
    document.getElementById("qrWrapper").classList.toggle("hidden");
};

new QRCode(document.getElementById("qrcode"), {
    text: location.origin + location.pathname.replace("slideshow.php", "upload.php"),
    width: 160,
    height: 160
});
