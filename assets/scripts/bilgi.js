// ***************************************
// Bilgileri çek
//

$(document).ready(function() {
    console.log("Okul bilgileri çekiliyor...");
    $.ajax({
        url: '/sistem/okulBilgi.json',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            $.each(data, function(index, item) {
                document.getElementById("okulIl").innerText = item.okulil;
                document.getElementById("okulIlce").innerText = item.okulilce;
                document.getElementById("okulAdi").innerText = item.okuladi;
            });
            console.log("Okul bilgisi çekildi.");
        },
        error: function() {
            console.log('Okul bilgisi çekilemedi.');
        }
    });

    console.log("Navigasyon menüsü çekiliyor...");
    $.ajax({
        url: '/sistem/navMenu.json',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var menuHtml = '';
            $.each(data, function(index, item) {
                if (item.submenu.length > 0) {
                    menuHtml += '<li class="nav-item dropdown">';
                    menuHtml += '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">' + item.title + '</a>';
                    menuHtml += '<ul class="dropdown-menu">';
                    $.each(item.submenu, function(subIndex, subItem) {
                        menuHtml += '<li><a class="dropdown-item" href="' + subItem.href + '">' + subItem.title + '</a></li>';
                    });
                    menuHtml += '</ul>';
                    menuHtml += '</li>';
                } else {
                    menuHtml += '<li class="nav-item"><a class="nav-link" href="' + item.href + '">' + item.title + '</a></li>';
                }
            });

            $('.navbar-nav').html(menuHtml);
            console.log("Navigasyon menüsü çekildi.");
        },
        error: function() {
            console.log('Navigasyon menüsü çekilemedi.');
        }
    });

    console.log("Bağlantılar menüsü çekiliyor...");
    $.ajax({
        url: '/sistem/baglantilar.json',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var menuHtml = '';
            $.each(data, function(index, item) {
                menuHtml += '<li><a href="'+ item.href +' "><span class="mdi mdi-arrow-right-bold-circle"></span> '+ item.title +'</a></li>';
            });

            $('.baglantilar').html(menuHtml);
            console.log("Bağlantılar menüsü çekildi.");
        },
        error: function() {
            console.log('Bağlantılar menüsü çekilemedi.');
        }
    });

    console.log("Slide çekiliyor...");
    $.ajax({
        url: '/sistem/slide.json',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var menuHtml = '';
            if (data.length > 0) {
                $.each(data, function(index, item) {
                    let isActive = (index === 0) ? ' active' : '';
                    menuHtml += '<div class="carousel-item' + isActive + '">';
                    menuHtml += '<a href="' + item.href + '">';
                    menuHtml += '<img src="'+ item.image +'" class="d-block w-100">';
                    menuHtml += '<p class="slide-metin-1 text-left">'+ item.title +'</p>';
                    menuHtml += '</a>';
                    menuHtml += '</div>';
                });
            }

            $('.carousel-inner').html(menuHtml);
            console.log("Slide çekildi.");
        },
        error: function() {
            console.log('Slide çekilemedi.');
        }
    });
});

// 
// ***************************************