<?php 
session_start();
if(!isset($_SESSION['yonetici']) || !$_SESSION['yonetici'] == "evet"){
    header("Location: giris.php");
    exit;
}
require "./database.php";    

$sql = "SELECT * FROM slider"; 
$result = $conn->query($sql);

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $sql1 = "DELETE FROM slider WHERE id = '$id'";
    $conn->query($sql1);
    header("Location: ./slayt.php");
}

if (isset($_POST['slaytmetin']) && !isset($_GET['duzenle'])) {
    $metin = $_POST['slaytmetin'];
    $baglanti = $_POST['slaytbaglanti'];

    $gorsel = "";
    if ($_FILES['slaytgorsel']['name'] != "") {
        $gorsel = "uploads/" . $_FILES['slaytgorsel']['name'];
        move_uploaded_file($_FILES['slaytgorsel']['tmp_name'], $gorsel);
    }

    $gorsel = "/yonetim/" . $gorsel;
    $sql2 = "INSERT INTO slider (metin, href, image) VALUES ('$metin', '$baglanti', '$gorsel')";
    $conn->query($sql2);
    header("Location: ./slayt.php");
}

if (isset($_GET['duzenle'])) {
    $d_id = $_GET['duzenle'];
    $sql_duzenle = "SELECT * FROM slider WHERE id = '$d_id'";
    $result_duzenle = $conn->query($sql_duzenle);
    $duzenlenecek = $result_duzenle->fetch_assoc();

    if (isset($_POST['slaytmetin'])) {
        $metin = $_POST['slaytmetin'];
        $baglanti = $_POST['slaytbaglanti'];

        $gorselvar = "";
        $gorsel = $duzenlenecek['image'];
        if ($_FILES['slaytgorsel']['error'] === UPLOAD_ERR_OK) {
            $gorsel = "./uploads/" . $_FILES['slaytgorsel']['name'];
            if (move_uploaded_file($_FILES['slaytgorsel']['tmp_name'], __DIR__ . $gorsel)) {
                $gorselvar = ", image = '/yonetim/$gorsel'";
            } else {
                echo "Dosya yüklenirken bir hata oluştu!";
            }
        } else {
            echo "Dosya yükleme hatası: " . $_FILES['slaytgorsel']['error'];
        }
        
        $sql3 = "UPDATE slider SET metin = '$metin', href = '$baglanti'". $gorselvar ." WHERE id = '$d_id'";
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
</head>
<body>
    <?php require 'nav.php'; ?>

    <main class="container mt-5">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <h3 class="fw-bold">Slayt</h3>
                <hr>
                <div class="mb-3">
                    <label for="duyurutext" class="form-label">Başlık</label>
                    <input type="text" class="form-control" id="duyurutext" name="slaytmetin" maxlength="50" 
                           value="<?php if(isset($duzenlenecek)) echo $duzenlenecek['metin']; ?>" placeholder="Slayt metni..">
                </div>
                <div class="mb-3">
                    <label for="duyurutext" class="form-label">Bağlantı</label>
                    <input type="text" class="form-control" id="duyurutext" name="slaytbaglanti" maxlength="50" 
                           value="<?php if(isset($duzenlenecek)) echo $duzenlenecek['href']; ?>" placeholder="Slayt bağlantısı..">
                </div>
                <div class="mb-3">
                    <label for="baglanti" class="form-label">Görsel</label>
                    <input type="file" class="form-control" id="baglanti" name="slaytgorsel" enctype="multipart/form-data">
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Yayınla</button>
            </div>
        </form>
        
        <table class="mt-5 mb-5 table">
            <thead>
                <tr>
                    <th scope="col">Numara</th>
                    <th scope="col">Resim</th>
                    <th scope="col">Metin</th>
                    <th scope="col">Bağlantısı</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($okulbilgi = $result->fetch_assoc()): ?>
                        <tr>
                            <th scope="row"><?php echo $okulbilgi["id"]; ?></th>
                            <td><img src="<?php echo $okulbilgi['image']; ?>" width="100" height="100"></td>
                            <td><?php echo $okulbilgi["metin"]; ?></td>
                            <td><a href="<?php echo $okulbilgi["href"]; ?>"><?php echo $okulbilgi["href"]; ?></a></td>
                            <td>
                                <a href="?sil=<?php echo $okulbilgi["id"]; ?>"><i class="bi bi-trash"></i></a>
                                <a href="?duzenle=<?php echo $okulbilgi["id"]; ?>"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <th scope="row">Duyuru yok.</th>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>