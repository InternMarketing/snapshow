const cinema = document.querySelector(".cinema");
let images = [];
let currentIndex = 0;

/* ===== FETCH IMAGES ===== */
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

  images.forEach((src, i) => {
    const slide = document.createElement("div");
    slide.className = "slide";

    const img = document.createElement("img");
    img.src = src;

    slide.appendChild(img);
    cinema.appendChild(slide);
  });

  currentIndex = 0;
  activateSlide(0);
}

/* ===== ACTIVATE ===== */
function activateSlide(index) {
  const slides = document.querySelectorAll(".slide");

  slides.forEach((s, i) => {
    s.classList.toggle("active", i === index);
  });
}

/* ===== LOOP ===== */
function nextSlide() {
  if (images.length === 0) return;

  currentIndex = (currentIndex + 1) % images.length;
  activateSlide(currentIndex);
}

/* ===== TIMERS ===== */
setInterval(fetchImages, 2000);
setInterval(nextSlide, 8000);
