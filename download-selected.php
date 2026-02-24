<?php
if (empty($_POST['files']) || !is_array($_POST['files'])) {
    exit('No files selected');
}

$files = $_POST['files'];
$zipName = 'snapshow_' . date('Ymd_His') . '.zip';
$tmpPath = sys_get_temp_dir() . '/' . $zipName;

// Remove old archive if exists
if (file_exists($tmpPath)) {
    unlink($tmpPath);
}

// Create ZIP using PharData (ZipArchive-free)
$zip = new PharData($tmpPath);

foreach ($files as $file) {
    // Security: only allow uploads directory
    if (strpos($file, 'uploads/') !== 0) continue;
    if (!file_exists($file)) continue;

    $zip->addFile($file, basename($file));
}

// Force download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipName . '"');
header('Content-Length: ' . filesize($tmpPath));

readfile($tmpPath);
unlink($tmpPath);
exit;
