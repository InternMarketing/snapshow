<?php
if (!isset($_POST['files']) || !is_array($_POST['files'])) {
    exit('No files selected');
}

$zip = new ZipArchive();
$zipName = 'snapshow_selected_' . date('Ymd_His') . '.zip';
$zipPath = sys_get_temp_dir() . '/' . $zipName;

if ($zip->open($zipPath, ZipArchive::CREATE) !== true) {
    exit('Cannot create ZIP');
}

foreach ($_POST['files'] as $file) {
    $file = basename($file);
    $path = __DIR__ . '/uploads/' . $file;
    if (is_file($path)) {
        $zip->addFile($path, $file);
    }
}

$zip->close();

header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipName . '"');
header('Content-Length: ' . filesize($zipPath));
readfile($zipPath);
unlink($zipPath);
exit;
