<?php
session_start();
if (!isset($_SESSION['event_name'])) {
    header('Location: /event.php');
    exit;
}

$EVENT = $_SESSION['event_name'];
$uploadDir = __DIR__ . '/uploads';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$counterFile = $uploadDir . '/.counter';
$counter = file_exists($counterFile) ? (int)file_get_contents($counterFile) : 0;

if (!isset($_FILES['images'])) {
    header('Location: /upload.php');
    exit;
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
    if (!is_uploaded_file($tmp)) continue;

    $counter++;
    $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
    $name = sprintf('%s_%04d.%s', $EVENT, $counter, $ext);

    move_uploaded_file($tmp, $uploadDir . '/' . $name);
}

file_put_contents($counterFile, $counter);

/* 🔁 redirect back instead of echo */
header('Location: /upload.php?success=1');
exit;
