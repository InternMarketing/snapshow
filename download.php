<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);
if (!is_array($data) || empty($data)) {
    http_response_code(400);
    exit;
}

$event = $_SESSION['event_name'] ?? 'event';
$zipName = preg_replace('/[^a-zA-Z0-9_-]/', '', $event) . "_selected_images.zip";

$tmp = tempnam(sys_get_temp_dir(), "snapshow_");
$zip = new ZipArchive();
$zip->open($tmp, ZipArchive::CREATE);

$uploadDir = __DIR__ . "/uploads/";

foreach ($data as $file) {
    $file = basename($file);
    $path = $uploadDir . $file;
    if (is_file($path)) {
        $zip->addFile($path, $file);
    }
}

$zip->close();

header("Content-Type: application/zip");
header("Content-Disposition: attachment; filename=\"$zipName\"");
header("Content-Length: " . filesize($tmp));

readfile($tmp);
unlink($tmp);
exit;
