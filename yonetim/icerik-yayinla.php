<?php 

session_start();
if(!isset($_SESSION['yonetici']) || !$_SESSION['yonetici'] == "evet"){
    header("Location: giris.php");
    exit;
}

require "./database.php";    
require '../sistem/sayfaolustur.php';

$sql = "SELECT * FROM icerik"; 
$result = $conn->query($sql);

if (isset($_POST['metin']) && !isset($_GET['duzenle'])) {
    $baslik = $_POST['baslik'];
    $metin = $_POST['metin'];
    $zaman = date("Y-m-d H:i:s");

    $link = sayfaolusturr($baslik);
    $baslik = $conn->real_escape_string($baslik);
    $metin = $conn->real_escape_string($metin);
    $zaman = $conn->real_escape_string($zaman);
    $link = $conn->real_escape_string($link);
    
    $sql2 = "INSERT INTO icerik (baslik, metin, zaman, link) VALUES ('$baslik', '$metin', '$zaman', '$link')";
    $conn->query($sql2);

    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];

    $sql = "SELECT link FROM icerik WHERE id = '$id'";
    $dosya = "";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dosya = $row["link"];
    }

    $sql1 = "DELETE FROM icerik WHERE id = '$id'";
    $conn->query($sql1);

    if ($dosya && file_exists($_SERVER['DOCUMENT_ROOT'] . $dosya)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . $dosya);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
if (isset($_GET['duzenle'])) {
    $d_id = $_GET['duzenle'];
    $sql_duzenle = "SELECT * FROM icerik WHERE id = '$d_id'";
    $result_duzenle = $conn->query($sql_duzenle);
    $duzenlenecek = $result_duzenle->fetch_assoc();

    if (isset($_POST['metin'])) {
        $baslik = $_POST['baslik'];
        $metin = $_POST['metin'];
        $zaman = date("Y-m-d H:i:s");
        $link = sayfaolusturr($baslik, $metin);
        $sql3 = "UPDATE icerik SET baslik = '$baslik', metin = '$metin', link = '$link' WHERE id = '$d_id'";
        $conn->query($sql3);
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/yonetim/stil.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body>
    <?php require 'nav.php'; ?>

    <main class="container mt-5">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <h3 class="fw-bold">İçerik Yayınla</h3>
                <hr>
                <input type="text" class="form-control mb-3" id="baslik" name="baslik" placeholder="Başlığı buraya yazın.." value="<?php if(isset($duzenlenecek)) echo $duzenlenecek['baslik']; ?>" required>
                <textarea class="form-control" id="summernote" name="metin"><?php if(isset($duzenlenecek)) echo htmlspecialchars($duzenlenecek['metin']); ?></textarea>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Yayınla</button>
            </div>
        </form>

        <table class="mt-5 mb-5 table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Başlık</th>
                    <th scope="col">Metin</th>
                    <th scope="col">Bağlantı</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($icerik = $result->fetch_assoc()): ?>
                        <tr>
                            <th scope="row"><?php echo $icerik["id"]; ?></th>
                            <td><?php echo $icerik["baslik"]; ?></td>
                            <td><?php echo $icerik["metin"]; ?></td>
                            <td><a href="<?php echo $icerik["link"]; ?>"><?php echo $icerik["link"]; ?></a></td>
                            <td>
                                <a href="?sil=<?php echo $icerik["id"]; ?>"><i class="bi bi-trash"></i></a>
                                <a href="?duzenle=<?php echo $icerik["id"]; ?>"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <th scope="row">İçerik yok.</th>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <hr>
        <footer>
            <p class="footer-yazi">© 2025 Türkiye Cumhuriyeti Milli Eğitim Bakanlığı</p>
            <p class="footer-yazi">Tüm hakları saklıdır. Gizlilik, Kullanım ve Telif Hakları bildiriminde belirtilen kurallar çerçevesinde hizmet sunulmaktadır.</p>
        </footer>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 400, // Yükseklik ayarı
                lang: 'tr-TR', // Türkçe
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        let data = new FormData();
                        data.append("file", files[0]);
                        $.ajax({
                            url: 'upload.php',
                            method: 'POST',
                            data: data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(url) {
                                $('#summernote').summernote('insertImage', url);
                            },
                            error: function() {
                                alert('Resim yüklenemedi!');
                            }
                        });
                    }
                }
            });
        });
    </script>
</body>
</html><?php $conn->close(); ?>