<?php
header('Content-Type: application/json');

$dir = __DIR__ . '/uploads';
$images = [];

if (is_dir($dir)) {
    foreach (scandir($dir) as $file) {
        if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
            $images[] = 'uploads/' . $file;
        }
    }
}

echo json_encode($images);
