<?php
require '../yonetim/database.php';
include '../sistem/okulbilgileri.php';

$baslik = "Öğretmenlerimiz";

$ogretmenler = $conn->query("SELECT * FROM ogretmenler")->fetch_all(MYSQLI_ASSOC);

$okulverileri = okulbilgi($conn);
$navMenu = navmenucek($conn);
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
    <style>
        .ogretmen {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .ogretmen:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
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

        <main class="container mt-5">
            <h3 class="fw-bold mb-4"><?= htmlspecialchars($baslik); ?></h3>
            <hr>
            <div class="row g-4 mt-5">
                <?php foreach ($ogretmenler as $ogretmen): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card ogretmen border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($ogretmen['ad']) ?> <?= htmlspecialchars($ogretmen['soyad']) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($ogretmen['brans']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <hr class="my-5">
            <footer class="text-center">
                <p class="text-muted">© 2025 Türkiye Cumhuriyeti Milli Eğitim Bakanlığı</p>
                <p class="text-muted small">Tüm hakları saklıdır. Gizlilik, Kullanım ve Telif Hakları bildiriminde belirtilen kurallar çerçevesinde hizmet sunulmaktadır.</p>
            </footer>
        </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
<?php $conn->close();?>