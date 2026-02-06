<?php
session_start();

$UPLOAD_DIR = '/app/uploads';
$PUBLIC_PATH = '/uploads';

if (!is_dir($UPLOAD_DIR)) {
    mkdir($UPLOAD_DIR, 0777, true);
}

if (!isset($_FILES['images'])) {
    echo "No files received";
    exit;
}

$EVENT = $_SESSION['event_name'] ?? 'event';

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
    if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) continue;

    $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
    $safeEvent = preg_replace('/[^a-zA-Z0-9_-]/', '_', $EVENT);

    $newName = time() . '_' . $safeEvent . '_' . $i . '.' . $ext;
    $dest = $UPLOAD_DIR . '/' . $newName;

    move_uploaded_file($tmp, $dest);
}

header("Location: upload.php?success=1");
exit;
