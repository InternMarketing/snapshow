<?php
$images = glob("../uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html>
<head>
<title>Control Panel</title>
<link rel="stylesheet" href="control.css">
</head>
<body>

<h1>Control Panel</h1>

<div class="grid">
<?php foreach ($images as $i => $img): ?>
<div class="item">
    <input type="checkbox" class="selector">
    <img src="<?= $img ?>" data-index="<?= $i ?>">
</div>
<?php endforeach; ?>
</div>

<div id="modal" class="hidden">
    <span id="close">×</span>
    <span id="prev">❮</span>
    <img id="modalImg">
    <span id="next">❯</span>
</div>

<script>
const imgs = [...document.querySelectorAll(".item img")];
let idx = 0;

const modal = document.getElementById("modal");
const modalImg = document.getElementById("modalImg");

imgs.forEach(img => {
    img.onclick = () => {
        idx = +img.dataset.index;
        open();
    };
});

function open() {
    modal.classList.remove("hidden");
    modalImg.src = imgs[idx].src;
}

function close() {
    modal.classList.add("hidden");
}

document.getElementById("close").onclick = close;
document.getElementById("prev").onclick = () => {
    idx = (idx - 1 + imgs.length) % imgs.length;
    open();
};
document.getElementById("next").onclick = () => {
    idx = (idx + 1) % imgs.length;
    open();
};

modal.onclick = e => {
    if (e.target === modal) close();
};
</script>

</body>
</html>
