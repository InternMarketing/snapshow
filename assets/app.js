document.addEventListener('DOMContentLoaded', () => {
    const slideshow = document.getElementById('slideshow');

    if (!slideshow) {
        console.error('❌ #slideshow NOT FOUND');
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

    /* 🔒 FORCE SIZE: ~HALF SCREEN */
    img.style.maxWidth = '60vw';
    img.style.maxHeight = '75vh';
    img.style.width = 'auto';
    img.style.height = 'auto';
    img.style.objectFit = 'contain';

    slideshow.appendChild(img);

    index = (index + 1) % images.length;
}

    fetchImages().then(() => {
        showNextImage();
        setInterval(showNextImage, 3000);
    });

    setInterval(fetchImages, 5000);
});