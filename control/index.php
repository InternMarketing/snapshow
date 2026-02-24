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
    <input type="checkbox" name="select[]">
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
        show();
    };
});

function show() {
    modal.classList.remove("hidden");
    modalImg.src = imgs[idx].src;
}

document.getElementById("close").onclick = () => modal.classList.add("hidden");
document.getElementById("prev").onclick = () => { idx = (idx - 1 + imgs.length) % imgs.length; show(); };
document.getElementById("next").onclick = () => { idx = (idx + 1) % imgs.length; show(); };

modal.onclick = e => { if (e.target === modal) modal.classList.add("hidden"); };
</script>

</body>
</html>
