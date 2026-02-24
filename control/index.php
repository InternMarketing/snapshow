<?php
$event = $_GET['event'] ?? 'event';

$images = array_merge(
    glob("../uploads/*.jpg"),
    glob("../uploads/*.jpeg"),
    glob("../uploads/*.png"),
    glob("../uploads/*.webp")
);
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

<form method="post" action="../download-selected.php?event=<?= urlencode($event) ?>">
<div class="grid">
<?php foreach ($images as $i => $img): ?>
<div class="item">
    <input type="checkbox" name="files[]" value="<?= htmlspecialchars($img) ?>">
    <img src="<?= htmlspecialchars($img) ?>" data-index="<?= $i ?>">
</div>
<?php endforeach; ?>
</div>

<div class="actions">
    <button type="submit">Download Selected</button>
    <a href="../download-selected.php?all=1&event=<?= urlencode($event) ?>">Download ALL (ZIP)</a>
</div>
</form>

<!-- MODAL (KEEP) -->
<div id="modal">
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
        modal.classList.add("active");
        modalImg.src = imgs[idx].src;
    };
});

document.getElementById("close").onclick = () => modal.classList.remove("active");
document.getElementById("prev").onclick = () => { idx=(idx-1+imgs.length)%imgs.length; modalImg.src=imgs[idx].src; };
document.getElementById("next").onclick = () => { idx=(idx+1)%imgs.length; modalImg.src=imgs[idx].src; };

modal.onclick = e => { if (e.target === modal) modal.classList.remove("active"); };
</script>

</body>
</html>
