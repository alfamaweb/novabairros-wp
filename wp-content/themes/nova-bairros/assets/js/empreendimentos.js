jQuery(function ($) {
    var $section = $('.empreendimentos');

    if (!$section.length || typeof nbEmpreendimentos === 'undefined') {
        return;
    }

    var $cards = $('#empreendimentos-cards');
    var $paginationWrapper = $('#empreendimentos-pagination-wrapper');

    function loadPage(page) {
        if ($section.hasClass('is-loading')) {
            return;
        }

        $section.addClass('is-loading');

        $.post(nbEmpreendimentos.ajaxUrl, {
            action: 'nb_load_empreendimentos',
            nonce: nbEmpreendimentos.nonce,
            paged: page,
        })
            .done(function (response) {
                if (response && response.success) {
                    $cards.html(response.data.cards);
                    $paginationWrapper.html(response.data.pagination);

                    $('html, body').animate({
                        scrollTop: $section.offset().top - 100,
                    }, 300);
                }
            })
            .always(function () {
                $section.removeClass('is-loading');
            });
    }

    $paginationWrapper.on('click', '.empreendimentos-pagination__item', function (e) {
        e.preventDefault();

        var $button = $(this);
        var page = $button.data('page');

        if ($button.hasClass('is-active') || !page) {
            return;
        }

        loadPage(page);
    });
});
