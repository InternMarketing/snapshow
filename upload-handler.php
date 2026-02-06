<?php
echo 'HANDLER HIT';
exit;
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// uploads folder is at SITE ROOT
$dir = realpath(__DIR__ . '/../uploads');
if ($dir === false) {
  $dir = __DIR__ . '/../uploads';
  mkdir($dir, 0777, true);
}

if (!isset($_FILES['images'])) {
  exit('No files received');
}

foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
  if (!is_uploaded_file($tmp)) continue;

  $name = time() . '_' . basename($_FILES['images']['name'][$i]);
  $target = $dir . '/' . $name;

  if (!move_uploaded_file($tmp, $target)) {
    exit('Failed to move uploaded file');
  }
}

echo 'OK';
