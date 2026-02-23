<?php
header('Content-Type: application/json');

$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

/* =========================
   NORMALIZE FILE INPUT
========================= */
if (!isset($_FILES['images'])) {
    echo json_encode([
        'success' => false,
        'error' => 'No files received'
    ]);
    exit;
}

$files = $_FILES['images'];
$fileCount = is_array($files['name']) ? count($files['name']) : 1;

/* =========================
   EVENT NAME (OPTIONAL)
========================= */
$eventName = 'SnapShow';
if (!empty($_POST['event_name'])) {
    $eventName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_POST['event_name']);
}
$eventName = trim($eventName, '_');

/* =========================
   PROCESS FILES
========================= */
$saved = 0;
$timestamp = time();

for ($i = 0; $i < $fileCount; $i++) {

    $name     = is_array($files['name'])     ? $files['name'][$i]     : $files['name'];
    $tmp      = is_array($files['tmp_name']) ? $files['tmp_name'][$i] : $files['tmp_name'];
    $error    = is_array($files['error'])    ? $files['error'][$i]    : $files['error'];

    if ($error !== UPLOAD_ERR_OK || !is_uploaded_file($tmp)) {
        continue;
    }

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png','webp'])) {
        continue;
    }

    $newName = sprintf(
        '%s_%s_%02d.%s',
        $eventName,
        $timestamp,
        $saved + 1,
        $ext
    );

    if (move_uploaded_file($tmp, $uploadDir . $newName)) {
        $saved++;
    }
}

if ($saved === 0) {
    echo json_encode([
        'success' => false,
        'error' => 'No valid images uploaded'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'count' => $saved
]);
