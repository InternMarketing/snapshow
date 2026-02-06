<?php
header('Content-Type: application/json');

$dir = __DIR__ . '/uploads';
$files = [];

if (is_dir($dir)) {
    foreach (scandir($dir) as $f) {
        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $f)) {
            $files[] = '/uploads/' . $f;
        }
    }
}

sort($files);
echo json_encode($files);
