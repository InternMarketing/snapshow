<?php
$event = $_GET['event'] ?? 'event';
$all = isset($_GET['all']);

$files = $all
    ? array_merge(glob("uploads/*.jpg"), glob("uploads/*.jpeg"), glob("uploads/*.png"), glob("uploads/*.webp"))
    : ($_POST['files'] ?? []);

if (!$files) exit("No files");

$tmp = sys_get_temp_dir() . "/snapshow_" . time() . ".zip";
$zip = new PharData($tmp);

$i = 1;
foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $zip->addFile($file, "{$event}_{$i}.{$ext}");
    $i++;
}

header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=snapshow.zip");
readfile($tmp);
unlink($tmp);
exit;
