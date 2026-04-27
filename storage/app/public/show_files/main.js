"use strict";

$(document).ajaxStart(function () {
});

$(document).ajaxComplete(function () {
    initThemeElements();
});

$(document).ready(function () {
    initThemeElements();
});


function toggleWishListTour(response) {

    let $wishlist_item = $('*[data-wishlist_tour_hashed_id="' + response.hashed_id + '"]'),
        parent = $wishlist_item.parent();

    if (response.action == "add") {
        parent.removeClass('wishlist');
        parent.addClass('wishlist_close');

        $wishlist_item.html(
            `- <span class="tooltip-content-flip">
            <span class="tooltip-back">
               ${$wishlist_item.data('remove_text')}
            </span>
        </span>`);

    } else {
        parent.removeClass('wishlist_close');
        parent.addClass('wishlist');

        $wishlist_item.html(
            `+ <span class="tooltip-content-flip">
            <span class="tooltip-back">
               ${$wishlist_item.data('add_text')}
            </span>
        </span>`);


    }
}

function toggleSingleTourWishlistButton(response) {

    let $wishlist_item = $('*[data-wishlist_tour_hashed_id="' + response.hashed_id + '"]'),
        text;

    if (response.action == "add") {
        text = $wishlist_item.data('remove_text');
        $wishlist_item.html(`<i class=" icon-heart"></i> ${text}`);
    } else {
        text = $wishlist_item.data('add_text');

        $wishlist_item.html(`<i class=" icon-heart"></i> ${text}`);
    }
}