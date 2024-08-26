<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Handle Video File
$uploaded_video_file = $upload_directory . basename($_FILES['video_file']['name']);
$temporary_video_file = $_FILES['video_file']['tmp_name'];

if (move_uploaded_file($temporary_video_file, $uploaded_video_file)) {
    echo "<video width='600' height='400' controls>
            <source src='{$relative_path}" . basename($_FILES['video_file']['name']) . "' type='video/mp4'>
          Your browser does not support the video tag.
          </video>";
} else {
    echo 'Failed to upload video file';
}



echo '<pre>';
var_dump($_FILES);
exit;
