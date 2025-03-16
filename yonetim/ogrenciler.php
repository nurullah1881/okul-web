<?php
session_start();
if (!isset($_SESSION['yonetici']) || $_SESSION['yonetici'] != "evet") {
    header("Location: giris.php");
    exit;
}

require "./database.php";

if (isset($_POST['ekle'])) {
    $no = $conn->real_escape_string($_POST['no']);
    $ad = $conn->real_escape_string($_POST['ad']);
    $soyad = $conn->real_escape_string($_POST['soyad']);
    $kimlik = $conn->real_escape_string($_POST['kimlik']);
    $cinsiyet = $conn->real_escape_string($_POST['cinsiyet']);
    $sinif = $conn->real_escape_string($_POST['sinif']);
    $anne_ad = $conn->real_escape_string($_POST['anne_ad']);
    $baba_ad = $conn->real_escape_string($_POST['baba_ad']);
    $sql = "INSERT INTO ogrenciler (no, ad, soyad, kimlik, cinsiyet, sinif, anne_ad, baba_ad) VALUES ('$no', '$ad', '$soyad', '$kimlik', '$cinsiyet', '$sinif', '$anne_ad', '$baba_ad')";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['sil'])) {
    $no = $_GET['sil'];
    $sql = "DELETE FROM ogrenciler WHERE no = '$no'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['duzenle'])) {
    $no = $conn->real_escape_string($_POST['no']);
    $ad = $conn->real_escape_string($_POST['ad']);
    $soyad = $conn->real_escape_string($_POST['soyad']);
    $kimlik = $conn->real_escape_string($_POST['kimlik']);
    $cinsiyet = $conn->real_escape_string($_POST['cinsiyet']);
    $sinif = $conn->real_escape_string($_POST['sinif']);
    $anne_ad = $conn->real_escape_string($_POST['anne_ad']);
    $baba_ad = $conn->real_escape_string($_POST['baba_ad']);
    $sql = "UPDATE ogrenciler SET ad = '$ad', soyad = '$soyad', kimlik = '$kimlik', cinsiyet = '$cinsiyet', sinif = '$sinif', anne_ad = '$anne_ad', baba_ad = '$baba_ad' WHERE no = '$no'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$ogrenciler = $conn->query("SELECT * FROM ogrenciler")->fetch_all(MYSQLI_ASSOC);
$duzenlenecek = isset($_GET['duzenle']) ? $conn->query("SELECT * FROM ogrenciler WHERE no = '$_GET[duzenle]'")->fetch_assoc() : null;
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
        <h3 class="fw-bold">Öğrenci Ekle</h3>
        <form action="#" method="POST" class="mb-5">
            <div class="mb-3">
                <input type="text" class="form-control" name="no" placeholder="Öğrenci No" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['no']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="ad" placeholder="Ad" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['ad']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="soyad" placeholder="Soyad" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['soyad']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="kimlik" placeholder="Kimlik No" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['kimlik']) : '' ?>" required>
                <select class="form-control mt-2" name="cinsiyet" required>
                    <option value="Erkek" <?= $duzenlenecek && $duzenlenecek['cinsiyet'] == 'Erkek' ? 'selected' : '' ?>>Erkek</option>
                    <option value="Kız" <?= $duzenlenecek && $duzenlenecek['cinsiyet'] == 'Kız' ? 'selected' : '' ?>>Kız</option>
                </select>
                <input type="text" class="form-control mt-2" name="sinif" placeholder="Sınıf" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['sinif']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="anne_ad" placeholder="Anne Adı" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['anne_ad']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="baba_ad" placeholder="Baba Adı" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['baba_ad']) : '' ?>" required>
            </div>
            <button type="submit" name="<?= $duzenlenecek ? 'duzenle' : 'ekle' ?>" class="btn btn-primary"><?= $duzenlenecek ? 'Kaydet' : 'Ekle' ?></button>
        </form>

        <h3 class="fw-bold">Öğrenciler</h3>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Kimlik</th>
                    <th>Cinsiyet</th>
                    <th>Sınıf</th>
                    <th>Anne Adı</th>
                    <th>Baba Adı</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ogrenciler as $ogrenci): ?>
                    <tr>
                        <td><?= htmlspecialchars($ogrenci['no']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['ad']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['soyad']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['kimlik']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['cinsiyet']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['sinif']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['anne_ad']) ?></td>
                        <td><?= htmlspecialchars($ogrenci['baba_ad']) ?></td>
                        <td>
                            <a href="?sil=<?= $ogrenci['no'] ?>" class="text-danger"><i class="bi bi-trash"></i></a>
                            <a href="?duzenle=<?= $ogrenci['no'] ?>" class="text-primary ms-2"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>