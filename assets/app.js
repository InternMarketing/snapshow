let cinema;
let images = [];
let currentIndex = 0;

/* ===== INIT ===== */
document.addEventListener("DOMContentLoaded", () => {
  cinema = document.querySelector(".cinema");

  if (!cinema) {
    console.error("Cinema container not found");
    return;
  }

  fetchImages();
  setInterval(fetchImages, 2000);
  setInterval(nextSlide, 8000);
});

/* ===== FETCH ===== */
async function fetchImages() {
  try {
    const res = await fetch("feed.php");
    const data = await res.json();

    if (JSON.stringify(data) !== JSON.stringify(images)) {
      images = data;
      renderSlides();
    }
  } catch (e) {
    console.error("Feed error:", e);
  }
}

/* ===== RENDER ===== */
function renderSlides() {
  cinema.innerHTML = "";

  images.forEach((src) => {
    const slide = document.createElement("div");
    slide.className = "slide";

    const img = document.createElement("img");
    img.src = src;

    slide.appendChild(img);
    cinema.appendChild(slide);
  });

  currentIndex = 0;
  updateStage();
}

/* ===== UPDATE STAGE ===== */
function updateStage() {
  const slides = cinema.querySelectorAll(".slide");
  const total = slides.length;

  if (total === 0) return;

  slides.forEach((slide, i) => {
    slide.classList.remove("active", "prev");

    if (i === currentIndex) {
      slide.classList.add("active");
    }

    /* only add prev if more than 1 image */
    if (total > 1 && i === (currentIndex - 1 + total) % total) {
      slide.classList.add("prev");
    }
  });
}

/* ===== NEXT SLIDE ===== */
function nextSlide() {
  if (images.length === 0) return;

  currentIndex = (currentIndex + 1) % images.length;
  updateStage();
}
