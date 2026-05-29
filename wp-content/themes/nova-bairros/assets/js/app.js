//Loading
$(window).on("load", function () {
    // weave your magic here.
    $(".loading").fadeOut("slow");
    $("body").addClass("loaded");
});

$(document).ready(function () {
    $("a").each(function (index) {
        if (this.hasAttribute("href")) {
            if (this.href.trim() == window.location) $(this).addClass("active");
        }
    });

    $('[name="cpf"]').on("input", function (e) {
        let value = e.target.value;

        value = value.replace(/\D/g, "");

        if (value.length > 3) {
            value = value.replace(/^(\d{3})/, "$1.");
        }
        if (value.length > 7) {
            value = value.replace(/^(\d{3}).(\d{3})/, "$1.$2.");
        }
        if (value.length > 11) {
            value = value.replace(/^(\d{3}).(\d{3}).(\d{3})/, "$1.$2.$3-");
        }

        if (value.length > 14) {
            value = value.slice(0, 14);
        }

        e.target.value = value;
    });

    $('[type="tel"]').on("input", function (e) {
        let input = e.target;

        let value = input.value.replace(/\D/g, "");

        value = value.substring(0, 11);

        if (value.length <= 10) {
            value = value.replace(/^(\d{2})(\d{4})(\d{0,4})$/, "($1) $2-$3");
        } else {
            value = value.replace(/^(\d{2})(\d{5})(\d{0,4})$/, "($1) $2-$3");
        }

        input.value = value;
    });

    $('[name="cnpj"]').on("input", function (e) {
        let value = e.target.value;

        value = value.replace(/\D/g, "");

        if (value.length > 2) {
            value = value.replace(/^(\d{2})/, "$1.");
        }
        if (value.length > 6) {
            value = value.replace(/^(\d{2}).(\d{3})/, "$1.$2.");
        }
        if (value.length > 10) {
            value = value.replace(/^(\d{2}).(\d{3}).(\d{3})/, "$1.$2.$3/");
        }
        if (value.length > 15) {
            value = value.replace(
                /^(\d{2}).(\d{3}).(\d{3}).(\d{4})/,
                "$1.$2.$3/$4-"
            );
        }

        if (value.length > 18) {
            value = value.slice(0, 18);
        }

        e.target.value = value;
    });
});

// Mobile Menu
$(document).on('click', '.js-menu-toggle', function (e) {
    e.preventDefault();
    $('#mobile-menu').addClass('is-open').attr('aria-hidden', 'false');
    $('body').css('overflow', 'hidden');
});

$(document).on('click', '.js-menu-close', function () {
    $('#mobile-menu').removeClass('is-open').attr('aria-hidden', 'true');
    $('body').css('overflow', '');
});

$(document).on('keydown', function (e) {
    if (e.key === 'Escape' && $('#mobile-menu').hasClass('is-open')) {
        $('#mobile-menu').removeClass('is-open').attr('aria-hidden', 'true');
        $('body').css('overflow', '');
    }
});

// Gmaps Scroll Fix
$(".map-fix").click(function () {
    $(this).css("display", "none");
});

// Replace all SVG images with inline SVG
jQuery("img.svg").each(function () {
    var $img = jQuery(this);
    var imgID = $img.attr("id");
    var imgClass = $img.attr("class");
    var imgURL = $img.attr("src");
    jQuery.get(
        imgURL,
        function (data) {
            var $svg = jQuery(data).find("svg");
            if (typeof imgID !== "undefined") {
                $svg = $svg.attr("id", imgID);
            }
            if (typeof imgClass !== "undefined") {
                $svg = $svg.attr("class", imgClass + " replaced-svg");
            }
            $svg = $svg.removeAttr("xmlns:a");
            $img.replaceWith($svg);
        },
        "xml"
    );
});
