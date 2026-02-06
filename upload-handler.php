<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$dir = __DIR__ . '/uploads';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

if (!isset($_FILES['images'])) {
    header('Location: upload.php?error=1');
    exit;
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
    if (!is_uploaded_file($tmp)) continue;

    $name = time() . '_' . basename($_FILES['images']['name'][$i]);
    move_uploaded_file($tmp, $dir . '/' . $name);
}

header('Location: upload.php?success=1');
exit;
