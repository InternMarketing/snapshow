let images = [];
let index = 0;

async function poll() {
    const res = await fetch("feed.php");
    const data = await res.json();

    if (!Array.isArray(data) || !data.length) return;

    if (JSON.stringify(data) !== JSON.stringify(images)) {
        images = data;
        index = 0;
    }
}

function showNext() {
    if (!images.length) return;
    document.getElementById("slideImage").src = "uploads/" + images[index];
    index = (index + 1) % images.length;
}

setInterval(poll, 3000);
setInterval(showNext, 5000);

poll();
