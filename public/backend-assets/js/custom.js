/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).on('tooltipReset', () => {
    $(".tooltip").remove()
    $("[data-toggle='tooltip']").tooltip();
})

$(document).on('selectricReset', () => {
    $(".selectric").selectric({
        disableOnMobile: false,
        nativeOnMobile: false
    });
})
