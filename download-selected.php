<?php
$event = $_POST['event'] ?? $_GET['event'] ?? 'SnapShow';
$all = isset($_GET['all']);

$files = $all
    ? array_merge(glob("uploads/*.jpg"), glob("uploads/*.jpeg"), glob("uploads/*.png"), glob("uploads/*.webp"))
    : ($_POST['files'] ?? []);

if (!$files) exit("No files");

$tmp = sys_get_temp_dir() . "/snapshow_" . time() . ".zip";
$zip = new PharData($tmp, 0, null, Phar::ZIP);

$i = 1;
foreach ($files as $file) {
    $path = $all ? $file : "uploads/" . basename($file);
    if (!file_exists($path)) continue;
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $zip->addFile($path, "{$event}_{$i}.{$ext}");
    $i++;
}

header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=snapshow.zip");
readfile($tmp);
unlink($tmp);
exit;
