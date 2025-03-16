<?php 

date_default_timezone_set('Europe/Istanbul');

try {
    $conn = new mysqli("localhost", "root", "", "okul");

    if (!$conn) {
        throw new Exception("Veritabanı bağlantısı kurulamadı");
    }
    if ($conn->connect_error) {
        throw new Exception("Bağlantı hatası: " . $conn->connect_error);
    }
} catch (Exception $e) {
    echo "<h1>Veri tabanı hatası meydana geldi.</h1>";
    echo $e->getMessage() . ".";
    error_log($e->getMessage());
    exit;
}

?>