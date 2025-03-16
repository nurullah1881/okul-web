<?php
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $uploadDir = 'uploads/';
    $fileName = uniqid() . '_' . basename($file['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo '/yonetim/' . $targetPath;
    } else {
        http_response_code(500);
        echo 'Resim yüklenemedi!';
    }
}
?>