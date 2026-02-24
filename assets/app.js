let images = [];
let index = 0;

async function poll() {
    const res = await fetch("feed.php");
    const data = await res.json();

    if (JSON.stringify(data) !== JSON.stringify(images)) {
        images = data;
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
