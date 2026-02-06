<?php
$uploadDir = __DIR__ . '/uploads';

if (!isset($_POST['files']) || !is_array($_POST['files'])) {
    header('Location: control.php');
    exit;
}

foreach ($_POST['files'] as $file) {
    $file = basename($file); // security
    $path = $uploadDir . '/' . $file;

    if (is_file($path)) {
        unlink($path);
    }
}

header('Location: control.php');
exit;
