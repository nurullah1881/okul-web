<?php 
session_start();
if (!isset($_SESSION['yonetici']) || $_SESSION['yonetici'] != "evet") {
    header("Location: giris.php");
    exit;
}

require "./database.php";

if (isset($_POST['ekle'])) {
    $duyuru = $conn->real_escape_string($_POST['duyurutext']);
    $href = $conn->real_escape_string($_POST['baglanti']);
    $sql = "INSERT INTO islemler (baslik, href) VALUES ('$duyuru', '$href')";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $sql = "DELETE FROM islemler WHERE id = '$id'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['duzenle'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $duyuru = $conn->real_escape_string($_POST['duyurutext']);
    $href = $conn->real_escape_string($_POST['baglanti']);
    $sql = "UPDATE islemler SET baslik = '$duyuru', href = '$href' WHERE id = '$id'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$duyurular = $conn->query("SELECT * FROM islemler");
$duyurular = $duyurular->fetch_all(MYSQLI_ASSOC);

$duzenlenecek = null;
if(isset($_GET['duzenle'])) {
    $sorgu = $conn->query("SELECT * FROM islemler WHERE id = '$_GET[duzenle]'");
    $duzenlenecek = $sorgu->fetch_assoc();
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
</head>
<body>
    <?php require 'nav.php'; ?>

    <main class="container mt-5">
        <form action="#" method="POST">
            <div class="mb-3">
                <h3 class="fw-bold">İşlemler</h3>
                <hr>
                <?php if ($duzenlenecek): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($duzenlenecek['id']) ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label for="duyurutext" class="form-label">Metin</label>
                    <input type="text" class="form-control" id="duyurutext" name="duyurutext" maxlength="50" placeholder="İşlem başlığını girin..." value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['baslik']) : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="baglanti" class="form-label">Bağlantı</label>
                    <input type="text" class="form-control" id="baglanti" name="baglanti" maxlength="255" placeholder="İşlem bağlantısı..." value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['href']) : '' ?>">
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit" name="<?= $duzenlenecek ? 'duzenle' : 'ekle' ?>"><?= $duzenlenecek ? 'Kaydet' : 'Yayınla' ?></button>
            </div>
        </form>
        
        <table class="mt-5 mb-5 table">
            <thead>
                <tr>
                    <th scope="col">Numara</th>
                    <th scope="col">İşlem Adı</th>
                    <th scope="col">Bağlantı</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($duyurular)): ?>
                    <tr>
                        <td colspan="4">İşlem yok.</td>
                    </tr>
                <?php else: ?>
                    <?php $sayac = 1; ?>
                    <?php foreach ($duyurular as $duyuru): ?>
                        <tr>
                            <th scope="row"><?= $sayac ?></th>
                            <td><?= htmlspecialchars($duyuru['baslik']) ?></td>
                            <td><?= empty($duyuru['href']) ? '-' : '<a href="' . htmlspecialchars($duyuru['href']) . '">' . htmlspecialchars($duyuru['href']) . '</a>' ?></td>
                            <td>
                                <a href="?sil=<?= htmlspecialchars($duyuru['id']) ?>" class="text-danger"><i class="bi bi-trash"></i></a>
                                <a href="?duzenle=<?= htmlspecialchars($duyuru['id']) ?>" class="text-primary ms-2"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                        <?php $sayac++; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <hr>
        <footer>
            <p class="footer-yazi">© 2025 Türkiye Cumhuriyeti Milli Eğitim Bakanlığı</p>
            <p class="footer-yazi">Tüm hakları saklıdır. Gizlilik, Kullanım ve Telif Hakları bildiriminde belirtilen kurallar çerçevesinde hizmet sunulmaktadır.</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>