<?php 
session_start();
if(!isset($_SESSION['yonetici']) || !$_SESSION['yonetici'] == "evet"){
    header("Location: giris.php");
    exit;
}
    require "./database.php";    
    $ogrsql = "SELECT COUNT(no) FROM ogrenciler"; 
    $ogr_res = $conn->query($ogrsql);

    $ogrsayi = 0;

    if($ogr_res->num_rows > 0){
        $veri = $ogr_res->fetch_assoc();
        $ogrsayi = $veri["COUNT(no)"];
    }

    $ogretsql = "SELECT COUNT(kimlikno) FROM ogretmenler"; 
    $ogret_res = $conn->query($ogretsql);

    $ogretsayi = 0;

    if($ogret_res->num_rows > 0){
        $veri = $ogret_res->fetch_assoc();
        $ogretsayi = $veri["COUNT(kimlikno)"];
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
        <h3 class="fw-bold">Okul Yönetim</h3>
        <hr>
        <section class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mb-4">
            <article class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-people-fill fs-1 text-primary me-3"></i>
                        <div>
                            <h5 class="card-title mb-1">Toplam Öğrenci</h5>
                            <p class="card-text fs-3 fw-bold text-dark"><?= htmlspecialchars($ogrsayi) ?></p>
                        </div>
                    </div>
                </div>
            </article>

            <article class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-person-badge-fill fs-1 text-success me-3"></i>
                        <div>
                            <h5 class="card-title mb-1">Öğretmenler</h5>
                            <p class="card-text fs-3 fw-bold text-dark"><?= htmlspecialchars($ogretsayi) ?></p>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <section class="row mb-4">
            <article class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold text-dark">
                        <i class="bi bi-lightning-fill me-1"></i> Hızlı İşlemler
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="">
                                <button class="btn btn-primary" type="button">
                                    <i class="bi bi-person-plus-fill me-1"></i> Öğrenci Ekle
                                </button>
                            </a>
                            <a href="">
                                <button class="btn btn-success" type="button">
                                    <i class="bi bi-person-bounding-box me-1"></i> Öğretmen Ekle
                                </button>
                            </a>
                            <a href="">
                                <button class="btn btn-warning" type="button">
                                    <i class="bi bi-megaphone-fill me-1"></i> Duyuru Yayınla
                                </button>
                            </a>
                            <a href="">
                                <button class="btn btn-warning" type="button">
                                    <i class="bi bi-newspaper me-1"></i> Haber Yayınla
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <hr>
        <footer>
            <p class="footer-yazi">© 2025 Türkiye Cumhuriyeti Milli Eğitim Bakanlığı</p>
            <p class="footer-yazi">Tüm hakları saklıdır. Gizlilik, Kullanım ve Telif Hakları bildiriminde belirtilen kurallar çerçevesinde hizmet sunulmaktadır.</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>