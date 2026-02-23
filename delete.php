<?php

if (!isset($_POST['files']) || !is_array($_POST['files'])) {
    header("Location: /control.php");
    exit;
}

$uploadDir = __DIR__ . "/uploads/";

foreach ($_POST['files'] as $file) {

    // Security: remove any path injection
    $file = basename($file);

    $filePath = $uploadDir . $file;

    if (is_file($filePath)) {
        unlink($filePath);
    }
}

header("Location: /control.php");
exit;
