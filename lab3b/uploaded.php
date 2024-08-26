<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Create upload directory if not exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0755, true);
}

// Helper function to handle file upload
function handle_file_upload($file_info, $type) {
    global $upload_directory, $relative_path;

    $files_count = count($file_info['name']);

    for ($i = 0; $i < $files_count; $i++) {
        $file_name = basename($file_info['name'][$i]);
        $temporary_file = $file_info['tmp_name'][$i];
        $uploaded_file = $upload_directory . $file_name;

        if (move_uploaded_file($temporary_file, $uploaded_file)) {
            switch ($type) {
                case 'text':
                    $file_content = file_get_contents($uploaded_file);
                    echo "<h3>$file_name (Text File)</h3>";
                    echo "<textarea cols='70' rows='10'>$file_content</textarea><br>";
                    break;

                case 'pdf':
                    echo "<h3>$file_name (PDF File)</h3>";
                    echo "<embed src='{$relative_path}$file_name' width='600' height='400' alt='pdf'><br>";
                    break;

                case 'audio':
                    echo "<h3>$file_name (Audio File)</h3>";
                    echo "<audio controls>
                            <source src='{$relative_path}$file_name' type='audio/mpeg'>
                          Your browser does not support the audio element.
                          </audio><br>";
                    break;

                case 'image':
                    echo "<h3>$file_name (Image File)</h3>";
                    echo "<img src='{$relative_path}$file_name' alt='image' /><br>";
                    break;

                case 'video':
                    echo "<h3>$file_name (Video File)</h3>";
                    echo "<video width='600' height='400' controls>
                            <source src='{$relative_path}$file_name' type='video/mp4'>
                          Your browser does not support the video tag.
                          </video><br>";
                    break;
            }
        } else {
            echo "Failed to upload $file_name<br>";
        }
    }
}

if (!empty($_FILES['text_file']['name'][0])) {
    handle_file_upload($_FILES['text_file'], 'text');
}

if (!empty($_FILES['pdf_file']['name'][0])) {
    handle_file_upload($_FILES['pdf_file'], 'pdf');
}

if (!empty($_FILES['audio_file']['name'][0])) {
    handle_file_upload($_FILES['audio_file'], 'audio');
}

if (!empty($_FILES['image_file']['name'][0])) {
    handle_file_upload($_FILES['image_file'], 'image');
}

if (!empty($_FILES['video_file']['name'][0])) {
    handle_file_upload($_FILES['video_file'], 'video');
}
?>