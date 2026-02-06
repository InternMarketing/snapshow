<?php
session_start();
if (!isset($_SESSION['event_name'])) exit;

$zipPath = __DIR__ . '/latest.zip';
$zip = new ZipArchive;
$zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

foreach (glob("uploads/*.{jpg,jpeg,png,webp}", GLOB_BRACE) as $file) {
    $zip->addFile($file, basename($file));
}

$zip->close();
