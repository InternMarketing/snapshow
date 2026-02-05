document.addEventListener('DOMContentLoaded', () => {
    const slideshow = document.getElementById('slideshow');
    if (!slideshow) return;

    let images = [];
    let index = 0;

    async function fetchImages() {
        try {
            const res = await fetch('feed.php');
            const data = await res.json();
            if (Array.isArray(data)) images = data;
        } catch (e) {
            console.error(e);
        }
    }

    function showNextImage() {
        if (!images.length) return;

        // remove previous slide
        const old = slideshow.querySelector('.slide');
        if (old) {
            old.classList.remove('show');
            setTimeout(() => old.remove(), 1000);
        }

        // create new slide
        const slide = document.createElement('div');
        slide.className = 'slide';

        const img = document.createElement('img');
        img.src = images[index];
        img.alt = 'SnapShow Image';

        slide.appendChild(img);
        slideshow.appendChild(slide);

        // trigger animation
        requestAnimationFrame(() => {
            slide.classList.add('show');
        });

        index = (index + 1) % images.length;
    }

    fetchImages().then(() => {
        showNextImage();
        setInterval(showNextImage, 3500);
    });

    setInterval(fetchImages, 5000);
});
