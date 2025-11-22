/*Swiper Banner*/
if ($(".swiper-wrapper .swiper-slide").length < 2) {
    $(".swiper-pagination").hide();
}
var mySwiper = new Swiper(".slider_banner", {
    effect: "fade",
    speed: 1000,
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".slider_banner .swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".slider_banner .swiper-button-next",
        prevEl: ".slider_banner .swiper-button-prev",
    },
    on: {
        init: function () {
            var _that = this;
            setCurPage(".slider_banner", _that);
        },
    },
});
mySwiper.on("slideChange", function () {
    setCurPage(".slider_banner", mySwiper);
});
function setCurPage(sliderWrap, ele) {
    var curIndex = ele.realIndex + 1;
    var total = ele.slides.length - 2;
    var curHtml =
        '<i class="cur">' +
        curIndex +
        "</i>" +
        '<b class="line">/</b>' +
        '<i class="total">' +
        total +
        "</i>";
    $(sliderWrap).find(".slide-page-box").html(curHtml);
}

var viewSwiper = new Swiper(".image-additional", {
    slidesPerView: 3,
    spaceBetween: 0,
    pagination: {
        el: ".product-view .swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".product-view .swiper-button-next",
        prevEl: ".product-view .swiper-button-prev",
    },
    breakpoints: {
        1366: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 3,
        },
        480: {
            slidesPerView: 1,
        },
    },
});

var realtedSwiper = new Swiper(".products-swiper", {
    slidesPerView: 4,
    spaceBetween: 20,
    speed: 400,
    navigation: {
        nextEl: ".products-swiper .swiper-button-next",
        prevEl: ".products-swiper .swiper-button-prev",
    },
    breakpoints: {
        1680: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 2,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
    },
});

var realtedSwiper = new Swiper(".goods-may-like .swiper-slider", {
    slidesPerView: 4,
    spaceBetween: 20,
    speed: 400,
    navigation: {
        nextEl: ".goods-may-like .swiper-button-next",
        prevEl: ".goods-may-like .swiper-button-prev",
    },
    breakpoints: {
        1680: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 2,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
    },
});

if ($(".index_tailorism_container").length > 0) {
    var list = $(".index_tailorism_container .tailorism_swiper");
    list.each(function (index) {
        new Swiper($(this), {
            observer: true,
            slidesPerView: 4,
            spaceBetween: 20,
            speed: 400,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            breakpoints: {
                1680: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 2,
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
            },

            pagination: {
                el: $(this).find(".swiper-pagination"),
                clickable: true,
            },
            navigation: {
                prevEl: $(this).find(".swiper-button-prev"),
                nextEl: $(this).find(".swiper-button-next"),
            },
        });
    });
}
//       productSwiper.el.onmouseover=function(){
//       productSwiper.autoplay.stop();
//   }
//       productSwiper.el.onmouseleave=function(){
//       productSwiper.autoplay.start();
//   }

var cerSwiper = new Swiper(".cer_swiper", {
    slidesPerView: 5,
    spaceBetween: 10,
    pagination: {
        el: ".cer_swiper.swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".cer_swiper .swiper-button-next",
        prevEl: ".cer_swiper .swiper-button-prev",
    },
    breakpoints: {
        1366: {
            slidesPerView: 4,
        },
        768: {
            slidesPerView: 3,
        },
        480: {
            slidesPerView: 1,
        },
    },
});
var exhibitionSwiper = new Swiper(".exhibition_swiper", {
    slidesPerView: 5,
    spaceBetween: 10,
    pagination: {
        el: ".exhibition_swiper.swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".exhibition_swiper .swiper-button-next",
        prevEl: ".exhibition_swiper .swiper-button-prev",
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        1366: {
            slidesPerView: 4,
        },
        768: {
            slidesPerView: 3,
        },
        480: {
            slidesPerView: 1,
        },
    },
});
$(".head_nav li").each(function () {
    if ($(this).find("ul").length > 0) {
        $(this).children("a").append("<b></b>");
    }
});
tabContainer(".tab-content-wrap", ".tab-title", ".tab-panel");
function hideMsgPop() {
    $(".inquiry-pop-bd").fadeOut("fast");
}
if ($("body .inquiry-form-wrap").length > 0) {
    var webTop = $("body .inquiry-form-wrap").offset().top - 80;
    $(
        ".product-btn-wrap .email,.company_subscribe .button,.side_content .side_list .email"
    ).click(function () {
        $("html, body").animate({ scrollTop: webTop }, 1000);
        $(".ad_prompt").show().delay(3000).hide(300);
    });
} else {
    $(
        ".product-btn-wrap .email,.company_subscribe .button,.side_content .side_list .email"
    ).click(function () {
        $(".inquiry-pop-bd").fadeIn("fast");
    });
}
$(
    ".inquiry-pop,.product-btn-wrap .email,.company_subscribe .button,.side_content .side_list .email"
).click(function (e) {
    e.stopPropagation();
});
$(document).click(function () {
    hideMsgPop();
});
function changeuRL(link) {
    var curUrl = document.location.href;
    var oldUrl = window.location.host + "/";
    var lgArr = [
        "fr/",
        "de/",
        "pt/",
        "es/",
        "ru/",
        "ko/",
        "ar/",
        "ga/",
        "ja/",
        "el/",
        "tr/",
        "it/",
        "da/",
        "ro/",
        "id/",
        "cs/",
        "af/",
        "sv/",
        "pl/",
        "eu/",
        "ca/",
        "eo/",
        "hi/",
        "lo/",
        "sq/",
        "am/",
        "hy/",
        "az/",
        "be/",
        "bn/",
        "bs/",
        "bg/",
        "ceb/",
        "ny/",
        "co/",
        "hr/",
        "nl/",
        "et/",
        "tl/",
        "fi/",
        "fy/",
        "gl/",
        "ka/",
        "gu/",
        "ht/",
        "ha/",
        "haw/",
        "iw/",
        "hmn/",
        "hu/",
        "is/",
        "ig/",
        "jw/",
        "kn/",
        "kk/",
        "km/",
        "ku/",
        "ky/",
        "la/",
        "lv/",
        "lt/",
        "lb/",
        "mk/",
        "mg/",
        "ms/",
        "ml/",
        "mt/",
        "mi/",
        "mr/",
        "mn/",
        "my/",
        "ne/",
        "no/",
        "ps/",
        "fa/",
        "pa/",
        "sr/",
        "st/",
        "si/",
        "sk/",
        "sl/",
        "so/",
        "sm/",
        "gd/",
        "sn/",
        "sd/",
        "su/",
        "sw/",
        "tg/",
        "ta/",
        "te/",
        "th/",
        "uk/",
        "ur/",
        "uz/",
        "vi/",
        "cy/",
        "xh/",
        "yi/",
        "yo/",
        "zu/",
        "zh-CN/",
        "zh-TW/",
        "zh/",
    ];
    $.each(lgArr, function (i, lenItem) {
        var lgUrl = oldUrl.toString() + lenItem;
        if (curUrl.indexOf(lgUrl) != -1) {
            link.each(function (i) {
                if (!$(this).parents().hasClass("language-flag")) {
                    var iLink;
                    if ($(this).prop("href")) {
                        iLink = $(this).prop("href");
                    }
                    if (
                        String(iLink).indexOf(oldUrl) != -1 &&
                        String(iLink).indexOf(lgUrl) == -1 &&
                        curUrl.indexOf(lgUrl) != -1
                    ) {
                        var newLink = iLink.replace(oldUrl, lgUrl);
                        $(this).attr("href", newLink);
                    }
                }
            });
        }
    });
}
$(function () {
    changeuRL($("a"));
});
$(document).ready(function () {
    $(".change-language .change-language-cont").append(
        "<div class='change-empty'>Untranslated</div>"
    );
    $(".prisna-wp-translate-seo").append(
        "<div class='lang-more'>More Language</div>"
    );
    if (
        $("body .prisna-wp-translate-seo").length > 0 &&
        $(".change-language .prisna-wp-translate-seo").length < 1
    ) {
        $(".prisna-wp-translate-seo").appendTo(
            ".change-language .change-language-cont"
        );
        if (
            $(
                ".change-language .change-language-cont .prisna-wp-translate-seo li"
            ).length > 0
        ) {
            $(".change-language .change-language-cont .change-empty").hide();
            $(
                ".change-language .change-language-cont .prisna-wp-translate-seo li"
            ).each(function (index) {
                if (index > 35) {
                    $(this).addClass("lang-item lang-item-hide");
                    $(".change-language-cont").find(".lang-more").fadeIn();
                } else {
                    $(".change-language-cont").find(".lang-more").fadeOut();
                }
            });
            if ($(".change-language-cont .lang-more").length > 0) {
                $(".change-language-cont .lang-more").click(function () {
                    if (
                        $(this)
                            .parents(".change-language-cont")
                            .find(".prisna-wp-translate-seo li.lang-item")
                            .hasClass("lang-item-hide")
                    ) {
                        $(this)
                            .parents(".change-language-cont")
                            .find(".prisna-wp-translate-seo li.lang-item")
                            .removeClass("lang-item-hide");
                        $(this).addClass("more-active").text("x");
                    } else {
                        $(this)
                            .parents(".change-language-cont")
                            .find(".prisna-wp-translate-seo li.lang-item")
                            .addClass("lang-item-hide");
                        $(this)
                            .removeClass("more-active")
                            .text("More Language");
                    }
                });
            }
        } else {
            $(".change-language .change-language-cont .change-empty").fadeIn();
        }
    }
});
var mHeadTop = $(".web_head").offset().top;
var $backToTopTxt = "",
    $backToTopEle = $('<span class="gotop"></span>')
        .appendTo($("body"))
        .html("<em>" + $backToTopTxt + "</em>")
        .attr("title", $backToTopTxt)
        .click(function () {
            $("html, body").animate({ scrollTop: 0 }, 600);
        }),
    $backToTopFun = function () {
        var st = $(document).scrollTop(),
            winh = $(window).height();
        st > mHeadTop
            ? $backToTopEle.addClass("active")
            : $backToTopEle.removeClass("active");
        if (!window.XMLHttpRequest) {
            $backToTopEle.css("top", st + winh - 210);
        }
    };
$(window).bind("scroll", $backToTopFun);
$(function () {
    $backToTopFun();
});

var $nav = $(".web_head"),
    navTop = $(".nav_wrap").offset().top,
    headH = $nav.outerHeight(),
    headInnerH = $nav.height(),
    winTop_1 = 0,
    winWidth = $(window).width(),
    winHeight = $(window).height(),
    spr = $("body").height() - $nav.height(),
    holder = jQuery('<div class="head_holder">');
$(window).on("scroll", function () {
    var winTop_2 = $(window).scrollTop();
    holder.css("height", headH);

    if (winTop_2 > headH + 30 && winWidth > 980) {
        holder.show().appendTo($nav);
        $nav.addClass("fixed-nav");
        $nav.parents("body").addClass("fixed-body");
        setTimeout(function () {
            $nav.addClass("fixed-nav-active");
        });
    } else {
        holder.hide();
        $nav.removeClass("fixed-nav fixed-nav-active");
        $nav.parents("body").removeClass("fixed-body");
    }

    if (winTop_2 > winTop_1 && winWidth > 980) {
        $nav.removeClass("fixed-nav-appear");
    } else if (winTop_2 < winTop_1) {
        $nav.addClass("fixed-nav-appear");
    }
    winTop_1 = $(window).scrollTop();
});
$(".faq-item").each(function (index) {
    var _this = $(this);
    var title = _this.find(".faq-title");
    var cont = _this.find(".faq-cont");
    if (index == 0) {
        title.addClass("show-title");
    }
    title.on("click", function () {
        if (cont.is(":hidden") && !$(this).hasClass("show-title")) {
            cont.slideDown("fast");
            $(this).addClass("show-title");
            _this.siblings().find(".faq-title").removeClass("show-title");
            _this.siblings().find(".faq-cont").slideUp("fast");
        } else {
            cont.slideUp("fast");
            $(this).removeClass("show-title");
        }
    });
});
function mSizeChange() {
    if (window.innerWidth) winWidth = window.innerWidth;
    else if (document.body && document.body.clientWidth)
        winWidth = document.body.clientWidth;
    if (window.innerHeight) winHeight = window.innerHeight;
    else if (document.body && document.body.clientHeight)
        winHeight = document.body.clientHeight;
    if (
        document.documentElement &&
        document.documentElement.clientHeight &&
        document.documentElement.clientWidth
    ) {
        winHeight = document.documentElement.clientHeight;
        winWidth = document.documentElement.clientWidth;
    }
    if (winWidth <= 950) {
        if ($(".mobile-head-items").length < 1) {
            var mobileService =
                '<div class="mobile-head-items"><div class="mobile-head-item mobile-head-nav"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="mobile-head-item mobile-head-language"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div><div class="content-wrap"></div></></div>';
            $("body").append(mobileService);
            if ($("body .aside").length > 0) {
                $(".mobile-head-items").append(
                    '<div class="mobile-head-item mobile-head-aside"><div class="title"></div><div class="main-content-wrap side-content-wrap"><div class="content-wrap"></div></div></div>'
                );
            }
            $(".mobile-head-item").each(function () {
                $(this)
                    .find(".title")
                    .click(function () {
                        if (
                            $(this)
                                .parents(".mobile-head-item")
                                .find(".main-content-wrap").length > 0
                        ) {
                            var pItem = $(this).parents(".mobile-head-item");
                            if (
                                !pItem
                                    .find(".main-content-wrap")
                                    .hasClass("show-content-wrap")
                            ) {
                                pItem
                                    .find(".main-content-wrap")
                                    .addClass("show-content-wrap");
                                pItem
                                    .find(".side-content-wrap")
                                    .stop()
                                    .animate({ left: "0" }, 300);
                                pItem
                                    .find(".middle-content-wrap")
                                    .addClass("middle-show-content-wrap");
                                pItem
                                    .find(".side-content-wrap")
                                    .append("<b class='mobile-ico-close'></b>");
                                pItem
                                    .siblings(".mobile-head-item")
                                    .find(".main-content-wrap")
                                    .removeClass("show-content-wrap");
                                pItem
                                    .siblings(".mobile-head-item")
                                    .find(".side-content-wrap")
                                    .stop()
                                    .animate({ left: "-70%" }, 300);
                                pItem
                                    .siblings(".mobile-head-item")
                                    .find(".middle-content-wrap")
                                    .removeClass("middle-show-content-wrap");
                                pItem
                                    .siblings(".mobile-head-item")
                                    .find(
                                        ".side-content-wrap .mobile-ico-close"
                                    )
                                    .remove();
                                if (
                                    $(".mobile-head-items").find(
                                        ".mobile-body-mask"
                                    ).length < 1
                                ) {
                                    $(".mobile-head-items").append(
                                        '<div class="mobile-body-mask"></div>'
                                    );
                                }
                            } else {
                                pItem
                                    .find(".main-content-wrap")
                                    .removeClass("show-content-wrap");
                                pItem
                                    .find(".side-content-wrap")
                                    .stop()
                                    .animate({ left: "-70%" }, 300);
                                pItem
                                    .find(".middle-content-wrap")
                                    .removeClass("middle-show-content-wrap");
                                pItem
                                    .find(
                                        ".side-content-wrap .mobile-ico-close"
                                    )
                                    .remove();
                            }
                            $(".mobile-body-mask").click(function () {
                                $(".mobile-body-mask").remove();
                                $(
                                    ".mobile-head-item .main-content-wrap"
                                ).removeClass("show-content-wrap");
                                $(
                                    ".mobile-head-item .side-content-wrap"
                                ).animate({ left: "-70%" }, 300);
                                $(
                                    ".mobile-head-item .middle-content-wrap"
                                ).removeClass("middle-show-content-wrap");
                                $(
                                    ".mobile-head-item .side-content-wrap .mobile-ico-close"
                                ).remove();
                            });
                            $(".mobile-ico-close").click(function () {
                                $(".mobile-body-mask").remove();
                                $(
                                    ".mobile-head-item .main-content-wrap"
                                ).removeClass("show-content-wrap");
                                $(".mobile-head-item .side-content-wrap")
                                    .stop()
                                    .animate({ left: "-70%" }, 300);
                                $(
                                    ".mobile-head-item .middle-content-wrap"
                                ).removeClass("middle-show-content-wrap");
                                $(
                                    ".mobile-head-item .side-content-wrap .mobile-ico-close"
                                ).remove();
                            });
                        }
                    });
            });
            $(".change-currency ")
                .clone()
                .appendTo(
                    ".mobile-head-item.mobile-head-currency .main-content-wrap .content-wrap"
                );
            $(".change-language .change-language-cont")
                .clone()
                .appendTo(
                    ".mobile-head-item.mobile-head-language .main-content-wrap .content-wrap"
                );
            $(".nav_wrap .head_nav")
                .clone()
                .appendTo(
                    ".mobile-head-item.mobile-head-nav .main-content-wrap .content-wrap"
                );
            $(".head-search:last")
                .clone()
                .appendTo(
                    ".mobile-head-item.mobile-head-search .main-content-wrap .content-wrap"
                );
            $(".head_sns")
                .clone()
                .appendTo(
                    ".mobile-head-item.mobile-head-social .main-content-wrap .content-wrap"
                );
            $(".aside .aside-wrap")
                .clone()
                .appendTo(
                    ".mobile-head-item.mobile-head-aside .main-content-wrap .content-wrap"
                );
        }
    }
    //mobile end
    else {
        $(document).ready(function () {
            $(
                ".mobile-body-mask,.mobile-head-items,.mobile-head-items,.mobile-nav-items,.mobile-cart-items,.mobile-tab-items"
            ).remove();
        });
    }
}
$(function () {
    mSizeChange();
});
$(window).resize(function () {
    mSizeChange();
});
/*side*/
$(function () {
    $(".side-widget .side-cate li").each(function () {
        if ($(this).find("ul").length > 0) {
            $(this).append("<span class='icon-cate icon-cate-down'></span>");
            $(this)
                .children(".icon-cate")
                .click(function (e) {
                    if ($(this).parent("li").children("ul").is(":hidden")) {
                        $(this).parent("li").children("ul").slideDown(100);
                        $(this)
                            .removeClass("icon-cate-down")
                            .addClass("icon-cate-up");
                    } else {
                        $(this).parent("li").children("ul").slideUp(100);
                        $(this)
                            .removeClass("icon-cate-up")
                            .addClass("icon-cate-down");
                    }
                    e.stopPropagation();
                });
        }
    });

    if (
        $(".side-widget .side-cate .nav-current").parents("ul").length > 0 &&
        $(".side-widget .side-cate .nav-current").find("ul").length > 0
    ) {
        $(".side-widget .side-cate .nav-current").parents("ul").show();
        $(".side-widget .side-cate .nav-current")
            .parents("li")
            .addClass("show_li");
        $(".side-widget .side-cate .nav-current")
            .parents("li.show_li")
            .children(".icon-cate")
            .removeClass("icon-cate-down")
            .addClass("icon-cate-up");
        $(".side-widget .side-cate .nav-current").children("ul").show();
        $(".side-widget .side-cate .nav-current ")
            .children(".icon-cate")
            .removeClass("icon-cate-down")
            .addClass("icon-cate-up");
    } else if (
        $(".side-widget .side-cate .nav-current").parents("ul").length > 0 &&
        $(".side-widget .side-cate .nav-current").find("ul").length < 1
    ) {
        $(".side-widget .side-cate .nav-current").parents("ul").show();
        $(".side-widget .side-cate .nav-current")
            .parents("li")
            .addClass("show_li");
        $(".side-widget .side-cate .nav-current")
            .parents("li.show_li")
            .children(".icon-cate")
            .removeClass("icon-cate-down")
            .addClass("icon-cate-up");
    } else if (
        $(".side-widget .side-cate .nav-current").parents("ul").length < 1 &&
        $(".side-widget .side-cate .nav-current").find("ul").length > 0
    ) {
        $(".side-widget .side-cate .nav-current").children("ul").show();
        $(".side-widget .side-cate .nav-current")
            .children(".icon-cate")
            .removeClass("icon-cate-down")
            .addClass("icon-cate-up");
    }
});
/*tabContainer*/
function tabContainer(container, title, panel) {
    $(container).each(function () {
        $(this)
            .find(title)
            .each(function () {
                if ($(this).hasClass("current")) {
                    j = $(this).index();
                    $(this)
                        .parents(container)
                        .find(panel)
                        .eq(j)
                        .removeClass("disabled");
                }
                $(this).click(function () {
                    i = $(this).index();
                    $(this)
                        .addClass("current")
                        .siblings()
                        .removeClass("current");
                    $(this).parents(container).find(panel).eq(i).show();
                    $(this)
                        .parents(container)
                        .find(panel)
                        .not($(this).parents(container).find(panel).eq(i))
                        .hide();
                });
            });
    });
}
/*search*/
document.documentElement.className = "js";
(function (window) {
    if (document.querySelector(".web-search")) {
        ("use strict");
        var mainContainer = document.querySelector(".container"),
            searchContainer = document.querySelector(".web-search"),
            openCtrl = document.getElementById("btn-search"),
            closeCtrl = document.getElementById("btn-search-close"),
            inputSearch = searchContainer.querySelector(".search-ipt");
        function init() {
            initEvents();
        }
        function initEvents() {
            openCtrl.addEventListener("click", function () {
                if (!searchContainer.classList.contains("search--open")) {
                    openSearch();
                } else {
                    closeSearch();
                }
            });
            closeCtrl.addEventListener("click", closeSearch);
            document.addEventListener("keyup", function (ev) {
                if (ev.keyCode == 27) {
                    closeSearch();
                }
            });
        }
        function openSearch() {
            mainContainer.classList.add("main-wrap--move");
            searchContainer.classList.add("search--open");
            setTimeout(function () {
                inputSearch.focus();
            }, 600);
        }
        function closeSearch() {
            mainContainer.classList.remove("main-wrap--move");
            searchContainer.classList.remove("search--open");
            inputSearch.blur();
            inputSearch.value = "";
        }
        init();
    }
})(window);

$(function () {
    $("#scrollsidebar").fix({ float: "right", durationTime: 400 });
});
$(".business_right .events li").on("click", function () {
    $(this).addClass("current").siblings("li").removeClass("current");
    var i = $(this).index();
    $(this)
        .parents(".index_business")
        .find(".business_middle .tab_content")
        .eq(i)
        .addClass("current")
        .siblings(".tab_content")
        .removeClass("current");
});
$("table").each(function () {
    if (!$(this).parent().hasClass("table_wrap")) {
        $(this).wrap("<div class='table_wrap'><//div>");
    }
});

/* -------------- header --------------*/

// dropmenu direction
$(function () {
    menuDirection(".head_nav>li");
    $(window).on("resize", function () {
        menuDirection(".head_nav>li");
    });
});
function menuDirection(ele) {
    var winW = $(window).innerWidth();
    $(ele).each(function () {
        if ($(this).find("ul").length) {
            var linkEleW = $(this).children("a").width();
            var offRight = winW - $(this).offset().left;
            var childLen = $(this).find("ul").length;
            var childrenWidth = childLen * 250 + 10;
            if (offRight < childrenWidth) {
                $(this).addClass("menu_left");
            } else {
                $(this).removeClass("menu_left");
            }
        }
    });
}

/* -------------- index --------------*/

var pdSwiper = new Swiper(".index_product .product_slider", {
    slidesPerView: 4,
    speed: 400,
    spaceBetween: 20,
    pagination: {
        el: ".index_product .swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".index_product .swiper-button-next",
        prevEl: ".index_product .swiper-button-prev",
    },
    breakpoints: {
        1200: {
            slidesPerView: 3,
        },
        950: {
            slidesPerView: 3,
            spaceBetween: 16,
        },
        767: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        640: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        480: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
    },
});

/* -------------- subpage --------------*/
var bnSwiper = new Swiper(".main_banner_slider", {
    effect: "fade",
    speed: 1000,
    loop: true,
    spaceBetween: 0,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".main_banner_slider .swiper-pagination",
        clickable: true,
    },
});

// search
$(function () {
    $(document).on("click", function () {
        $(".container").removeClass("main-wrap--move");
        $(".web-search").removeClass("search--open");
    });
    $(".btn--search,.web-search").on("click", function (e) {
        e.stopPropagation();
    });
});

// button
$(".sys_btn_wave").mouseenter(function (e) {
    var parentOffset = $(this).offset();
    var relX = e.pageX - parentOffset.left;
    var relY = e.pageY - parentOffset.top;
    $(this).find(".btn_wave_circle").css({ left: relX, top: relY });
    $(this).find(".btn_wave_circle").removeClass("desplode-circle");
    $(this).find(".btn_wave_circle").addClass("explode-circle");
});
$(".sys_btn_wave").mouseleave(function (e) {
    var parentOffset = $(this).offset();
    var relX = e.pageX - parentOffset.left;
    var relY = e.pageY - parentOffset.top;
    $(this).find(".btn_wave_circle").css({ left: relX, top: relY });
    $(this).find(".btn_wave_circle").removeClass("explode-circle");
    $(this).find(".btn_wave_circle").addClass("desplode-circle");
});

$(function () {
    $(".sys_select_box .select_toggle").on("click", function (select) {
        var selectBox = $(this).parents(".sys_select_box");
        if (!selectBox.hasClass("active")) {
            selectBox.addClass("active");
        } else {
            selectBox.removeClass("active");
        }
        select.stopPropagation();
    });
    $(".sys_select_box .select_menu").on("click", function (select) {
        select.stopPropagation();
    });
    $(document).on("click", function (select) {
        $(".sys_select_box").removeClass("active");
    });
});

// 数字效果

$.fn.countTo = function (options) {
    options = options || {};

    return $(this).each(function () {
        // 设置当前元素的选项
        var settings = $.extend(
            {},
            $.fn.countTo.defaults,
            {
                from: $(this).data("from"),
                to: $(this).data("to"),
                speed: $(this).data("speed"),
                refreshInterval: $(this).data("refresh-interval"),
                decimals: $(this).data("decimals"),
            },
            options
        );

        // 多少次更新的值，以及每个更新的值增加多少
        var loops = Math.ceil(settings.speed / settings.refreshInterval),
            increment = (settings.to - settings.from) / loops;

        // references & variables that will change with each update
        var self = this,
            $self = $(this),
            loopCount = 0,
            value = settings.from,
            data = $self.data("countTo") || {};

        $self.data("countTo", data);

        // 如果可以找到现有的间隔，请先清除
        if (data.interval) {
            clearInterval(data.interval);
        }
        data.interval = setInterval(updateTimer, settings.refreshInterval);

        // 用起始值初始化元素
        render(value);

        function updateTimer() {
            value += increment;
            loopCount++;

            render(value);

            if (typeof settings.onUpdate == "function") {
                settings.onUpdate.call(self, value);
            }

            if (loopCount >= loops) {
                // 删除间隔
                $self.removeData("countTo");
                clearInterval(data.interval);
                value = settings.to;

                if (typeof settings.onComplete == "function") {
                    settings.onComplete.call(self, value);
                }
            }
        }

        function render(value) {
            var formattedValue = settings.formatter.call(self, value, settings);
            $self.html(formattedValue);
        }
    });
};

$.fn.countTo.defaults = {
    from: 0, // 元素开始的数字
    to: 0, // 元素结束的数字
    speed: 1, // 在目标号码之间计算多长时间
    refreshInterval: 0.5, //  更新元素的频率
    decimals: 0, // 要显示的小数位数
    formatter: formatter, // 处理程序用于格式化渲染前的值
    onUpdate: null, // 每次元素更新时的回调方法
    onComplete: null, // 元素完成更新时的回调方法
};

function formatter(value, settings) {
    return value.toFixed(settings.decimals);
}

// 自定义格式化示例
$("#count-number").data("", {
    formatter: function (value, options) {
        return value
            .toFixed(options.decimals)
            .replace(/\B(?=(?:\d{3})+(?!\d))/g, " ");
    },
});
$(window).scroll(function () {
    if ($(window).scrollTop() > 200) {
        //500 根据数字上面的内容 计算高度  滚到此区域 数字开始滚动
        //开始所有的计时器
        $(".timer").each(count);
        $(".count-title").removeClass("timer");
    }
});

function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data("countToOptions") || {});
    $this.countTo(options);
}

$(
    "body > div.container > section > div > article > section.index_certificate > div.index_bd > div > div > ul > li:nth-child(5) > h3"
).html("ISO 9001 Certificate");

tailorismSwitch(".tailorism_tab", ".tailorism_items");
function tailorismSwitch(tab, tabitem) {
    $(tab).eq(0).addClass("current");
    $(tabitem).eq(0).addClass("current");
    $(tab).each(function () {
        $(this).on("click", function () {
            var i = $(this).index();
            $(this).addClass("current").siblings(tab).removeClass("current");
            $(tabitem)
                .eq(i)
                .addClass("current")
                .siblings(tabitem)
                .removeClass("current");
        });
    });
}
