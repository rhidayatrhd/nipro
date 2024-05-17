// -------------------------------------------------------------------
//  common.js by aitec-inc.co.jp
//  2020.06.23 released
//
//  Require: jquery 1.10.2 after
// -------------------------------------------------------------------

// -------------------------------------------------------------------
//  蛻晄悄險ｭ螳�
// -------------------------------------------------------------------


// 蜈ｨ闊ｬ
// -------------------------------------------------------------------

// 繧ｹ繝槭�繝悶Ξ繝ｼ繧ｯ繝昴う繝ｳ繝�
var spBreakPoint = 700; //px

// 繝ｭ繝ｼ繝ｫ繧ｪ繝ｼ繝舌�
// -------------------------------------------------------------------

// 繝悶Ξ繝ｼ繧ｯ繝昴う繝ｳ繝井ｻ･荳九〒繝ｭ繝ｼ繝ｫ繧ｪ繝ｼ繝舌�繧堤┌蜉ｹ蛹� (縺吶ｋ:true / 縺励↑縺�:false)
var rolloverDisableUnderBrakePoint = true;


// 繧ｹ繝�繝ｼ繧ｺ繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ
// -------------------------------------------------------------------

// 繧ｹ繝�繝ｼ繧ｺ繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ騾溷ｺｦ
var smoothScrollSpeed = 300; //msec

// 繝壹�繧ｸ繝医ャ繝励∈謌ｻ繧九�繧ｿ繝ｳ繧定�蜍慕噪縺ｫ髫�縺� (縺吶ｋ:true / 縺励↑縺�:false);
var scrollToTopAutoHide = true;

// 繝壹�繧ｸ繝医ャ繝励∈謌ｻ繧九�繧ｿ繝ｳ繧定｡ｨ遉ｺ縺輔○繧矩ｫ倥＆
var scrollToTopAppearHeight = 200; // px

// 繝壹�繧ｸ繝医ャ繝励∈謌ｻ繧九�繧ｿ繝ｳ繧偵ヵ繧ｧ繝ｼ繝峨う繝ｳ陦ｨ遉ｺ縺輔○繧九せ繝斐�繝�
var scrollToTopFadeSpeed = 200; // msec

// 繝壹�繧ｸ繝医ャ繝励∈謌ｻ繧九�繧ｿ繝ｳ繧偵ヵ繝�ち繝ｼ縺ｫ繧ｹ繝翫ャ繝� (縺吶ｋ:true / 縺励↑縺�:false);
var scrollToTopSnap = true;


// 繝壹�繧ｸ繝医ャ繝励∈謌ｻ繧九�繧ｿ繝ｳ繧ｹ繝翫ャ繝玲凾繧ｪ繝輔そ繝�ヨ (繝励Λ繧ｹ縺ｧ荳翫∈縲√�繧､繝翫せ縺ｧ荳九∈)
var scrollToTopSnapOffset = 30;


// PC/SP繝｡繝九Η繝ｼ蛻�ｊ譖ｿ縺�
// -------------------------------------------------------------------

// 繧ｰ繝ｭ繝ｼ繝舌Ν繝翫ン繧ｲ繝ｼ繧ｷ繝ｧ繝ｳ
var menuGlobalNavi = "header nav";

// 繝上Φ繝舌�繧ｬ繝ｼ繝懊ち繝ｳ
var menuHamburgerButton = "#menuBtn";

// 繝峨Ο繝��繝繧ｦ繝ｳ繧ｹ繝斐�繝�
var menuDropSpeed = 200;


// -------------------------------------------------------------------
//  襍ｷ蜍�
// -------------------------------------------------------------------
$(function () {
    // 逕ｻ蜒上�繧ｿ繝ｳ縺ｮ繝ｭ繝ｼ繝ｫ繧ｪ繝ｼ繝舌�
    rolloverImage();

    // 繧ｹ繝�繝ｼ繧ｺ繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ
    smoothScroll();

    // 髮ｻ隧ｱ逡ｪ蜿ｷ繧ｿ繝��
    setTelLink();

    // PC/SP逕ｻ蜒丞�繧頑崛縺�
    toggleImage();

    // PC/SP繝｡繝九Η繝ｼ蛻�ｊ譖ｿ縺�
    menuChange();

    // 蟷ｴ蜿ｷ陦ｨ遉ｺ
    printThisYear();

    // slick
    slickSlider();
    bannerSlider();

    // 繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ
    scrollIn();

    // 繝壹�繧ｸ蜀�ず繝｣繝ｳ繝�
    nameJump();

    // 遐皮ｩｶ繝ｻ髢狗匱縲∬｣ｽ騾��亥ｷ･蝣ｴ邏ｹ莉具ｼ峨繝昴ャ繝励い繝��
    factoryMap();

    // IR雉�侭繝ｩ繧､繝悶Λ繝ｪ繝ｼ
    $('.archive main h2.tit').click(function () {
        $(this).next().slideToggle(menuDropSpeed);
        $(this).toggleClass('active');
    });

    // 繧医￥縺ゅｋ縺碑ｳｪ蝠�
    $('.faq h3').click(function () {
        $(this).next().slideToggle(menuDropSpeed);
        $(this).toggleClass('active');
    });

    // 遐皮ｩｶ繝ｻ髢狗匱縲∬｣ｽ騾��育�皮ｩｶ邏ｹ莉具ｼ�
    $('p.detailBtn').click(function () {
        $(this).next().slideToggle(menuDropSpeed);
        $(this).toggleClass('active');
    });

    // 蛹ｻ逋よｩ滄未遲峨→縺ｮ髢｢菫ゅ�騾乗�諤ｧ縺ｫ髢｢縺吶ｋ謖�� 蜷梧э繝懊ち繝ｳ
    $(window).on("load", function () { agreeCheck(); });
    $("#agree").on("change", function () {
        agreeCheck();
    });
    var agreeCheck = function () {
        if ($('#agree').prop('checked')) {
            $('#agreeAction').find('input[type="button"]').prop('disabled', false);
        } else {
            $('#agreeAction').find('input[type="button"]').prop('disabled', true);
        }
    };

    // 繧ｹ繝槭�譎ゅユ繝ｼ繝悶Ν
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


$(window).on("load", function () {
    // 繝輔か繝ｼ繝�蜷梧э繝√ぉ繝�け騾∽ｿ｡繧ｳ繝ｳ繝医Ο繝ｼ繝ｫ
    formAgreeCheckControl();
});


// -------------------------------------------------------------------
//  逕ｻ蜒上Ο繝ｼ繝ｫ繧ｪ繝ｼ繝舌�
// -------------------------------------------------------------------
function rolloverImage() {
    if ($('.rollover').length) {
        $(".rollover").each(function () {
            // 騾壼ｸｸ src
            var src = '';
            if (!$(this).attr("nsrc")) {
                src = $(this).attr("src");
                $(this).attr("nsrc", src);
            } else {
                src = $(this).attr("nsrc");
            }

            // 繝ｭ繝ｼ繝ｫ繧ｪ繝ｼ繝舌� src
            var hsrc = '';
            if (src.match(/_off\.(\w+)$/)) {
                hsrc = src.replace(/_off\.(\w+)$/, "_on\.$1");
            } else {
                hsrc = src.replace(/\.(\w+)$/, "_on\.$1");
            }
            $(this).attr("hsrc", hsrc);

            // 繧､繝吶Φ繝郁ｨｭ螳�
            $(this).hover(
                function () {
                    var windowWidth = window.innerWidth || $(window).width();
                    if (windowWidth <= spBreakPoint &&
                        (rolloverDisableUnderBrakePoint === true || (rolloverDisableUnderBrakePoint === false && $(this).hasClass("switch")))
                    ) { return; }

                    $(this).attr("src", $(this).attr("hsrc"));
                },
                function () {
                    var windowWidth = window.innerWidth || $(window).width();
                    if (windowWidth <= spBreakPoint &&
                        (rolloverDisableUnderBrakePoint === true || (rolloverDisableUnderBrakePoint === false && $(this).hasClass("switch")))
                    ) { return; }

                    $(this).attr("src", $(this).attr("nsrc"));
                }
            );

        });
    }
}


// -------------------------------------------------------------------
//  繧ｹ繝�繝ｼ繧ｺ繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ
// -------------------------------------------------------------------
function smoothScroll() {

    // 縲後せ繝�繝ｼ繧ｺ繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ縲阪う繝吶Φ繝郁ｨｭ螳�
    // -----------------------------------------------------------
    $('a[href^="#"]').click(function () {
        scrollTo(this);
    });

    // 縲後�繝ｼ繧ｸ繝医ャ繝励∈謌ｻ繧九阪�繧ｿ繝ｳ
    // -----------------------------------------------------------
    if ($('#pagetop').length) {
        // 繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ繧､繝吶Φ繝郁ｨｭ螳�
        if (scrollToTopAutoHide) {
            $(window).scroll(function () {
                buttonAppearance()
            });
        }

        // 繝懊ち繝ｳ繧､繝吶Φ繝郁ｨｭ螳�
        $('#pagetop').click(function () {
            scrollTo();
        });

        $(".pagetop img").click(function () {
            scrollTo();
        });

        // 蛻晄悄險ｭ螳�

        if (scrollToTopAutoHide) {
            if (scrollToTopSnap) {
                $("#pagetop").attr("default-bottom-width", $("#pagetop").css('bottom'));
            }
            buttonAppearance();
        } else {
            $("#pagetop").show();
        }

        // 繝懊ち繝ｳ陦ｨ遉ｺ蜃ｦ逅�
        function buttonAppearance() {
            if (!$('#pagetop').hasClass("scrollActive")) {
                if ($(this).scrollTop() >= scrollToTopAppearHeight) {
                    if (!$('#pagetop').hasClass("buttonShow")) {
                        $('#pagetop').addClass("scrollActive");
                        $('#pagetop').removeClass("buttonHide");
                        $('#pagetop').addClass("buttonShow");
                        $('#pagetop').fadeIn(
                            scrollToTopFadeSpeed,
                            function () {
                                $('#pagetop').removeClass("scrollActive");
                            }
                        );
                    }
                } else {
                    if (!$('#pagetop').hasClass("buttonHide")) {
                        $('#pagetop').addClass("scrollActive");
                        $('#pagetop').removeClass("buttonShow");
                        $('#pagetop').addClass("buttonHide");
                        $('#pagetop').fadeOut(
                            scrollToTopFadeSpeed,
                            function () {
                                $('#pagetop').removeClass("scrollActive");
                            }
                        );
                    }
                }
            }
            // footer縺ｸ繧ｹ繝翫ャ繝励☆繧句�ｴ蜷�
            if (scrollToTopSnap) {
                var scrollHeight = $(document).height();
                var scrollPosition = $(window).height() + $(window).scrollTop();
                var footHeight = $("footer").innerHeight()
                    + parseInt($("footer").css("border-top-width"))
                    + parseInt($("footer").css("border-bottom-width"))
                    + scrollToTopSnapOffset;
                var windowWidth = window.innerWidth || $(window).width();
                if (windowWidth > spBreakPoint) {
                    footHeight = footHeight + $("#footerSitemap").innerHeight();
                }
                if (scrollHeight - scrollPosition <= footHeight) {
                    $("#pagetop").css({ 'position': 'absolute', 'bottom': footHeight + 'px' });
                    $("#pagetop").removeClass("pagetopFixed");
                } else {
                    if (!$("#pagetop").hasClass("pagetopFixed")) {
                        $("#pagetop").css({ 'position': 'fixed', 'bottom': $("#pagetop").attr("default-bottom-width") });
                        $("#pagetop").addClass("pagetopFixed");
                    }
                }
            }
        }
    }

    // 繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ蜃ｦ逅� (蜈･蜉�: 繧ｨ繝ｬ繝｡繝ｳ繝� / 辟｡謖�ｮ壹〒繝壹�繧ｸ繝医ャ繝�)
    // -----------------------------------------------------------
    function scrollTo(target) {
        var position = 0;
        if (target) {
            var href = $(target).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            position = target.offset().top - 120;
        }
        $("html, body").animate({ scrollTop: position }, smoothScrollSpeed, "swing");
        return false;
    }
}

// -------------------------------------------------------------------
//  髮ｻ隧ｱ逡ｪ蜿ｷ繧ｿ繝��
// -------------------------------------------------------------------
function setTelLink() {
    if (navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)) {
        $('.call').each(function () {
            if (!$(this).children("a").length) {
                var phoneNumber = $(this).attr("title");
                $(this).html('<a href="tel:' + phoneNumber + '">' + $(this).html() + '</a>');
            }
        });
    }
}


// -------------------------------------------------------------------
//  PC/SP逕ｻ蜒丞�繧頑崛縺�
// -------------------------------------------------------------------
function toggleImage() {
    if ($('.switch').length) {
        // 蛻晄悄蛹�
        $('.switch').each(function () {
            ;
            // 騾壼ｸｸ src
            var src = '';
            if (!$(this).attr("nsrc")) {
                src = $(this).attr("src");
                $(this).attr("nsrc", src);
            } else {
                src = $(this).attr("nsrc");
            }

            // SP迚� src
            var ssrc = '';
            if (src.match(/_pc\.(\w+)$/)) {
                ssrc = src.replace(/_pc\.(\w+)$/, "_sp\.$1");
            } else if (src.match(/_off\.(\w+)$/)) {
                ssrc = src.replace(/_off\.(\w+)$/, "_sp\.$1");
            } else {
                ssrc = src.replace(/\.(\w+)$/, "_sp\.$1");
            }
            $(this).attr("ssrc", ssrc);
        });

        // PC/SP逕ｻ蜒丞�繧頑崛縺医う繝吶Φ繝郁ｨｭ螳�
        $(window).resize(function () {
            changeImage();
        });

        // 逕ｻ蜒剰ｨｭ螳�
        changeImage();

        // 逕ｻ蜒丞�繧頑崛縺�
        function changeImage() {
            $('.switch').each(function () {
                var windowWidth = window.innerWidth || $(window).width();
                if (windowWidth > spBreakPoint) {
                    $(this).attr("src", $(this).attr("nsrc"));
                } else {
                    $(this).attr("src", $(this).attr("ssrc"));
                }
            });
        }

    }
}


// -------------------------------------------------------------------
//  繝輔か繝ｼ繝�蜷梧э繝√ぉ繝�け騾∽ｿ｡繧ｳ繝ｳ繝医Ο繝ｼ繝ｫ
// -------------------------------------------------------------------
function formAgreeCheckControl() {
    if ($('form input[name="agree"]').length) {
        $('form input[name="agree"]').each(function () {
            // 蜷梧э繝√ぉ繝�け繧､繝吶Φ繝郁ｨｭ螳�
            $(this).change(function () {
                checkAgree(this);
            });

            // 繝√ぉ繝�け
            checkAgree(this);

            // 騾∽ｿ｡繧ｳ繝ｳ繝医Ο繝ｼ繝ｫ
            function checkAgree(elem) {
                var formElem = $(elem).closest("form");
                if (!$(elem).prop('checked')) {
                    formElem.find('input[type="submit"]').prop('disabled', true);
                    formElem.find('input.submit').prop('disabled', true);
                    formElem.find('#agreeAction input[type="button"]').prop('disabled', true);
                    formElem.find('input:not([name="agree"]), textarea, select').prop('disabled', true);
                } else {
                    formElem.find('input[type="submit"]').prop('disabled', false);
                    formElem.find('input.submit').prop('disabled', false);
                    formElem.find('#agreeAction input[type="button"]').prop('disabled', false);
                    formElem.find('input:not([name="agree"]), textarea, select').prop('disabled', false);
                }
            }
        });

        $('form input[type="reset"]').click(function () {
            location.reload();
        });

    }
}

// -------------------------------------------------------------------
//  PC/SP繝｡繝九Η繝ｼ蛻�ｊ譖ｿ縺�
// -------------------------------------------------------------------
function menuChange() {
    // 繝上Φ繝舌�繧ｬ繝ｼ繝懊ち繝ｳ縺ｮ繝医げ繝ｫ險ｭ螳�
    $(menuHamburgerButton).click(function () {
        $(menuGlobalNavi).slideToggle(menuDropSpeed);
        $(menuGlobalNavi).toggleClass('active');
        $(this).toggleClass('active');
        return false;
    });

    // 繧ｦ繧｣繝ｳ繝峨え繝ｪ繧ｵ繧､繧ｺ譎ゅ�蜃ｦ逅�
    $(window).resize(function () {
        var windowWidth = window.innerWidth || $(window).width();
        if (windowWidth > spBreakPoint) {
            if (!$(menuGlobalNavi).hasClass('active') || !$(menuGlobalNavi).hasClass('menuPC')) {
                $(menuGlobalNavi).show();
                $(menuGlobalNavi).addClass('active');
                $(menuGlobalNavi).addClass('menuPC');
            }
        } else {
            if ($(menuGlobalNavi).hasClass('menuPC')) {
                $(menuGlobalNavi).hide();
                $(menuGlobalNavi).removeClass('active');
                $(menuGlobalNavi).removeClass('menuPC');
            }
        }
    });

    // 蛻晄悄蛟､縺ｮ蜃ｦ逅�
    var windowWidth = window.innerWidth || $(window).width();
    if (windowWidth > spBreakPoint) {
        $(menuGlobalNavi).show();
        $(menuGlobalNavi).addClass('menuPC');
        $(menuGlobalNavi).addClass('active');
    } else {
        $(menuGlobalNavi).hide();
    }

}

// -------------------------------------------------------------------
//  蟷ｴ蜿ｷ陦ｨ遉ｺ
// -------------------------------------------------------------------
function thisYear() {
    var date = new Date();
    var y = date.getFullYear();
    document.write(y);
}
function printThisYear() {
    if ($('.thisYear').length) {
        var date = new Date();
        var y = date.getFullYear();
        $('.thisYear').html(y);
    }
}


// -------------------------------------------------------------------
//  slick
// -------------------------------------------------------------------
function slickSlider() {
    if ($('.slider').length) {
        $('.slider').slick({
            autoplay: true,
            fade: false,
            arrows: true,
            dots: true,
            autoplaySpeed: 3000,
            speed: 500
        });
    }
}
function bannerSlider() {
    if ($('.bannerSlider').length) {
        $('.bannerSlider').slick({
            autoplay: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplaySpeed: 3000,
            speed: 1000,
        });
    }
}

// -------------------------------------------------------------------
//  繧ｹ繧ｯ繝ｭ繝ｼ繝ｫ繧｢繝九Γ繝ｼ繧ｷ繝ｧ繝ｳ
// -------------------------------------------------------------------
function scrollIn() {
    $(window).on('load scroll', function () {
        $('.scrollin').each(function () {
            var target = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var height = $(window).height();
            if (scroll > target + 100 - height) {
                $(this).addClass('active');
            }/* else {
				$(this).removeClass('active');
			}*/
        });
    });
}


// -------------------------------------------------------------------
//  繝阪�繝�繧ｸ繝｣繝ｳ繝�
// -------------------------------------------------------------------
function nameJump() {
    var currentHash = location.hash;
    if (!currentHash) { return false; }

    $("body").css("visibility", "hidden");
    var position = $(currentHash).offset().top - 120;
    $("html, body").animate({ scrollTop: position }, 50, 'linear', function () { $("body").css("visibility", "visible"); });
    return false;
}

// -------------------------------------------------------------------
//  遐皮ｩｶ繝ｻ髢狗匱縲∬｣ｽ騾��亥ｷ･蝣ｴ邏ｹ莉具ｼ� 繝昴ャ繝励い繝��
// -------------------------------------------------------------------
function factoryMap() {
    var windowWidth = window.innerWidth || $(window).width();
    $('#pin li').click(function () {
        if (windowWidth > spBreakPoint) {
            if (!$(this).hasClass("active")) {
                clearActive();
                var popupId = "#" + $(this).attr("id") + "_popup";
                $(popupId).addClass('active');
                $(this).addClass('active');
            } else {
                clearActive();
            }
        } else {
            clearActive();
        }
    });

    $('#factoryMap section span').click(function () {
        clearActive();
    });

    function clearActive() {
        if ($('#factoryMap .active').length) {
            $("#factoryMap .active").each(function () {
                $(this).removeClass('active');
            });
        }
    }
}