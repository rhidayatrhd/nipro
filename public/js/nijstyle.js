var menuHamburgerButton = "#menuBtn";
var menuGlobalNav = "header nav";
var menuDropSpeed = 200;
var spBreakPoint = 700;
var menuDrop = "#navbarDrop";
var dropMenu = ".dropdown-menu";

$(function () {
    
    menuChange();
    menuDropdown();

    $(window).on('load resize', function () {
        if ($('table.scroll').length) {
            $('table.scroll').each(function () {
                if ($(this).width() > $(window).width()) {
                    $(this).css('display', 'block');
                } else if ($(window).width() > 700) {
                    $(this).css('display', 'table');
                }
            });
       } 
    });

});

function menuChange() {
    
    $(menuHamburgerButton).click(function() {
        $(menuGlobalNav).slideToggle(menuDropSpeed);
        $(menuGlobalNav).toggleClass('active');
        $(this).toggleClass('active');
        return false;
    });

    $(window).resize(function () {
        var windowWidth = window.innerWidth || $(window).width();
        if (windowWidth > spBreakPoint) {
            if (!$(menuGlobalNav).hasClass('active') || !$(menuGlobalNav).hasClass('menuPC')) {
                $(menuGlobalNav).show();
                $(menuGlobalNav).addClass('active');
                $(menuGlobalNav).addClass('menuPC');
            }
        } else {
            if ($(menuGlobalNav).hasClass('menuPC')) {
                $(menuGlobalNav).hide();
                $(menuGlobalNav).removeClass('active');
                $(menuGlobalNav).removeClass('menuPC');
            }
        }
    });

    var windowWidth = window.innerWidth || $(window).width();
    if (windowWidth > spBreakPoint) {
        $(menuGlobalNav).show();
        $(menuGlobalNav).addClass('menuPC');
        $(menuGlobalNav).addClass('active');
    } else {
        $(menuGlobalNav).hide();
    }

}

function menuDropdown() { 
    $(menuDrop).click(function () {
        $(dropMenu).slideToggle(menuDropSpeed);
        $(dropMenu).toggleClass('show');
        $(this).toggleClass('show');
        return false;
    });

    $(window).onClick = function (event) {
        if (!event.target.matches('nav-link')) {
            var dropdn = document.getElementsByClassName(dropMenu);
            var i;
            for (i = 0; i < menuDropdown.length; i++) {
                var openDrop = dropdn[i];
                if (openDrop.classList.contains('show')) {
                    openDrop.classList.remove('show');
                }
            }
        }
    }

 }