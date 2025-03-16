<?php 
session_start();
if(!isset($_SESSION['yonetici']) || !$_SESSION['yonetici'] == "evet"){
    header("Location: giris.php");
    exit;
}
    setlocale(LC_ALL, 'tr_TR.UTF-8');
    require "./database.php";    
    $sql = "SELECT * FROM okulbilgi";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $veri = $result->fetch_assoc();
        $okuladi = $veri["okuladi"];
        $okulil = $veri["okulil"];
        $okulilce = $veri["okulilce"];
    }

    function buyuk($string) {
        $turkish_lower = array('ı', 'i', 'ğ', 'ü', 'ş', 'ö', 'ç');
        $turkish_upper = array('I', 'İ', 'Ğ', 'Ü', 'Ş', 'Ö', 'Ç');
        
        $string = str_replace($turkish_lower, $turkish_upper, $string);
        $string = mb_strtoupper($string, 'UTF-8');
        
        return $string;
    }

    if(isset($_POST['okuladi']) && isset($_POST['okulil']) && isset($_POST['okulilce'])) {
        $okulisim = $conn->real_escape_string($_POST['okuladi']);
        $okulil = $conn->real_escape_string(buyuk($_POST['okulil']));
        $okulilce = $conn->real_escape_string(buyuk($_POST['okulilce']));
        
        $editsql = "UPDATE okulbilgi SET okuladi = '$okulisim', okulil = '$okulil', okulilce = '$okulilce' WHERE id = '1'";
        
        $result = $conn->query($editsql);
        
        if($result) {
            echo '<script>alert("Başarılı")</script>'; 
        } else {
            echo '<script>alert("'. $conn->error .'")</script>';
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
    <?php require 'nav.php' ?>

    <main class="container mt-5">
        <form action="#" method="post">
            <div class="mb-3">
                <h3 class="fw-bold">Okul Bilgilerini Düzenle</h3>
                <hr>
                <div class="mb-3">
                    <label for="okuladi" class="form-label">Okul Adı</label>
                    <input type="text" class="form-control" name="okuladi" id="okuladi"<?php if($okuladi){ echo ' value="' . $okuladi . '" '; } ?>placeholder="Okul adını giriniz..." required>
                </div>
                <div class="mb-3">
                    <label for="okulil" class="form-label">Okul İl</label>
                    <select class="form-select" onchange="ilceDoldur()" name="okulil" id="okulil" required>
                        <option value="none">İl Seçin</option>
                        <option value="adana">Adana</option>
                        <option value="adiyaman">Adıyaman</option>
                        <option value="afyonkarahisar">Afyonkarahisar</option>
                        <option value="agri">Ağrı</option>
                        <option value="amasya">Amasya</option>
                        <option value="ankara">Ankara</option>
                        <option value="antalya">Antalya</option>
                        <option value="artvin">Artvin</option>
                        <option value="aydin">Aydın</option>
                        <option value="balikesir">Balıkesir</option>
                        <option value="bilecik">Bilecik</option>
                        <option value="bingol">Bingöl</option>
                        <option value="bitlis">Bitlis</option>
                        <option value="bolu">Bolu</option>
                        <option value="burdur">Burdur</option>
                        <option value="bursa">Bursa</option>
                        <option value="canakkale">Çanakkale</option>
                        <option value="cankiri">Çankırı</option>
                        <option value="corum">Çorum</option>
                        <option value="denizli">Denizli</option>
                        <option value="diyarbakir">Diyarbakır</option>
                        <option value="edirne">Edirne</option>
                        <option value="elazig">Elazığ</option>
                        <option value="erzincan">Erzincan</option>
                        <option value="erzurum">Erzurum</option>
                        <option value="eskisehir">Eskişehir</option>
                        <option value="gaziantep">Gaziantep</option>
                        <option value="giresun">Giresun</option>
                        <option value="gumushane">Gümüşhane</option>
                        <option value="hakkari">Hakkari</option>
                        <option value="hatay">Hatay</option>
                        <option value="isparta">Isparta</option>
                        <option value="mersin">Mersin</option>
                        <option value="istanbul">İstanbul</option>
                        <option value="izmir">İzmir</option>
                        <option value="kars">Kars</option>
                        <option value="kastamonu">Kastamonu</option>
                        <option value="kayseri">Kayseri</option>
                        <option value="kirklareli">Kırklareli</option>
                        <option value="kirsehir">Kırşehir</option>
                        <option value="kocaeli">Kocaeli</option>
                        <option value="konya">Konya</option>
                        <option value="kutahya">Kütahya</option>
                        <option value="malatya">Malatya</option>
                        <option value="manisa">Manisa</option>
                        <option value="kahramanmaras">Kahramanmaraş</option>
                        <option value="mardin">Mardin</option>
                        <option value="mugla">Muğla</option>
                        <option value="mus">Muş</option>
                        <option value="nevsehir">Nevşehir</option>
                        <option value="nigde">Niğde</option>
                        <option value="ordu">Ordu</option>
                        <option value="rize">Rize</option>
                        <option value="sakarya">Sakarya</option>
                        <option value="samsun">Samsun</option>
                        <option value="siirt">Siirt</option>
                        <option value="sinop">Sinop</option>
                        <option value="sivas">Sivas</option>
                        <option value="tekirdag">Tekirdağ</option>
                        <option value="tokat">Tokat</option>
                        <option value="trabzon">Trabzon</option>
                        <option value="tunceli">Tunceli</option>
                        <option value="sanliurfa">Şanlıurfa</option>
                        <option value="usak">Uşak</option>
                        <option value="van">Van</option>
                        <option value="yozgat">Yozgat</option>
                        <option value="zonguldak">Zonguldak</option>
                        <option value="aksaray">Aksaray</option>
                        <option value="bayburt">Bayburt</option>
                        <option value="karaman">Karaman</option>
                        <option value="kirikkale">Kırıkkale</option>
                        <option value="batman">Batman</option>
                        <option value="sirnak">Şırnak</option>
                        <option value="bartin">Bartın</option>
                        <option value="ardahan">Ardahan</option>
                        <option value="igdir">Iğdır</option>
                        <option value="yalova">Yalova</option>
                        <option value="karabuk">Karabük</option>
                        <option value="kilis">Kilis</option>
                        <option value="osmaniye">Osmaniye</option>
                        <option value="duzce">Düzce</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="okulilce" class="form-label">Okul İlçe</label>
                    <select class="form-select" name="okulilce" id="okulilce" required>
                        <option selected value="none">Önce İl Seçin</option>
                    </select>
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Düzenle</button>
            </div>
        </form>

        <hr>
        <footer>
            <p class="footer-yazi">© 2025 Türkiye Cumhuriyeti Milli Eğitim Bakanlığı</p>
            <p class="footer-yazi">Tüm hakları saklıdır. Gizlilik, Kullanım ve Telif Hakları bildiriminde belirtilen kurallar çerçevesinde hizmet sunulmaktadır.</p>
        </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>        
        const ilceler = {
            adana: ["Seyhan", "Ceyhan", "Feke", "Karaisalı", "Karataş", "Kozan", "Pozantı", "Saimbeyli", "Tufanbeyli", "Yumurtalık", "Yüreğir", "Aladağ", "İmamoğlu", "Sarıçam", "Çukurova"],
            adiyaman: ["Merkez", "Besni", "Çelikhan", "Gerger", "Gölbaşı", "Kahta", "Samsat", "Sincik", "Tut"],
            afyonkarahisar: ["Merkez", "Bolvadin", "Çay", "Dazkırı", "Dinar", "Emirdağ", "İhsaniye", "Sandıklı", "Sinanpaşa", "Sultandağı", "Şuhut", "Başmakçı", "Bayat", "İscehisar", "Çobanlar", "Evciler", "Hocalar", "Kızılören"],
            agri: ["Merkez", "Diyadin", "Doğubayazıt", "Eleşkirt", "Hamur", "Patnos", "Taşlıçay", "Tutak"],
            amasya: ["Merkez", "Göynücek", "Gümüşhacıköy", "Merzifon", "Suluova", "Taşova", "Hamamözü"],
            ankara: ["Altındağ", "Ayaş", "Bala", "Beypazarı", "Çamlıdere", "Çankaya", "Çubuk", "Elmadağ", "Güdül", "Haymana", "Kalecik", "Kızılcahamam", "Nallıhan", "Polatlı", "Şereflikoçhisar", "Yenimahalle", "Gölbaşı", "Keçiören", "Mamak", "Sincan", "Kazan", "Akyurt", "Etimesgut", "Evren", "Pursaklar"],
            antalya: ["Akseki", "Alanya", "Elmalı", "Finike", "Gazipaşa", "Gündoğmuş", "Kaş", "Korkuteli", "Kumluca", "Manavgat", "Serik", "Demre", "İbradı", "Kemer", "Aksu", "Döşemealtı", "Kepez", "Konyaaltı", "Muratpaşa"],
            ardahan: ["Merkez", "Çıldır", "Göle", "Hanak", "Posof", "Damal"],
            artvin: ["Ardanuç", "Arhavi", "Merkez", "Borçka", "Hopa", "Şavşat", "Yusufeli", "Murgul"],
            aydin: ["Bozdoğan", "Çine", "Germencik", "Karacasu", "Koçarlı", "Kuşadası", "Kuyucak", "Nazilli", "Söke", "Sultanhisar", "Yenipazar", "Buharkent", "İncirliova", "Karpuzlu", "Köşk", "Didim", "Efeler"],
            balikesir: ["Ayvalık", "Balya", "Bandırma", "Bigadiç", "Burhaniye", "Dursunbey", "Edremit", "Erdek", "Gönen", "Havran", "İvrindi", "Kepsut", "Manyas", "Savaştepe", "Sındırgı", "Susurluk", "Marmara", "Gömeç", "Altıeylül", "Karesi"],
            bartin: ["Merkez", "Kurucaşile", "Ulus", "Amasra"],
            batman: ["Merkez", "Beşiri", "Gercüş", "Kozluk", "Sason", "Hasankeyf"],
            bayburt: ["Merkez", "Aydıntepe", "Demirözü"],
            bilecik: ["Merkez", "Bozüyük", "Gölpazarı", "Osmaneli", "Pazaryeri", "Söğüt", "Yenipazar", "İnhisar"],
            bingol: ["Merkez", "Genç", "Karlıova", "Kiğı", "Solhan", "Adaklı", "Yayladere", "Yedisu"],
            bitlis: ["Adilcevaz", "Ahlat", "Merkez", "Hizan", "Mutki", "Tatvan", "Güroymak"],
            bolu: ["Merkez", "Gerede", "Göynük", "Kıbrıscık", "Mengen", "Mudurnu", "Seben", "Dörtdivan", "Yeniçağa"],
            burdur: ["Ağlasun", "Bucak", "Merkez", "Gölhisar", "Tefenni", "Yeşilova", "Karamanlı", "Kemer", "Altınyayla", "Çavdır", "Çeltikçi"],
            bursa: ["Gemlik", "İnegöl", "İznik", "Karacabey", "Keles", "Mudanya", "Mustafakemalpaşa", "Orhaneli", "Orhangazi", "Yenişehir", "Büyükorhan", "Harmancık", "Nilüfer", "Osmangazi", "Yıldırım", "Gürsu", "Kestel"],
            canakkale: ["Ayvacık", "Bayramiç", "Biga", "Bozcaada", "Çan", "Merkez", "Eceabat", "Ezine", "Gelibolu", "Gökçeada", "Lapseki", "Yenice"],
            cankiri: ["Merkez", "Çerkeş", "Eldivan", "Ilgaz", "Kurşunlu", "Orta", "Şabanözü", "Yapraklı", "Atkaracalar", "Kızılırmak", "Bayramören", "Korgun"],
            corum: ["Alaca", "Bayat", "Merkez", "İskilip", "Kargı", "Mecitözü", "Ortaköy", "Osmancık", "Sungurlu", "Boğazkale", "Uğurludağ", "Dodurga", "Laçin", "Oğuzlar"],
            denizli: ["Acıpayam", "Buldan", "Çal", "Çameli", "Çardak", "Çivril", "Güney", "Kale", "Sarayköy", "Tavas", "Babadağ", "Bekilli", "Honaz", "Serinhisar", "Pamukkale", "Baklan", "Beyağaç", "Bozkurt", "Merkezefendi"],
            diyarbakir: ["Bismil", "Çermik", "Çınar", "Çüngüş", "Dicle", "Ergani", "Hani", "Hazro", "Kulp", "Lice", "Silvan", "Eğil", "Kocaköy", "Bağlar", "Kayapınar", "Sur", "Yenişehir"],
            duzce: ["Akçakoca", "Merkez", "Yığılca", "Cumayeri", "Gölyaka", "Çilimli", "Gümüşova", "Kaynaşlı"],
            edirne: ["Merkez", "Enez", "Havsa", "İpsala", "Keşan", "Lalapaşa", "Meriç", "Uzunköprü", "Süloğlu"],
            elazig: ["Ağın", "Baskil", "Merkez", "Karakoçan", "Keban", "Maden", "Palu", "Sivrice", "Arıcak", "Kovancılar", "Alacakaya"],
            erzincan: ["Çayırlı", "Merkez", "İliç", "Kemah", "Kemaliye", "Refahiye", "Tercan", "Üzümlü", "Otlukbeli"],
            erzurum: ["Aşkale", "Çat", "Hınıs", "Horasan", "İspir", "Karayazı", "Narman", "Oltu", "Olur", "Pasinler", "Şenkaya", "Tekman", "Tortum", "Karaçoban", "Uzundere", "Pazaryolu", "Aziziye", "Köprüköy", "Palandöken", "Yakutiye"],
            eskisehir: ["Çifteler", "Mahmudiye", "Mihalıççık", "Sarıcakaya", "Seyitgazi", "Sivrihisar", "Alpu", "Beylikova", "İnönü", "Günyüzü", "Han", "Mihalgazi", "Odunpazarı", "Tepebaşı"],
            gaziantep: ["Araban", "İslahiye", "Nizip", "Oğuzeli", "Yavuzeli", "Şahinbey", "Şehitkamil", "Karkamış", "Nurdağı"],
            giresun: ["Alucra", "Bulancak", "Dereli", "Espiye", "Eynesil", "Merkez", "Görele", "Keşap", "Şebinkarahisar", "Tirebolu", "Piraziz", "Yağlıdere", "Çamoluk", "Çanakçı", "Doğankent", "Güce"],
            gumushane: ["Merkez", "Kelkit", "Şiran", "Torul", "Köse", "Kürtün"],
            hakkari: ["Çukurca", "Merkez", "Şemdinli", "Yüksekova"],
            hatay: ["Altınözü", "Dörtyol", "Hassa", "İskenderun", "Kırıkhan", "Reyhanlı", "Samandağ", "Yayladağı", "Erzin", "Belen", "Kumlu", "Antakya", "Arsuz", "Defne", "Payas"],
            igdir: ["Aralık", "Merkez", "Tuzluca", "Karakoyunlu"],
            isparta: ["Atabey", "Eğirdir", "Gelendost", "Merkez", "Keçiborlu", "Senirkent", "Sütçüler", "Şarkikaraağaç", "Uluborlu", "Yalvaç", "Aksu", "Gönen", "Yenişarbademli"],
            istanbul: ["Adalar", "Arnavutköy", "Ataşehir", "Avcılar", "Bağcılar", "Bahçelievler", "Bakırköy", "Başakşehir", "Bayrampaşa", "Beşiktaş", "Beykoz", "Beylikdüzü", "Beyoğlu", "Büyükçekmece", "Çatalca", "Çekmeköy", "Esenler", "Esenyurt", "Eyüpsultan", "Fatih", "Gaziosmanpaşa", "Güngören", "Kadıköy", "Kağıthane", "Kartal", "Küçükçekmece", "Maltepe", "Pendik", "Sancaktepe", "Sarıyer", "Silivri", "Sultanbeyli", "Sultangazi", "Şile", "Şişli", "Tuzla", "Ümraniye", "Üsküdar", "Zeytinburnu"],
            izmir: ["Aliağa", "Balçova", "Bayındır", "Bayraklı", "Bergama", "Beydağ", "Bornova", "Buca", "Çeşme", "Çiğli", "Dikili", "Foça", "Gaziemir", "Güzelbahçe", "Karabağlar", "Karaburun", "Karşıyaka", "Kemalpaşa", "Kınık", "Kiraz", "Konak", "Menderes", "Menemen", "Narlıdere", "Ödemiş", "Seferihisar", "Selçuk", "Tire", "Torbalı", "Urla"],
            kahramanmaras: ["Afşin", "Andırın", "Elbistan", "Göksun", "Pazarcık", "Türkoğlu", "Çağlayancerit", "Ekinözü", "Nurhak", "Dulkadiroğlu", "Onikişubat"],
            karabuk: ["Eflani", "Eskipazar", "Merkez", "Ovacık", "Safranbolu", "Yenice"],
            karaman: ["Ermenek", "Merkez", "Ayrancı", "Kazımkarabekir", "Başyayla", "Sarıveliler"],
            kars: ["Merkez", "Akyaka", "Arpaçay", "Digor", "Kağızman", "Sarıkamış", "Selim", "Susuz"],
            kastamonu: ["Merkez", "Abana", "Ağlı", "Araç", "Azdavay", "Bozkurt", "Cide", "Çatalzeytin", "Daday", "Devrekani", "Dikmen", "Doğanyurt", "Hanönü", "İhsangazi", "İnebolu", "Küre", "Pınarbaşı", "Seydiler", "Şenpazar", "Taşköprü", "Tosya"],
            kayseri: ["Akkışla", "Bünyan", "Develi", "Felahiye", "Hacılar", "İncesu", "Kocasinan", "Melikgazi", "Özvatan", "Pınarbaşı", "Sarıoğlan", "Sarız", "Talas", "Tomarza", "Yahyalı", "Yeşilhisar"],
            kilis: ["Merkez", "Elbeyli", "Musabeyli", "Polateli"],
            kirikkale: ["Delice", "Keskin", "Merkez", "Sulakyurt", "Bahşili", "Balışeyh", "Çelebi", "Karakeçili", "Yahşihan"],
            kirklareli: ["Merkez", "Babaeski", "Demirköy", "Kofçaz", "Lüleburgaz", "Pehlivanköy", "Pınarhisar", "Vize"],
            kirsehir: ["Merkez", "Akçakent", "Akpınar", "Boztepe", "Çiçekdağı", "Kaman", "Mucur"],
            kocaeli: ["Başiskele", "Çayırova", "Darıca", "Derince", "Dilovası", "Gebze", "Gölcük", "İzmit", "Kandıra", "Karamürsel", "Körfez", "Derbent"],
            konya: ["Akşehir", "Beyşehir", "Bozkır", "Cihanbeyli", "Çumra", "Doğanhisar", "Ereğli", "Hadim", "Ilgın", "Kadınhanı", "Karapınar", "Kulu", "Sarayönü", "Seydişehir", "Yunak", "Akören", "Altınekin", "Derebucak", "Hüyük", "Karatay", "Meram", "Selçuklu", "Taşkent", "Ahırlı", "Çeltik", "Derbent", "Emirgazi", "Güneysınır", "Halkapınar", "Tuzlukçu", "Yalıhüyük"],
            kutahya: ["Altıntaş", "Domaniç", "Emet", "Gediz", "Merkez", "Simav", "Tavşanlı", "Aslanapa", "Dumlupınar", "Hisarcık", "Şaphane", "Çavdarhisar", "Pazarlar"],
            malatya: ["Akçadağ", "Arapgir", "Arguvan", "Darende", "Doğanşehir", "Hekimhan", "Pütürge", "Yeşilyurt", "Battalgazi", "Doğanyol", "Kale", "Kuluncak", "Yazıhan"],
            manisa: ["Akhisar", "Alaşehir", "Demirci", "Gördes", "Kırkağaç", "Kula", "Salihli", "Sarıgöl", "Saruhanlı", "Selendi", "Soma", "Turgutlu", "Ahmetli", "Gölmarmara", "Köprübaşı", "Şehzadeler", "Yunusemre"],
            mardin: ["Derik", "Kızıltepe", "Mazıdağı", "Midyat", "Nusaybin", "Ömerli", "Savur", "Dargeçit", "Yeşilli", "Artuklu"],
            mersin: ["Anamur", "Erdemli", "Gülnar", "Mut", "Silifke", "Tarsus", "Aydıncık", "Bozyazı", "Çamlıyayla", "Akdeniz", "Mezitli", "Toroslar", "Yenişehir"],
            mugla: ["Bodrum", "Datça", "Fethiye", "Köyceğiz", "Marmaris", "Milas", "Ula", "Yatağan", "Dalaman", "Ortaca", "Kavaklıdere", "Menteşe", "Seydikemer"],
            mus: ["Bulanık", "Malazgirt", "Merkez", "Varto", "Hasköy", "Korkut"],
            nevsehir: ["Avanos", "Derinkuyu", "Gülşehir", "Hacıbektaş", "Kozaklı", "Merkez", "Ürgüp", "Acıgöl"],
            nigde: ["Bor", "Çamardı", "Merkez", "Ulukışla", "Altunhisar", "Çiftlik"],
            ordu: ["Akkuş", "Aybastı", "Fatsa", "Gölköy", "Korgan", "Kumru", "Mesudiye", "Perşembe", "Ulubey", "Ünye", "Gülyalı", "Gürgentepe", "Çamaş", "Çatalpınar", "Çaybaşı", "İkizce", "Kabadüz", "Kabataş", "Altınordu"],
            osmaniye: ["Bahçe", "Kadirli", "Merkez", "Düziçi", "Hasanbeyli", "Sumbas", "Toprakkale"],
            rize: ["Ardeşen", "Çamlıhemşin", "Çayeli", "Fındıklı", "İkizdere", "Kalkandere", "Pazar", "Merkez", "Güneysu", "Derepazarı", "Hemşin", "İyidere"],
            sakarya: ["Akyazı", "Geyve", "Hendek", "Karasu", "Kaynarca", "Sapanca", "Kocaali", "Pamukova", "Taraklı", "Ferizli", "Karapürçek", "Söğütlü", "Adapazarı", "Arifiye", "Erenler", "Serdivan"],
            samsun: ["Alaçam", "Bafra", "Çarşamba", "Havza", "Kavak", "Ladik", "Terme", "Vezirköprü", "Asarcık", "19 Mayıs", "Salıpazarı", "Tekkeköy", "Ayvacık", "Yakakent", "Atakum", "Canik", "İlkadım"],
            siirt: ["Baykan", "Eruh", "Kurtalan", "Pervari", "Merkez", "Şirvan", "Tillo"],
            sinop: ["Ayancık", "Boyabat", "Durağan", "Erfelek", "Gerze", "Merkez", "Türkeli", "Dikmen", "Saraydüzü"],
            sivas: ["Divriği", "Gemerek", "Gürün", "Hafik", "İmranlı", "Kangal", "Koyulhisar", "Merkez", "Suşehri", "Şarkışla", "Yıldızeli", "Zara", "Akıncılar", "Altınyayla", "Doğanşar", "Gölova", "Ulaş"],
            sanliurfa: ["Akçakale", "Birecik", "Bozova", "Ceylanpınar", "Halfeti", "Hilvan", "Siverek", "Suruç", "Viranşehir", "Harran", "Eyyübiye", "Haliliye", "Karaköprü"],
            sirnak: ["Beytüşşebap", "Cizre", "İdil", "Silopi", "Merkez", "Uludere", "Güçlükonak"],
            tekirdag: ["Çerkezköy", "Çorlu", "Hayrabolu", "Malkara", "Muratlı", "Saray", "Şarköy", "Marmaraereğlisi", "Ergene", "Kapaklı", "Süleymanpaşa"],
            tokat: ["Almus", "Artova", "Erbaa", "Niksar", "Reşadiye", "Merkez", "Turhal", "Zile", "Pazar", "Yeşilyurt", "Başçiftlik", "Sulusaray"],
            trabzon: ["Akçaabat", "Araklı", "Arsin", "Çaykara", "Maçka", "Of", "Sürmene", "Tonya", "Vakfıkebir", "Yomra", "Beşikdüzü", "Şalpazarı", "Çarşıbaşı", "Dernekpazarı", "Düzköy", "Hayrat", "Köprübaşı", "Ortahisar"],
            tunceli: ["Çemişgezek", "Hozat", "Mazgirt", "Nazımiye", "Ovacık", "Pertek", "Pülümür", "Merkez"],
            usak: ["Banaz", "Eşme", "Karahallı", "Sivaslı", "Ulubey", "Merkez"],
            van: ["Başkale", "Çatak", "Erciş", "Gevaş", "Gürpınar", "Muradiye", "Özalp", "Bahçesaray", "Çaldıran", "Edremit", "Saray", "İpekyolu", "Tuşba"],
            yalova: ["Merkez", "Altınova", "Armutlu", "Çınarcık", "Çiftlikköy", "Termal"],
            yozgat: ["Akdağmadeni", "Boğazlıyan", "Çayıralan", "Çekerek", "Sarıkaya", "Sorgun", "Şefaatli", "Yerköy", "Merkez", "Aydıncık", "Çandır", "Kadışehri", "Saraykent", "Yenifakılı"],
            zonguldak: ["Çaycuma", "Devrek", "Ereğli", "Merkez", "Alaplı", "Gökçebey", "Kilimli", "Kozlu"]
        };

        function ilceDoldur() {
            const ilSecimi = document.getElementById("okulil").value;
            const ilceSelect = document.getElementById("okulilce");

            ilceSelect.innerHTML = "<option value=''>İlçe Seçin</option>";

            if (ilSecimi && ilceler[ilSecimi]) {
                ilceler[ilSecimi].forEach(ilce => {
                    let option = document.createElement("option");
                    option.value = ilce;
                    option.textContent = ilce;
                    ilceSelect.appendChild(option);
                });
            }
        }

<?php if($okulil && $okulilce): ?>
        const il = "<?= htmlspecialchars($okulil); ?>".toLocaleLowerCase("tr-TR");

        document.getElementById("okulil").value = il;
        ilceDoldur();

        const okulIlceOptions = document.getElementById('okulilce').getElementsByTagName('option');
        for (let option of okulIlceOptions) {
            option.value = option.value.toLocaleUpperCase('tr-TR');
        }

        var ilce = "<?= htmlspecialchars($okulilce); ?>".toLocaleUpperCase('tr-TR');
        document.getElementById("okulilce").value = ilce;
<?php endif; ?>
    </script>
</body>
</html>

<?php $conn->close(); ?>