const stage = document.getElementById("stage");
let images = [];
let index = 0;

function loadImages() {
    fetch("feed.php")
        .then(r => r.json())
        .then(list => {
            images = list;
            if (images.length && !stage.querySelector("img")) {
                showImage(0);
            }
        });
}

function showImage(i) {
    stage.innerHTML = "";
    const img = document.createElement("img");
    img.src = "uploads/" + images[i];
    stage.appendChild(img);
}

setInterval(() => {
    if (!images.length) return;
    index = (index + 1) % images.length;
    showImage(index);
}, 5000);

loadImages();
setInterval(loadImages, 3000);
