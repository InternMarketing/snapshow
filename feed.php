<?php
header("Content-Type: application/json");

$dir = __DIR__ . "/uploads";
$files = [];

if (is_dir($dir)) {
  foreach (scandir($dir) as $file) {
    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
      $files[] = "/uploads/" . $file; // ✅ ROOT path
    }
  }
}

echo json_encode($files);
