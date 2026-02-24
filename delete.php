<?php
// Read raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(["success" => false]);
    exit;
}

$uploadDir = __DIR__ . "/uploads/";

foreach ($data as $file) {
    // Security: prevent path traversal
    $file = basename($file);
    $filePath = $uploadDir . $file;

    if (is_file($filePath)) {
        unlink($filePath);
    }
}

echo json_encode(["success" => true]);
