<?php 

function okulbilgi($conn) {
    $sql = "SELECT * FROM okulbilgi";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $veri = $result->fetch_assoc();

        $okuladi = $veri["okuladi"];
        $okulil = $veri["okulil"];
        $okulilce = $veri["okulilce"];
        
    } else {
        $okuladi = "Örnek Okul";
        $okulil = "Ankara";
        $okulilce = "Çankaya";
    }

    return array("okuladi" => $okuladi, "okulil" => $okulil, "okulilce" => $okulilce);
}

function navmenucek($conn){
    $sql = "SELECT m.id, m.title AS menu_title, m.href AS menu_href, s.title AS submenu_title, s.href AS submenu_href FROM menus m LEFT JOIN submenus s ON m.id = s.menu_id ORDER BY m.id, s.id";

    $result = $conn->query($sql);

    $navMenu = [];
    $id = null;

    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
    if ($row['id'] != $id) {
        $id = $row['id'];
        $navMenu[$id] = [
            'title' => $row['menu_title'],
            'href' => $row['menu_href'],
            'submenu' => []
        ];
    }

    if ($row['submenu_title']) {
        $navMenu[$id]['submenu'][] = [
            'title' => $row['submenu_title'],
            'href' => $row['submenu_href']
        ];
    }
    }
    } else {
        //
    }

    return $navMenu;
}

function baglantilarcek($conn){
    $sql = "SELECT * FROM baglantilar";

    $result = $conn->query($sql);

    $baglantilar = [];
    $id = null;
    $sayac = 0;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['id'] != $id) {
                $id = $row['id'];
                $baglantilar[$id] = [
                    'baslik' => $row['baslik'],
                    'href' => $row['href']
                ];
                $sayac++;
            }
            if($sayac === 10){
                break;
            }
        }
    } 
    else {
        $baglantilar[0] = [
            'baslik' => "Bağlantılar eklenmemiş.",
            'href' => "https://www.turkiye.gov.tr"
        ];
    }

    return $baglantilar;
}

function slidercek($conn) {
    $sql = "SELECT * FROM slider";
    $result = $conn->query($sql);

    $slider = [];
    $id = null;

    if ($result->num_rows > 0) {
        if($result->num_rows > 9){
            
        }
        while ($row = $result->fetch_assoc()) {
            if ($row['id'] != $id) {
                $id = $row['id'];
                $slider[$id] = [
                    'image' => $row['image'],
                    'metin' => $row['metin'],
                    'href' => $row['href']
                ];
            }
        }
    } else {
        $slider[0] = [
            'image' => "https://hbeml.meb.k12.tr/meb_iys_dosyalar/41/09/967514/resimler/2023_11/k_09162915_dikka.jpg",
            'metin' => "Buraya bir slider eklenmelidir.",
            'href' => "#"
        ];
    }

    return $slider;
}

function islemlercek($conn) {
    $sql = "SELECT * FROM islemler";
    $result = $conn->query($sql);

    $islemler = [];
    $id = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['id'] != $id) {
                $id = $row['id'];
                $islemler[$id] = [
                    'baslik' => $row['baslik'],
                    'href' => $row['href']
                ];
            }
        }
    } else {
        $islemler[$id] = [
            'baslik' => "İşlemler eklenmemiş",
            'href' => "#"
        ];
    }

    return $islemler;
}
?>