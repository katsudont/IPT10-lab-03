<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Handle Image File
$uploaded_image_file = $upload_directory . basename($_FILES['image_file']['name']);
$temporary_image_file = $_FILES['image_file']['tmp_name'];

if (move_uploaded_file($temporary_image_file, $uploaded_image_file)) {
    echo "<img src='{$relative_path}" . basename($_FILES['image_file']['name']) . "' alt='image' />";
} else {
    echo 'Failed to upload image file';
}



echo '<pre>';
var_dump($_FILES);
exit;
