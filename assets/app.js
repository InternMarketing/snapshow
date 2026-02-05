let cinema;
let images = [];

/* INIT */
document.addEventListener("DOMContentLoaded", () => {
  cinema = document.querySelector(".cinema");
  fetchImages();
  setInterval(fetchImages, 2000);
});

/* FETCH */
async function fetchImages() {
  try {
    const res = await fetch("feed.php");
    const data = await res.json();

    if (JSON.stringify(data) !== JSON.stringify(images)) {
      images = data;
      renderSlides();
    }
  } catch (e) {
    console.error(e);
  }
}

/* RENDER — STACK EVERYTHING */
function renderSlides() {
  cinema.innerHTML = "";

  const total = images.length;

  images.forEach((src, index) => {
    const slide = document.createElement("div");
    slide.className = "slide";

    const img = document.createElement("img");
    img.src = src;

    /* STAGE DEPTH */
    const depth = total - index - 1;
    const scale = 1 - depth * 0.06;
    const offset = depth * 5;

    slide.style.transform =
      `scale(${scale}) translateY(${offset}%)`;

    slide.style.zIndex = index + 1;

    slide.appendChild(img);
    cinema.appendChild(slide);
  });
}
