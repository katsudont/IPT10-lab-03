<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Handle Text File
$uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
$temporary_file = $_FILES['text_file']['tmp_name'];

if (move_uploaded_file($temporary_file, $uploaded_text_file)) {
    $text_file_content = file_get_contents($uploaded_text_file, 'r');
    ?>
    <textarea cols="70" rows="30"><?php echo $text_file_content; ?></textarea>
    <?php
} else {
    echo 'Failed to upload file';
}
// Handle PDF File
$uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
$temporary_pdf_file = $_FILES['pdf_file']['tmp_name'];

if (move_uploaded_file($temporary_pdf_file, $uploaded_pdf_file)) {
    echo "<embed src='{$relative_path}" . basename($_FILES['pdf_file']['name']) . "' width='600' height='400' alt='pdf' />";
} else {
    echo 'Failed to upload PDF file';
}

// Handle Audio File
$uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
$temporary_audio_file = $_FILES['audio_file']['tmp_name'];

if (move_uploaded_file($temporary_audio_file, $uploaded_audio_file)) {
    echo "<audio controls>
            <source src='{$relative_path}" . basename($_FILES['audio_file']['name']) . "' type='audio/mpeg'>
          Your browser does not support the audio element.
          </audio>";
} else {
    echo 'Failed to upload audio file';
}


// Handle Image File
$uploaded_image_file = $upload_directory . basename($_FILES['image_file']['name']);
$temporary_image_file = $_FILES['image_file']['tmp_name'];

if (move_uploaded_file($temporary_image_file, $uploaded_image_file)) {
    echo "<img src='{$relative_path}" . basename($_FILES['image_file']['name']) . "' alt='image' />";
} else {
    echo 'Failed to upload image file';
}

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