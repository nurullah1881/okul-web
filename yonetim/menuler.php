<?php
session_start();
if (!isset($_SESSION['yonetici']) || $_SESSION['yonetici'] != "evet") {
    header("Location: giris.php");
    exit;
}

require "./database.php";

if (isset($_POST['ekle'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $href = $conn->real_escape_string($_POST['href']);
    $parent_menu = $_POST['parent_menu'];

    if ($parent_menu == "-") {
        $sql = "INSERT INTO menus (title, href) VALUES ('$title', '$href')";
        $conn->query($sql);
    } else {
        $menu_id = $conn->real_escape_string($parent_menu);
        $sql = "INSERT INTO submenus (menu_id, title, href) VALUES ('$menu_id', '$title', '$href')";
        $conn->query($sql);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['menu_sil'])) {
    $id = $_GET['menu_sil'];
    $sql2 = "DELETE FROM submenus WHERE menu_id = '$id'";
    $conn->query($sql2);
    $sql = "DELETE FROM menus WHERE id = '$id'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_GET['submenu_sil'])) {
    $id = $_GET['submenu_sil'];
    $sql = "DELETE FROM submenus WHERE id = '$id'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['menu_duzenle'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $title = $conn->real_escape_string($_POST['title']);
    $href = $conn->real_escape_string($_POST['href']);
    $sql = "UPDATE menus SET title = '$title', href = '$href' WHERE id = '$id'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['submenu_duzenle'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $menu_id = $conn->real_escape_string($_POST['menu_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $href = $conn->real_escape_string($_POST['href']);
    $sql = "UPDATE submenus SET menu_id = '$menu_id', title = '$title', href = '$href' WHERE id = '$id'";
    $conn->query($sql);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$menus = $conn->query("SELECT * FROM menus")->fetch_all(MYSQLI_ASSOC);
$submenus = $conn->query("SELECT * FROM submenus")->fetch_all(MYSQLI_ASSOC);
$duzenlenecek_menu = isset($_GET['menu_duzenle']) ? $conn->query("SELECT * FROM menus WHERE id = '$_GET[menu_duzenle]'")->fetch_assoc() : null;
$duzenlenecek_submenu = isset($_GET['submenu_duzenle']) ? $conn->query("SELECT * FROM submenus WHERE id = '$_GET[submenu_duzenle]'")->fetch_assoc() : null;
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
        <h3 class="fw-bold">Menü Ekle</h3>
        <form action="#" method="POST" class="mb-5">
            <div class="mb-3">
                <select class="form-control" name="parent_menu" placeholder="Üstmenü seçin" required>
                    <option value="-" selected>Üstmenü yok</option>
                    <?php foreach ($menus as $menu): ?>
                        <option value="<?= $menu['id'] ?>"><?= htmlspecialchars($menu['title']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" class="form-control mt-2" name="title" placeholder="Başlık" required>
                <input type="text" class="form-control mt-2" name="href" placeholder="Link" required>
            </div>
            <button type="submit" name="ekle" class="btn btn-primary">Ekle</button>
        </form>

        <?php if ($duzenlenecek_menu): ?>
            <h3 class="fw-bold">Menü Düzenle</h3>
            <form action="#" method="POST" class="mb-5">
                <input type="hidden" name="id" value="<?= $duzenlenecek_menu['id'] ?>">
                <div class="mb-3">
                    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($duzenlenecek_menu['title']) ?>" required>
                    <input type="text" class="form-control mt-2" name="href" value="<?= htmlspecialchars($duzenlenecek_menu['href']) ?>" required>
                </div>
                <button type="submit" name="menu_duzenle" class="btn btn-primary">Kaydet</button>
            </form>
        <?php endif; ?>

        <?php if ($duzenlenecek_submenu): ?>
            <h3 class="fw-bold">Alt Menü Düzenle</h3>
            <form action="#" method="POST" class="mb-5">
                <input type="hidden" name="id" value="<?= $duzenlenecek_submenu['id'] ?>">
                <div class="mb-3">
                    <select class="form-control" name="menu_id" required>
                        <option value="">Ana Menü Seç</option>
                        <?php foreach ($menus as $menu): ?>
                            <option value="<?= $menu['id'] ?>" <?= $menu['id'] == $duzenlenecek_submenu['menu_id'] ? 'selected' : '' ?>><?= htmlspecialchars($menu['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="text" class="form-control mt-2" name="title" value="<?= htmlspecialchars($duzenlenecek_submenu['title']) ?>" required>
                    <input type="text" class="form-control mt-2" name="href" value="<?= htmlspecialchars($duzenlenecek_submenu['href']) ?>" required>
                </div>
                <button type="submit" name="submenu_duzenle" class="btn btn-primary">Kaydet</button>
            </form>
        <?php endif; ?>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Başlık</th>
                    <th>Link</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?= $menu['id'] ?></td>
                        <td><?= htmlspecialchars($menu['title']) ?></td>
                        <td><?= htmlspecialchars($menu['href']) ?></td>
                        <td>
                            <a href="?menu_sil=<?= $menu['id'] ?>" class="text-danger"><i class="bi bi-trash"></i></a>
                            <a href="?menu_duzenle=<?= $menu['id'] ?>" class="text-primary ms-2"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                    <?php foreach ($submenus as $submenu): if ($submenu['menu_id'] == $menu['id']): ?>
                        <tr>
                            <td><?= $submenu['id'] ?></td>
                            <td>↳ <?= htmlspecialchars($submenu['title']) ?></td>
                            <td><?= htmlspecialchars($submenu['href']) ?></td>
                            <td>
                                <a href="?submenu_sil=<?= $submenu['id'] ?>" class="text-danger"><i class="bi bi-trash"></i></a>
                                <a href="?submenu_duzenle=<?= $submenu['id'] ?>" class="text-primary ms-2"><i class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    <?php endif; endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>