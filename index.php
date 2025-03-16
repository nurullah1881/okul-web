<?php
    require './yonetim/database.php';
    include './sistem/okulbilgileri.php';


    $okulverileri = okulbilgi($conn);
    $navMenu = navmenucek($conn);
    $baglantilar = baglantilarcek($conn);
    $slider = slidercek($conn);
    $islemler = islemlercek($conn);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?></title> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?>">
	<meta name="author" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?>">
	<meta name="copyright" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?> Copyright 2025">
    
	<meta name="twitter:title" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?>">
	<meta name="twitter:creator" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI  <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?>">
    
	<meta property="og:type" content="news">
	<meta property="og:title" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?> / <?= htmlspecialchars($okulverileri['okuladi']) ?>">
	<meta property="og:description" content="T.C. MİLLÎ EĞİTİM BAKANLIĞI <?= htmlspecialchars($okulverileri['okulil']) ?> / <?= htmlspecialchars($okulverileri['okulilce']) ?>">
    
    <link rel="shortcut icon" href="/assets/images/meb-logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/styles/main.css">
</head>
<body class="bg-primary">
    <section class="container p-4 bg-white rounded shadow-lg">
        <div class="container">
            <div class="row">
              <div class="col-md-8 d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start text-center text-md-start">
                  <img src="/assets/images/meb-logo.png" class="meb-img img-fluid">
                  <div class="logo-text ms-md-3 mt-3 mt-md-0">
                      <h5 class="fw-bold">T.C. MİLLÎ EĞİTİM BAKANLIĞI</h5>
                      <h5><span id="okulIl"><?= htmlspecialchars($okulverileri['okulil']) ?></span> / <span id="okulIlce"><?= htmlspecialchars($okulverileri['okulilce']) ?></span></h5>
                      <h5 id="okulAdi"><span id="okulAdi"><?= htmlspecialchars($okulverileri['okuladi']) ?></span></h5>
                  </div>
              </div>
              <div class="col-md-4 d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-end mt-3 mt-md-0">
                  <img src="/assets/images/atabayrak.png" class="ataturk-bayrak img-fluid">
              </div>
            </div>
        </div>
        
        <nav class="mt-4 navbar navbar-expand-lg bg-primary rounded p-2" data-bs-theme="dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
    <?php foreach ($navMenu as $menu) : ?>
        <?php if (!empty($menu['submenu'])) : ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><?= htmlspecialchars($menu['title']) ?></a>
                <ul class="dropdown-menu">
                    <?php foreach ($menu['submenu'] as $submenu) : ?>
                        <li><a class="dropdown-item" href="<?= htmlspecialchars($submenu['href']) ?>"><?= htmlspecialchars($submenu['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php else : ?>
            <li class="nav-item"><a class="nav-link" href="<?= htmlspecialchars($menu['href']) ?>"><?= htmlspecialchars($menu['title']) ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
</ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row flex-column flex-md-row align-items-center">
                <div class="col-md-5 bg-primary text-center text-md-start p-3 rounded">
                    <h4 class="text-white text-center"><span class="mdi mdi-link-variant"></span> Bağlantılar</h4>
                    <ul class="list-unstyled baglantilar">
                    <?php foreach ($baglantilar as $baglanti) : ?>
                        <li><a href="<?= htmlspecialchars($baglanti['href']) ?>"><span class="mdi mdi-arrow-right-bold-circle"></span> <?= htmlspecialchars($baglanti['baslik']) ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-md-7 mt-2">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            <?php
if (!empty($slider)) {
    $first = true;
    foreach ($slider as $index => $item) : ?>
        <div class="carousel-item <?= $first ? 'active' : '' ?>">
            <a href="<?= htmlspecialchars($item['href']) ?>">
                <img src="<?= htmlspecialchars($item['image']) ?>" class="d-block w-100" width="500px" height="400px">
                <p class="slide-metin-1 text-left"><?= htmlspecialchars($item['metin']) ?></p>
            </a>
        </div>
        <?php
        $first = false; 
    endforeach;
} else {
    echo "Slider verileri bulunamadı.";
}
?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4" id="stats2">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <div class="col">
                    <div class="d-flex flex-column h-100 p-3 rounded bg-light">
                        <h4 class="text-white text-center bg-success p-2 rounded">
                            <span class="mdi mdi-bullhorn-variant"></span> Duyurular
                        </h4>
                        <ul class="list-unstyled text-secondary flex-grow-1">
                        <?php 
                            $sql1 = "SELECT * FROM duyurular"; 
                            $result = $conn->query($sql1);

                            if($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()) {
                                    echo '  <li class="p-2"><a href="'. htmlspecialchars($row['href']) .'" class="text-secondary"><span class="mdi mdi-arrow-right-bold-circle"></span> ' . htmlspecialchars($row['duyuru']) .'</a></li>';
                                }
                            }
                            else {
                                echo '    <li class="p-2 text-secondary"><span class="mdi mdi-arrow-right-bold-circle"></span> Duyuru yok.</li>';
                            }
                        ?>

                        </ul>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-success mt-4" style="border-radius: 0; border-top-right-radius: 20px; border-bottom-right-radius: 20px;">Devamı >></button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column h-100 p-3 rounded bg-light">
                        <h4 class="text-white text-center bg-warning p-2 rounded">
                            <span class="mdi mdi-gesture-tap"></span> İşlemler
                        </h4>
                        <ul class="list-unstyled text-secondary flex-grow-1">
                            <?php
                                if (!empty($islemler)) {
                                    foreach ($islemler as $index => $item) : ?>
                            <li class="p-2"><a href="<?= htmlspecialchars($item["href"]) ?>" class="text-secondary"><span class="mdi mdi-arrow-right-bold-circle"></span> <?= htmlspecialchars($item["baslik"]) ?></a></li>
                                        <?php
                                    endforeach;
                                } else {
                                    echo "Slider verileri bulunamadı.";
                                }
                                ?>
                        </ul>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column h-100 p-3 rounded bg-light">
                        <h4 class="text-white text-center bg-success p-2 rounded">
                            <span class="mdi mdi-bullhorn-variant"></span> İstatistikler
                        </h4>
                        <ul class="list-unstyled text-secondary flex-grow-1">
                        <?php 
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


                            echo '  <li class="p-2">Öğrenci Sayısı: ' . htmlspecialchars($ogrsayi) .'</li>';


                            echo '  <li class="p-2">Öğretmen Sayısı: ' . htmlspecialchars($ogretsayi) .'</li>';
                        ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <footer>
            <p class="footer-yazi">© 2025 Türkiye Cumhuriyeti Milli Eğitim Bakanlığı</p>
            <p class="footer-yazi">Tüm hakları saklıdır. Gizlilik, Kullanım ve Telif Hakları bildiriminde belirtilen kurallar çerçevesinde hizmet sunulmaktadır.</p>
        </footer>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
<?php $conn->close();?>