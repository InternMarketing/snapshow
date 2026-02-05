<?php
header("Content-Type: application/json");

$files = [];
$dir = __DIR__ . "/uploads";

if (is_dir($dir)) {
  foreach (scandir($dir) as $f) {
    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $f)) {
      $files[] = "/snapshow/uploads/" . $f;
    }
  }
}

echo json_encode($files);