/* ==============
 ========= js documentation =========

 * theme name: Ronlio
 * version: 1.0
 * description: Portfolio Html Template
 * author: pixelaxis
 * author url: https://themeforest.net/user/pixelaxis

    =========================

     01. data background
     ---------------------------
     02. navbar
     ---------------------------
     03. experience tab
     ---------------------------
     04. preloader

    =========================
============== */

(function ($) {
    "use strict";

    jQuery(document).ready(function () {
        // data background
        $("[data-background]").each(function () {
            $(this).css(
                "background-image",
                "url(" + $(this).attr("data-background") + ")"
            );
        });

        // navbar
        $(".nav__bar").on("click", function () {
            $(this).toggleClass("nav__bar-toggle");
            $(".nav__items").toggleClass("nav__items-active");
            $(".backdrop").toggleClass("backdrop-active");
            $(".nav__item").addClass("nav__item__active");
        });

        $(".backdrop, .close").on("click", function () {
            $(".backdrop").removeClass("backdrop-active");
            $(".nav__bar").removeClass("nav__bar-toggle");
            $(".nav__items").removeClass("nav__items-active");
            $(".nav__item").removeClass("nav__item__active");
        });

        // experience tab
        $(".experience__content-tab-content").hide();
        $(".experience__content-tab-content:first").show();
        $(".tab-btn").on("click", function () {
            $(".tab-btn").removeClass("tab-btn-active");
            $(this).addClass("tab-btn-active");
            $(".experience__content-tab-content").hide();
            var activeExperience = $(this).attr("href");
            $(activeExperience).fadeIn(300);
            return false;
        });

        // preloader
        setTimeout(function () {
            $("#ctn-preloader").addClass("loaded");
            if ($("#ctn-preloader").hasClass("loaded")) {
                $("#preloader")
                    .delay(1000)
                    .queue(function () {
                        $(this).remove();
                    });
            }
        }, 1000);
    });
})(jQuery);
