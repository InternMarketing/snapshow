<?php
header('Content-Type: application/json');

$files = [];
$dir = __DIR__ . '/uploads';

if (is_dir($dir)) {
    foreach (glob($dir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) as $f) {
        $files[] = '/uploads/' . basename($f) . '?v=' . filemtime($f);
    }
}

echo json_encode($files);
