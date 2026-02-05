<?php
$uploadDir = realpath(__DIR__ . '/../uploads');

if (!isset($_POST['action'], $_POST['files']) || !is_array($_POST['files'])) {
  http_response_code(400);
  exit('Bad request');
}

$validFiles = [];

foreach ($_POST['files'] as $file) {
  $safeName = basename($file);
  $fullPath = realpath($uploadDir . '/' . $safeName);

  if ($fullPath && strpos($fullPath, $uploadDir) === 0) {
    $validFiles[] = $fullPath;
  }
}

if ($_POST['action'] === 'delete') {
  foreach ($validFiles as $file) {
    unlink($file);
  }
  echo 'OK';
  exit;
}

if ($_POST['action'] === 'download') {
  $zip = new ZipArchive();
  $tmp = tempnam(sys_get_temp_dir(), 'snapshow_');
  $zip->open($tmp, ZipArchive::CREATE);

  foreach ($validFiles as $file) {
    $zip->addFile($file, basename($file));
  }

  $zip->close();

  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="snapshow_images.zip"');
  header('Content-Length: ' . filesize($tmp));

  readfile($tmp);
  unlink($tmp);
  exit;
}
