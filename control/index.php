<script>
const imgs = [...document.querySelectorAll(".item img")];
let idx = 0;

const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");

imgs.forEach(img => {
    img.onclick = () => {
        idx = +img.dataset.index;
        openModal();
    };
});

function openModal() {
    modal.classList.add("active");
    modalImg.src = imgs[idx].src;
}

function closeModal() {
    modal.classList.remove("active");
}

document.getElementById("close").onclick = closeModal;
document.getElementById("prev").onclick = () => {
    idx = (idx - 1 + imgs.length) % imgs.length;
    openModal();
};
document.getElementById("next").onclick = () => {
    idx = (idx + 1) % imgs.length;
    openModal();
};

modal.onclick = e => {
    if (e.target === modal) closeModal();
};
</script>
