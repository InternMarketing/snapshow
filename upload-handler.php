<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$dir = __DIR__ . '/uploads';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

if (empty($_FILES['images'])) {
    die('No files received');
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
    if (!is_uploaded_file($tmp)) continue;

    $safe = preg_replace('/[^a-zA-Z0-9._-]/', '_', $_FILES['images']['name'][$i]);
    $name = time() . '_' . $safe;

    move_uploaded_file($tmp, $dir . '/' . $name);
}

header('Location: upload.php?success=1');
exit;

