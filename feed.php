<?php
header("Content-Type: application/json");

$UPLOAD_DIR = '/app/uploads';
$images = [];

foreach (glob($UPLOAD_DIR . '/*.{jpg,jpeg,png,webp,gif}', GLOB_BRACE) as $file) {
    $images[] = '/uploads/' . basename($file);
}

sort($images);
echo json_encode($images);
