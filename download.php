<?php
$zipPath = __DIR__ . '/latest.zip';

if (!file_exists($zipPath)) {
    header('Location: /zip.php');
    exit;
}

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="snapshow_latest.zip"');
header('Content-Length: ' . filesize($zipPath));
readfile($zipPath);
exit;
