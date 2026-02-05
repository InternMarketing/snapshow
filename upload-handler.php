<?php
$dir = __DIR__ . "/uploads/";
if (!is_dir($dir)) mkdir($dir);

foreach ($_FILES["images"]["tmp_name"] as $i => $tmp) {
  $name = time() . "_" . basename($_FILES["images"]["name"][$i]);
  move_uploaded_file($tmp, $dir . $name);
}