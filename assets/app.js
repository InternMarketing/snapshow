const stage = document.querySelector(".stage");
let images = [];
let currentIndex = 0;

/* ===== FETCH IMAGE LIST ===== */
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

/* ===== RENDER SLIDES ===== */
function renderSlides() {
  stage.innerHTML = "";

  images.forEach((src, i) => {
    const slide = document.createElement("div");
    slide.className = "slide loading";

    const img = document.createElement("img");
    img.src = src;

    img.onload = () => {
      slide.classList.remove("loading");
    };

    slide.appendChild(img);
    stage.appendChild(slide);
  });

  currentIndex = 0;
  activateSlide(0);
}

/* ===== ACTIVATE SLIDE ===== */
function activateSlide(index) {
  const slides = document.querySelectorAll(".slide");

  slides.forEach((slide, i) => {
    slide.classList.remove("active", "back");

    if (i === index) {
      slide.classList.add("active");
    } else if (i === index - 1) {
      slide.classList.add("back");
    }
  });
}

/* ===== LOOP SLIDES ===== */
function nextSlide() {
  if (images.length === 0) return;

  currentIndex++;
  if (currentIndex >= images.length) {
    currentIndex = 0;
  }

  activateSlide(currentIndex);
}

/* ===== TIMING ===== */
setInterval(fetchImages, 2000);     // live update
setInterval(nextSlide, 8000);       // stage duration
