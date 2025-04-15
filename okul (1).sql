-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Nis 2025, 22:19:04
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `okul`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `baglantilar`
--

CREATE TABLE `baglantilar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `duyuru` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `icerik`
--

CREATE TABLE `icerik` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `metin` varchar(2048) NOT NULL,
  `zaman` datetime NOT NULL,
  `link` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `icerik`
--

INSERT INTO `icerik` (`id`, `baslik`, `metin`, `zaman`, `link`) VALUES
(20, 'Örnek içerik.', '<p><img src=\"/yonetim/uploads/67d494f354145_k_09162915_dikka.jpg\" style=\"width: 664.732px; height: 373.406px;\"><b><br></b></p><p><b>Buraya örnek bir içerik koyabilirsin.</b></p>', '2025-03-14 23:43:34', '/icerikler/ornek-icerik.php'),
(23, 'Halil Dağ', '<p></p><center><img src=\"https://i.pinimg.com/736x/be/68/29/be6829086304dbcb7a2a0011dbd90e78.jpg\" style=\"width: 637px;\"><p></p></center><div><p class=\"break-words\" style=\"white-space-collapse: preserve;\">Halil Dağ, 1983 yılında Düzce’nin sakin ve doğal güzellikleriyle ünlü Yığılca ilçesinde dünyaya geldi. Eğitim hayatına burada başlayan Dağ, ilkokul, ortaokul ve lise öğrenimini Düzce’de başarıyla tamamladı. Teknik konulara olan ilgisi ve yeteneği, onu yükseköğrenimde mühendislik alanına yöneltti. 2006 yılında Fırat Üniversitesi Makine Öğretmenliği bölümünden mezun olarak, hem teknik bilgi birikimini hem de eğitimcilik yetkinliğini pekiştirdi.</p>\r\n<p class=\"break-words\" style=\"white-space-collapse: preserve;\">Üniversiteden mezun olduktan sonra, Halil Dağ kariyerine otomotiv sektöründe adım attı. 2006-2010 yılları arasında bu alanda çalışarak, makine teknolojileri ve endüstriyel üretim süreçleri konusunda değerli deneyimler kazandı. Ancak, eğitimci kimliğine duyduğu tutku, onu tekrar okullara dönmeye yöneltti. 2010 yılında Kocaeli Çayırova’daki Hatice Bayraktar Mesleki ve Teknik Anadolu Lisesi’nde Makine Teknolojileri öğretmeni olarak göreve başladı. Öğrencilerine hem teorik bilgiyi hem de pratik becerileri aktararak, onların meslek hayatına hazırlanmasında önemli bir rol üstlendi.</p>\r\n<p class=\"break-words\" style=\"white-space-collapse: preserve;\">Halil Dağ, öğretmenlik yaptığı yıllarda gösterdiği liderlik vasıfları ve özverili çalışması sayesinde kısa sürede yönetim kademelerinde yükseldi. 2012-2019 yılları arasında aynı okulda Teknik Müdür Yardımcısı olarak görev yaptı. Bu süreçte, okulun atölyelerinin modernizasyonu, sanayi ile iş birliği projeleri ve mesleki eğitim müfredatının geliştirilmesi gibi konularda aktif bir şekilde çalıştı. Çalışkanlığı ve vizyoner yaklaşımı, onun 2019 Eylül ayında Hatice Bayraktar Mesleki ve Teknik Anadolu Lisesi’nin Okul Müdürü olarak atanmasını sağladı.</p></div>', '2025-03-14 23:58:06', '/icerikler/halil-dag.php'),
(25, 'Okulumuz Hakkında', '<p><span style=\"background-color: var(--bs-body-bg); text-align: var(--bs-body-text-align);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Okulumuzun ve çevrenin teknik imkanlarından yararlanarak, özverili öğretmenler aracılığıyla,Atatürk ilke inkılaplarına bağlı, milli ve manevi değerlerine sahip çıkıp yaşatan, araştıran, eleştiren, düşünen mesleki alanda kendini geliştirmiş, geleceğe güvenle bakan öğrencileri, sanayi kuruluşlarının ihtiyaçlarına cevap verecek nitelikli insan haline getirmek ve bir üst eğitim kurumuna hazırlamaktır.</span></p>', '2025-03-15 00:17:23', '/icerikler/okulumuz-hakkinda.php');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `islemler`
--

CREATE TABLE `islemler` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `islemler`
--

INSERT INTO `islemler` (`id`, `baslik`, `href`) VALUES
(1, 'MEBBİS', 'https://mebbis.meb.gov.tr/'),
(2, 'e-Okul', 'https://e-okul.meb.gov.tr/');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `menus`
--

INSERT INTO `menus` (`id`, `title`, `href`) VALUES
(5, 'Ana Sayfa', '/'),
(6, 'Okulumuz', '#');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `no` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `kimlik` varchar(11) NOT NULL,
  `cinsiyet` varchar(5) NOT NULL,
  `sinif` varchar(10) NOT NULL,
  `anne_ad` varchar(50) NOT NULL,
  `baba_ad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`no`, `ad`, `soyad`, `kimlik`, `cinsiyet`, `sinif`, `anne_ad`, `baba_ad`) VALUES
(1, 'ONUR', 'DİNÇ', '11111111110', 'Erkek', '10/A', 'ZEYNEP', 'ALİ'),
(2, 'UFUK', 'YIKILMAZ', '11111111112', 'Erkek', '10/A', 'MAKBULE', 'RIZA'),
(3, 'FATİH', 'USLU', '11111111113', 'Erkek', '10/B', 'AYŞE', 'METE');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmenler`
--

CREATE TABLE `ogretmenler` (
  `kimlikno` varchar(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `brans` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogretmenler`
--

INSERT INTO `ogretmenler` (`kimlikno`, `ad`, `soyad`, `brans`) VALUES
('11111111110', 'AHMET', 'MAHMUTOĞLU', 'Matematik'),
('11111111111', 'HALİL', 'DAĞ', 'Müdür');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `okulbilgi`
--

CREATE TABLE `okulbilgi` (
  `id` int(11) NOT NULL,
  `okuladi` varchar(255) NOT NULL,
  `okulil` varchar(255) NOT NULL,
  `okulilce` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `okulbilgi`
--

INSERT INTO `okulbilgi` (`id`, `okuladi`, `okulil`, `okulilce`) VALUES
(1, 'Hatice Bayraktar Mesleki ve Teknik Anadolu Lisesi', 'KOCAELİ', 'ÇAYIROVA');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `metin` varchar(60) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `image`, `metin`, `href`) VALUES
(1, 'https://hbeml.meb.k12.tr/meb_iys_dosyalar/41/09/967514/resimler/2023_11/k_09162915_dikka.jpg', 'Deneme Slide 1', '#'),
(2, 'https://hbeml.meb.k12.tr/meb_iys_dosyalar/41/09/967514/resimler/2021_03/k_12171010_k_31134501_k_19130841_15160207_k_03131443_04211851_k_08113616_telafisinavlariprogrami1.jpg', 'Deneme Slide 2', '#');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `submenus`
--

CREATE TABLE `submenus` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `submenus`
--

INSERT INTO `submenus` (`id`, `menu_id`, `title`, `href`) VALUES
(17, 6, 'Müdür', '/icerikler/halil-dag.php'),
(18, 6, 'Kadromuz', '/icerikler/kadromuz.php'),
(19, 6, 'Okulumuz Hakkında', '/icerikler/okulumuz-hakkinda.php');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `eposta` varchar(255) NOT NULL,
  `sifre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `eposta`, `sifre`) VALUES
(1, 'musaoktay@gmail.com', 'musa123');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `baglantilar`
--
ALTER TABLE `baglantilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `icerik`
--
ALTER TABLE `icerik`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `islemler`
--
ALTER TABLE `islemler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`no`);

--
-- Tablo için indeksler `ogretmenler`
--
ALTER TABLE `ogretmenler`
  ADD PRIMARY KEY (`kimlikno`);

--
-- Tablo için indeksler `okulbilgi`
--
ALTER TABLE `okulbilgi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `baglantilar`
--
ALTER TABLE `baglantilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `icerik`
--
ALTER TABLE `icerik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `islemler`
--
ALTER TABLE `islemler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `okulbilgi`
--
ALTER TABLE `okulbilgi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `submenus`
--
ALTER TABLE `submenus`
  ADD CONSTRAINT `submenus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
