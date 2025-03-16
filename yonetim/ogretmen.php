<?php
session_start();
if (!isset($_SESSION['yonetici']) || $_SESSION['yonetici'] != "evet") {
    header("Location: giris.php");
    exit;
}

require "./database.php";

if (isset($_POST['ekle'])) {
    $kimlikno = $conn->real_escape_string($_POST['kimlikno']);
    $ad = $conn->real_escape_string($_POST['ad']);
    $soyad = $conn->real_escape_string($_POST['soyad']);
    $brans = $conn->real_escape_string($_POST['brans']);
    $sql = "INSERT INTO ogretmenler (kimlikno, ad, soyad, brans) VALUES ('$kimlikno', '$ad', '$soyad', '$brans')";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
if (isset($_GET['sil'])) {
    $kimlikno = $_GET['sil'];
    $sql = "DELETE FROM ogretmenler WHERE kimlikno = '$kimlikno'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['duzenle'])) {
    $kimlikno = $conn->real_escape_string($_POST['kimlikno']);
    $ad = $conn->real_escape_string($_POST['ad']);
    $soyad = $conn->real_escape_string($_POST['soyad']);
    $brans = $conn->real_escape_string($_POST['brans']);
    $sql = "UPDATE ogretmenler SET ad = '$ad', soyad = '$soyad', brans = '$brans' WHERE kimlikno = '$kimlikno'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$ogretmenler = $conn->query("SELECT * FROM ogretmenler")->fetch_all(MYSQLI_ASSOC);
$duzenlenecek = isset($_GET['duzenle']) ? $conn->query("SELECT * FROM ogretmenler WHERE kimlikno = '$_GET[duzenle]'")->fetch_assoc() : null;
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
        <h3 class="fw-bold">Öğretmen Ekle</h3>
        <form action="#" method="POST" class="mb-5">
            <div class="mb-3">
                <input type="text" class="form-control" name="kimlikno" placeholder="Kimlik No" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['kimlikno']) : '' ?>" maxlength="11" required>
                <input type="text" class="form-control mt-2" name="ad" placeholder="Ad" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['ad']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="soyad" placeholder="Soyad" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['soyad']) : '' ?>" required>
                <input type="text" class="form-control mt-2" name="brans" placeholder="Branş" value="<?= $duzenlenecek ? htmlspecialchars($duzenlenecek['brans']) : '' ?>" required>
            </div>
            <button type="submit" name="<?= $duzenlenecek ? 'duzenle' : 'ekle' ?>" class="btn btn-primary"><?= $duzenlenecek ? 'Kaydet' : 'Ekle' ?></button>
        </form>

        <h3 class="fw-bold">Öğretmenler</h3>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Kimlik No</th>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Branş</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ogretmenler as $ogretmen): ?>
                    <tr>
                        <td><?= htmlspecialchars($ogretmen['kimlikno']) ?></td>
                        <td><?= htmlspecialchars($ogretmen['ad']) ?></td>
                        <td><?= htmlspecialchars($ogretmen['soyad']) ?></td>
                        <td><?= htmlspecialchars($ogretmen['brans']) ?></td>
                        <td>
                            <a href="?sil=<?= $ogretmen['kimlikno'] ?>" class="text-danger"><i class="bi bi-trash"></i></a>
                            <a href="?duzenle=<?= $ogretmen['kimlikno'] ?>" class="text-primary ms-2"><i class="bi bi-pencil-square"></i></a>
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