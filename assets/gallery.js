const imgs = [...document.querySelectorAll(".cell img")];
let idx = 0;
const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");

imgs.forEach(img => {
    img.onclick = () => {
        idx = +img.dataset.index;
        modal.classList.add("active");
        modalImg.src = imgs[idx].src;
    };
});

document.getElementById("close").onclick = () => modal.classList.remove("active");
document.getElementById("prev").onclick = () => {
    idx = (idx - 1 + imgs.length) % imgs.length;
    modalImg.src = imgs[idx].src;
};
document.getElementById("next").onclick = () => {
    idx = (idx + 1) % imgs.length;
    modalImg.src = imgs[idx].src;
};

modal.onclick = e => {
    if (e.target === modal) modal.classList.remove("active");
};
