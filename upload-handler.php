<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * uploads folder at project root:
 * https://snapshow-swqb.onrender.com/uploads/
 */
$dir = __DIR__ . '/uploads';

// create uploads folder if missing
if (!is_dir($dir)) {
  mkdir($dir, 0777, true);
}

// no files?
if (!isset($_FILES['images'])) {
  exit('No files received');
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
  if (!is_uploaded_file($tmp)) continue;

  $safeName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['images']['name'][$i]);
  $name = time() . '_' . $safeName;

  move_uploaded_file($tmp, $dir . '/' . $name);
}

echo 'OK';
