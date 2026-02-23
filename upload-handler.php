<?php
header("Content-Type: application/json");

// Directory
$uploadDir = __DIR__ . "/uploads/";
if(!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

// Check files
if(empty($_FILES['photos'])){
    echo json_encode(["success"=>false,"error"=>"No files received"]);
    exit;
}

$uploaded = [];

// Loop through files
foreach($_FILES['photos']['tmp_name'] as $key=>$tmp){
    if($_FILES['photos']['error'][$key]!==UPLOAD_ERR_OK) continue;

    $original = basename($_FILES['photos']['name'][$key]);
    $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
    if(!in_array($ext,['jpg','jpeg','png','webp'])) continue;

    // Auto rename
    $newName = time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
    $dest = $uploadDir . $newName;

    if(move_uploaded_file($tmp,$dest)){
        $uploaded[] = $newName;
    }
}

echo json_encode(["success"=>true,"files"=>$uploaded]);
