<?php
require './database.php';

if ($_POST) {
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];
    
    // Aynı eposta var mı kontrol et
    $kontrol = mysqli_query($conn, "SELECT * FROM uyeler WHERE eposta='$eposta'");
    if (mysqli_num_rows($kontrol) > 0) {
        $hata = "Bu eposta zaten kayıtlı!";
    } else {
        $sql = "INSERT INTO uyeler (eposta, sifre) VALUES ('$eposta', '$sifre')";
        if (mysqli_query($conn, $sql)) {
            $mesaj = "Kayıt başarılı! Giriş yapabilirsiniz.";
        } else {
            $hata = "Kayıt başarısız!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-box {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .hata {
            color: red;
        }
        .basari {
            color: green;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h3>Kayıt Ol</h3>
        
        <?php if (isset($hata)) { ?>
            <p class="hata"><?php echo $hata; ?></p>
        <?php } ?>
        
        <?php if (isset($mesaj)) { ?>
            <p class="basari"><?php echo $mesaj; ?></p>
        <?php } ?>

        <form method="post">
            <div class="mb-3">
                <label>Eposta</label>
                <input type="email" class="form-control" name="eposta">
            </div>
            <div class="mb-3">
                <label>Şifre</label>
                <input type="password" class="form-control" name="sifre">
            </div>
            <button type="submit" class="btn btn-success">Kayıt Ol</button>
            <a href="giris.php" class="btn btn-secondary">Giriş Sayfası</a>
        </form>
    </div>
</body>
</html>