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

        // HARD RESET — ONE IMAGE ONLY
        slideshow.innerHTML = '';

        const slide = document.createElement('div');
        slide.className = 'slide show';

        const img = document.createElement('img');
        img.src = images[index];
        img.alt = 'SnapShow Image';

        slide.appendChild(img);
        slideshow.appendChild(slide);

        index = (index + 1) % images.length;
    }

    fetchImages().then(() => {
        showNextImage();
        setInterval(showNextImage, 3500);
    });

    setInterval(fetchImages, 5000);
});
