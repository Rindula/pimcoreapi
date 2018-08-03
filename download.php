<?php
include "includes.php";

$id = $_GET["id"];

$json = file_get_contents("http://".PIMCORE_HOST."/webservice/rest/asset/id/$id?apikey=".API_KEY);
$obj = json_decode($json, true);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header("Content-disposition: attachment; filename=\"" . $obj["data"]["filename"] . "\""); 

$width = 1500;

// Loading the image and getting the original dimensions
$image = imagecreatefromstring(base64_decode($obj["data"]["data"]));
$orig_width = imagesx($image);
$orig_height = imagesy($image);

// Calc the new height
$height = (($orig_height * $width) / $orig_width);

// Create new image to display
$new_image = imagecreatetruecolor($width, $height);

// Create new image with changed dimensions
imagecopyresized($new_image, $image,
    0, 0, 0, 0,
    $width, $height,
    $orig_width, $orig_height);

// Print image
imagejpeg($new_image);
exit;