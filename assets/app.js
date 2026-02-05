document.addEventListener('DOMContentLoaded', () => {
    const slideshow = document.getElementById('slideshow');

    if (!slideshow) {
        console.error('#slideshow not found');
        return;
    }

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

        slideshow.innerHTML = '';

        const img = document.createElement('img');
        img.src = images[index];
        img.alt = 'SnapShow Image';

        slideshow.appendChild(img);

        index = (index + 1) % images.length;
    }

    fetchImages().then(() => {
        showNextImage();
        setInterval(showNextImage, 3000);
    });

    setInterval(fetchImages, 5000);
});
