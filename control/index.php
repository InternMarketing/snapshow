<?php
$event = $_GET['event'] ?? 'SnapShow';

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

<form id="controlForm" method="post" action="../download-selected.php">
<input type="hidden" name="event" value="<?= htmlspecialchars($event) ?>">

<div class="grid">
<?php foreach ($images as $i => $img): ?>
<div class="item">
    <input type="checkbox" name="files[]" value="<?= basename($img) ?>">
    <img src="<?= htmlspecialchars($img) ?>" data-index="<?= $i ?>">
</div>
<?php endforeach; ?>
</div>

<div class="actions">
    <button type="submit">Download Selected</button>
    <button type="button" id="deleteSelected">Delete Selected</button>
    <a href="../download-selected.php?all=1&event=<?= urlencode($event) ?>">Download ALL (ZIP)</a>
</div>
</form>

<!-- IMAGE MODAL (UNCHANGED) -->
<div id="modal">
    <span id="close">×</span>
    <span id="prev">❮</span>
    <img id="modalImg">
    <span id="next">❯</span>
</div>

<script>
const gallery = document.querySelector(".grid");
const deleteBtn = document.getElementById("deleteSelected");

function selectedFiles() {
    return [...gallery.querySelectorAll("input:checked")].map(cb => cb.value);
}

deleteBtn.onclick = () => {
    const files = selectedFiles();
    if (!files.length) return alert("No files selected");

    if (!confirm("Delete selected images?")) return;

    fetch("../delete.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(files)
    })
    .then(r => r.json())
    .then(() => location.reload());
};
</script>

<script src="control.js"></script>
</body>
</html>
