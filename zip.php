<?php
session_start();

if (!isset($_SESSION['event_name'])) {
    http_response_code(403);
    exit('No active event');
}

$event = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_SESSION['event_name']);

$uploadDir = __DIR__ . '/uploads';
$exportDir = __DIR__ . '/exports';

if (!is_dir($exportDir)) {
    mkdir($exportDir, 0777, true);
}

$tarPath = "$exportDir/snapshow_$event.tar";
$gzPath  = "$tarPath.gz";

/* Clean old archives */
@unlink($tarPath);
@unlink($gzPath);

/* Collect files in stable order */
$files = glob($uploadDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
sort($files);

try {
    $phar = new PharData($tarPath);

    $i = 1;
    foreach ($files as $file) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $newName = sprintf('%s_%04d.%s', $event, $i, $ext);
        $phar->addFile($file, $newName);
        $i++;
    }

    $phar->compress(Phar::GZ);
    unset($phar);
    unlink($tarPath);

} catch (Exception $e) {
    http_response_code(500);
    exit('Archive generation failed');
}

/* Download */
header('Content-Type: application/gzip');
header('Content-Disposition: attachment; filename="snapshow_' . $event . '.tar.gz"');
header('Content-Length: ' . filesize($gzPath));
readfile($gzPath);
exit;
