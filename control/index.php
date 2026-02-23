<?php
$images = glob(__DIR__ . '/../uploads/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
sort($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SnapShow Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="control.css">
</head>
<body>

<h1>SnapShow Control Panel</h1>

<div class="top-actions">
    <a href="../zip.php" class="zip-btn">
        Download ALL Photos (ZIP)
    </a>
</div>

<div class="gallery">
    <?php foreach ($images as $img): ?>
        <div class="item">
            <img src="<?php echo htmlspecialchars('../uploads/' . basename($img)); ?>" alt="">
            <button class="delete-btn" data-file="<?php echo htmlspecialchars(basename($img)); ?>">
                Delete
            </button>
        </div>
    <?php endforeach; ?>
</div>

<script src="control.js"></script>
</body>
</html>
