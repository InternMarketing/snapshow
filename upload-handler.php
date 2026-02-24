<?php
$maxSize = 5 * 1024 * 1024; // 5MB
$allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

$response = [
    "success" => false,
    "errors" => []
];

if (empty($_FILES['images'])) {
    $response["errors"][] = "No valid images uploaded";
    echo json_encode($response);
    exit;
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
    if (!is_uploaded_file($tmp)) continue;

    $size = $_FILES['images']['size'][$i];
    $type = mime_content_type($tmp);

    if ($size > $maxSize) {
        $response["errors"][] = "Image too large (max 5MB)";
        continue;
    }

    if (!in_array($type, $allowedTypes)) {
        $response["errors"][] = "Invalid file type";
        continue;
    }

    $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
    $name = time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;

    move_uploaded_file($tmp, "uploads/" . $name);
}

if (empty($response["errors"])) {
    $response["success"] = true;
}

echo json_encode($response);
