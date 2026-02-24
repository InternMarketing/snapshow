let images = [];
let index = 0;

async function poll() {
    const res = await fetch("feed.php");
    const data = await res.json();

    // trust feed.php exactly as-is
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

// QR toggle only — no side effects
document.getElementById("toggleQR").onclick = () => {
    document.getElementById("qrWrapper").classList.toggle("hidden");
};
