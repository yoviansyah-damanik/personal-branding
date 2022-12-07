/* ==============
 ========= js documentation =========

 * theme name: Ronlio
 * version: 1.0
 * description: Portfolio Html Template
 * author: pixelaxis
 * author url: https://themeforest.net/user/pixelaxis

    =========================

     01. aos init
     ---------------------------
     02. browser tab title type js
     ---------------------------
     03. full page js
     ---------------------------
     04. profession type js
     ---------------------------
     05. hero video popup
     ---------------------------
     06. project slider
     ---------------------------
     07. price select

    =========================
============== */

(function ($) {
    "use strict";

    jQuery(document).ready(function () {
        // aos animation
        $("[data-aos]").each(function () {
            $(this).addClass("aos-init");
        });

        // browser tab title type js
        // if ($(".tab-title").length) {
        //     $(".tab-title").typed({
        //         strings: ["Professional..!", "Web Expert..!", "Hire Now..!"],
        //         typeSpeed: 300,
        //         backDelay: 500,
        //         loop: true,
        //         cursorChar: "|",
        //         contentType: "html",
        //         loopCount: false,
        //     });
        // }

        // full page js
        if ($(".main").length) {
            $(".main").fullpage({
                sectionName: "section-name",
                scrollOverflow: true,
                css3: true,
                scrollingSpeed: 1000,
                anchors: ["home", "about", "projects", "experiences", "blogs", "contact"],
                menu: ".nav__items",
                onLeave: function (index, nextIndex, direction) {
                    $(".section [data-aos]").each(function () {
                        $(this).removeClass("aos-animate");
                    });
                    if (nextIndex != 1) {
                        $(".header").addClass("sticky-active");
                    } else {
                        $(".header").removeClass("sticky-active");
                    }
                },
                onSlideLeave: function () {
                    $(".slide [data-aos]").each(function () {
                        $(this).removeClass("aos-animate");
                    });
                },
                afterSlideLoad: function () {
                    $(".slide.active [data-aos]").each(function () {
                        $(this).addClass("aos-animate");
                    });
                },
                afterLoad: function () {
                    $(".section.active [data-aos]").each(function () {
                        $(this).addClass("aos-animate");
                    });
                },
            });
        }

        // profession type js
        if ($(".typed").length) {
            $(".typed").typed({
                strings: ["Initiator", "Clever", "Changer"],
                typeSpeed: 300,
                backDelay: 900,
                loop: true,
                cursorChar: "|",
                contentType: "html",
                loopCount: false,
            });
        }

        // hero ideo popup
        if ($(".hero__popup").length) {
            $(".hero__popup").magnificPopup({
                type: "iframe",
            });
        }

        // project slider
        $(".projects__slider")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                autoplay: true,
                focusOnSelect: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                prevArrow: $(".prev-project-item"),
                nextArrow: $(".next-project-item"),
                centerMode: true,
                centerPadding: "0px",
            });

        // project slider
        $(".blogs__slider")
            .not(".slick-initialized")
            .slick({
                infinite: true,
                autoplay: true,
                focusOnSelect: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
                prevArrow: $(".prev-blog-item"),
                nextArrow: $(".next-blog-item"),
                centerMode: true,
                centerPadding: "0px",
            });

        // select price
        $(".price-range").niceSelect();
    });
})(jQuery);
