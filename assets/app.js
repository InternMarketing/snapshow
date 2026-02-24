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
    document.getElementById("slideImage").src = "uploads/" + images[index];
}

setInterval(poll, 3000);
poll();

document.getElementById("toggleQR").onclick = () => {
    document.getElementById("qrWrapper").classList.toggle("hidden");
};

window.addEventListener("load", () => {
    new QRCode(document.getElementById("qrcode"), {
        text: location.origin + "/upload.php",
        width: 160,
        height: 160
    });
});
