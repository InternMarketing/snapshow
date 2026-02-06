<?php
header('Content-Type: application/json');

$uploadDir = __DIR__ . '/uploads';
$out = [];

if (is_dir($uploadDir)) {
    foreach (glob($uploadDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE) as $f) {
        $out[] = '/uploads/' . basename($f) . '?v=' . filemtime($f);
    }
}

echo json_encode($out);
