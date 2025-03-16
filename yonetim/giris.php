<?php
session_start();

if (isset($_SESSION['yonetici']) && $_SESSION['yonetici'] == "evet") {
    header("Location: index.php");
    exit;
}
require './database.php';

if ($_POST) {
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];

    $sql = "SELECT * FROM uyeler WHERE eposta='$eposta' AND sifre='$sifre'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['yonetici'] = "evet";
        header("Location: index.php");
        exit;
    } else {
        $hata = "Yanlış eposta veya şifre!";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Girişi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-box {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .hata {
            color: red;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3>Giriş Yap</h3>
        
        <?php if (isset($hata)) { ?>
            <p class="hata"><?php echo $hata; ?></p>
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
            <button type="submit" class="btn btn-primary">Giriş</button>
        </form>
    </div>
</body>
</html>