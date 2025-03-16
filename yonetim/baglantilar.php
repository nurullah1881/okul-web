<?php 
session_start();
if(!isset($_SESSION['yonetici']) || !$_SESSION['yonetici'] == "evet"){
    header("Location: giris.php");
    exit;
}

    require "./database.php";    
    $sql = "SELECT * FROM baglantilar"; 
    $result = $conn->query($sql);

    if(isset($_GET['sil'])){
        $id = $_GET['sil'];

        $id = htmlspecialchars($id);

        $sql1 = "DELETE FROM baglantilar WHERE id = '{$id}'";

        if ($conn->query($sql1) === TRUE) {
            header("Location: ./baglantilar.php");
            exit;
        } else {
            echo '<script>alert("Başarısız")</script>';
        }
    }

    if(isset($_POST['baslik']) && isset($_POST['baglanti']) && !isset($_GET['duzenle'])){
        $baslik = htmlspecialchars($_POST['baslik']);
        $baglanti = $_POST['baglanti'];

        $sql2 = "INSERT INTO baglantilar(baslik, href) VALUES ('{$baslik}', '{$baglanti}')";
        if ($conn->query($sql2) === TRUE) {
            header("Location: ./baglantilar.php");
            exit;
        } else {
            echo '<script>alert("Başarısız")</script>';
        }
    }

    if(isset($_GET['duzenle'])){
        $d_id = (int)$_GET['duzenle'];

        $sqll = "SELECT * FROM baglantilar WHERE id = '{$d_id}'";
        $sorgud = $conn->query($sqll);

        if($sorgud->num_rows > 0){
            $editlenecek = $sorgud->fetch_assoc();
        }
        else {
            echo '<script>alert("Yok ki.")</script>';
        }

        if(isset($_POST['baslik']) && isset($_POST['baglanti'])){
            $baslik = htmlspecialchars($_POST['baslik']);
            $baglanti = $_POST['baglanti'];
    
            $sql3 = "UPDATE baglantilar SET baslik = '{$baslik}', href = '{$baglanti}' WHERE id = '{$d_id}'";
            if ($conn->query($sql3) === TRUE) {
                header("Location: ./baglantilar.php");
                exit;
            } else {
                echo '<script>alert("Başarısız")</script>';
            }
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
        <form action="#" method="POST">
            <div class="mb-3">
                <h3 class="fw-bold">Bağlantılar</h3>
                <hr>
                <div class="mb-3">
                    <label for="duyurutext" class="form-label">Başlık</label>
                    <input type="text" class="form-control" id="duyurutext" name="baslik" maxlength="50" <?php if(isset($d_id)){echo 'value="'. $editlenecek['baslik'] .'"';} ?> placeholder="Bağlantı başlığı">
                </div>
                <div class="mb-3">
                    <label for="baglanti" class="form-label">Bağlantı</label>
                    <input type="text" class="form-control" id="baglanti" name="baglanti" maxlength="255" <?php if(isset($d_id)){echo 'value="'. $editlenecek['href'] .'"';} ?> placeholder="Bağlantı...">
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
                    <th scope="col">Duyuru</th>
                    <th scope="col">Bağlantısı</th>
                    <th scope="col">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $sayac = 1; ?>
                        <?php while ($okulbilgi = $result->fetch_assoc()): ?>
                            <tr>
                    <th scope="row"><?= $sayac; ?></th>
                    <td><?= htmlspecialchars($okulbilgi["baslik"]); ?></td>
                    <td><a href="<?= htmlspecialchars($okulbilgi["href"]); ?>"><?= htmlspecialchars($okulbilgi["href"]); ?></a></td>
                    <td>
                        <a href="?sil=<?= htmlspecialchars($okulbilgi["id"]); ?>">
                            <i class="bi bi-trash"></i></a>
                        <a href="?duzenle=<?= htmlspecialchars($okulbilgi["id"]); ?>">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
                <?php $sayac++; ?>
                <?php endwhile; ?>
                <?php else: ?>
<tr>
                    <th scope="row">Duyuru yok.</th>
                </tr>
            <?php endif; ?></tbody>
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