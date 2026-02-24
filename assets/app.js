let images = [];
let index = 0;

async function poll() {
    const res = await fetch("feed.php");
    const data = await res.json();

    if (!Array.isArray(data) || !data.length) return;

    if (JSON.stringify(data) !== JSON.stringify(images)) {
        images = data;
        index = images.length - 1;
        show();
    }
}

function show() {
    if (!images.length) return;
    document.getElementById("slideImage").src = images[index];
}

setInterval(poll, 3000);
poll();

// QR toggle
document.getElementById("toggleQR").onclick = () => {
    document.getElementById("qrWrapper").classList.toggle("hidden");
};

// QR generation (safe DOM timing)
window.addEventListener("load", () => {
    new QRCode(document.getElementById("qrcode"), {
        text: location.origin + location.pathname.replace("slideshow.php", "upload.php"),
        width: 160,
        height: 160
    });
});
