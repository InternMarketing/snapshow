const container = document.getElementById("image-container");

if (!container) {
  console.error("SnapShow: image-container not found");
}

let images = [];
let index = 0;

async function fetchImages() {
  try {
    const res = await fetch("feed.php");
    images = await res.json();
  } catch (e) {
    console.error("Failed to load images", e);
  }
}

function showNextImage() {
  if (!container || images.length === 0) return;

  container.innerHTML = "";

  const img = document.createElement("img");
  img.src = images[index];
  img.className = "stage-image";

  container.appendChild(img);

  index = (index + 1) % images.length;
}

async function loop() {
  await fetchImages();
  showNextImage();
  setTimeout(loop, 3000);
}

loop();
