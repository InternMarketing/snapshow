<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo '<pre>';

echo "FILES:\n";
var_dump($_FILES);

$dir = __DIR__ . '/uploads';
echo "\nUpload dir: $dir\n";

if (!is_dir($dir)) {
    echo "Creating uploads dir...\n";
    mkdir($dir, 0777, true);
}

if (!is_writable($dir)) {
    exit("Uploads directory NOT writable\n");
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
    echo "\nProcessing file $i\n";

    if (!is_uploaded_file($tmp)) {
        echo "Not an uploaded file\n";
        continue;
    }

    $name = time() . '_' . basename($_FILES['images']['name'][$i]);
    $target = $dir . '/' . $name;

    echo "Moving to $target\n";

    if (move_uploaded_file($tmp, $target)) {
        echo "SUCCESS\n";
    } else {
        echo "FAILED\n";
    }
}

echo "\nDone\n";
