<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */

get_header(); ?>

<main>
    <section class="hero relative !mt-0">
        <div class="swiper hero">
            <div class="swiper-wrapper">
                <?php
                if (have_rows('banner')):
                    $index = 0;
                    while (have_rows('banner')): the_row();
                        $desktop_img = get_sub_field('desktop');
                        $mobile_img  = get_sub_field('mobile');

                        $desktop_id = $desktop_img['ID'] ?? null;
                        $mobile_id  = $mobile_img['ID'] ?? null;

                        $texto   = get_sub_field('texto') ?? '';
                        $link_externo = get_sub_field('link_externo');

                        $is_first = ($index === 0);
                ?>
                        <div class="swiper-slide">
                            <a
                                <?php
                                $href = '';
                                $target = '_self';
                                $fancybox = '';
                                $play = '';
                                switch ($link_externo) {
                                    case 'externo':
                                        $href = get_sub_field('url');
                                        $target = '_blank';
                                        $play = '';
                                        break;
                                    case 'iframe':
                                        $href = get_sub_field('iframe');
                                        $target = '_self';
                                        $fancybox = 'data-fancybox="banner" data-type="iframe" data-width="80%" data-height="80%"';
                                        $play = '
                                            <div class="absolute w-fit top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8 lg:w-24 lg:h-24 hover:opacity-70 transition-opacity duration-300 ease-in-out">
                                                <img 
                                                    src="' . IMG_URI . 'play.svg" 
                                                    alt="" 
                                                    width="140" 
                                                    height="140"
                                                    class="w-full h-full"
                                                    loading="lazy"
                                                    decoding="async">
                                            </div>';
                                        break;
                                }
                                ?>
                                href="<?= $href ?? ''; ?>"
                                target="<?= $target ?? ''; ?>"
                                <?= $fancybox ?? ''; ?>
                                class="relative w-full h-full"
                                aria-label="<?= esc_attr($texto ?: 'Banner'); ?>">
                                <?= $play ?? ''; ?>
                                <picture>
                                    <?php if ($mobile_id) : ?>
                                        <source
                                            media="(max-width: 1023px)"
                                            srcset="<?= wp_get_attachment_image_srcset($mobile_id); ?>"
                                            sizes="100vw">
                                    <?php endif; ?>

                                    <?php if ($desktop_id) : ?>
                                        <source
                                            media="(min-width: 1024px)"
                                            srcset="<?= wp_get_attachment_image_srcset($desktop_id); ?>"
                                            sizes="100vw">
                                    <?php endif; ?>

                                    <img
                                        src="<?= esc_url($desktop_img['url'] ?? $mobile_img['url']); ?>"
                                        srcset="<?= $desktop_id ? wp_get_attachment_image_srcset($desktop_id) : ''; ?>"
                                        sizes="100vw"
                                        alt="Banner Stanza"
                                        loading="<?= $is_first ? 'eager' : 'lazy'; ?>"
                                        fetchpriority="<?= $is_first ? 'high' : 'auto'; ?>">
                                </picture>
                            </a>
                            <div class="gradient"></div>
                            <div class="hero-content absolute top-1/2 transform -translate-y-1/2 left-0 w-full">
                                <div class="container">
                                    <div class="outer-content grid grid-cols-12">
                                        <div class="inner-content col-span-12 md:col-span-4 bg-(--verde) p-5 md:p-7 rounded-[10px]">
                                            <div class="slide-text">
                                                <span><?= get_sub_field('texto_superior') ?></span>
                                                <?=
                                                get_sub_field('texto')
                                                ?>
                                            </div>
                                            <a href="/empreendimentos" class="cta mt-10"><?= get_sub_field('texto_botao'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $index++;
                    endwhile;
                endif;
                ?>
            </div>
            <div class="swiper-pagination !bottom-10 lg:!bottom-20"></div>
        </div>
        <div class="swiper-prev-custom hidden lg:block"></div>
        <div class="swiper-next-custom hidden lg:block"></div>
    </section>

    <section class="empreendimentos">
        <div class="container">
            <div class="flex flex-col justify-center gap-3 w-fit mx-auto text-center items-center mb-10">
                <span>Nossos Emprendimentos</span>
                <h2>Escolha a opção ideal</h2>
                <div class="border-b border-(--amarelo) border-[3px] w-full"></div>
            </div>
            <div class='swiper empreendimentos'>
                <div class='swiper-wrapper'>
                    <?php
                    $args = array(
                        'post_type' => 'empreendimento',
                        'posts_per_page' => 10,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'post_status' => 'publish'
                    );
                    $the_query = new WP_Query($args);
                    if ($the_query->have_posts()) {
                        while ($the_query->have_posts()) {
                            $the_query->the_post();
                    ?>
                            <div class="swiper-slide">
                                <div class="card">
                                    <h3><?= get_the_title(); ?></h3>
                                    <?php
                                    if (have_rows('diferenciais_card')) :
                                    ?>
                                        <div class="flex flex-row flex-nowrap justify-between items-center w-full my-6">
                                            <?php
                                            while (have_rows('diferenciais_card')) : the_row();
                                            ?>
                                                <div class="inline-flex flex-[1_1_auto] items-center gap-2">
                                                    <img src="<?= get_sub_field('icone')['url']; ?>" alt="Dot" loading="lazy" decoding="async">
                                                    <p class="mb-0"><?= get_sub_field('texto'); ?></p>
                                                </div>
                                            <?php endwhile; ?>

                                        </div>
                                    <?php endif; ?>
                                    <img class="thumbnail" src="<?= get_field('thumbnail')['url']; ?>" alt="<?= get_field('thumbnail')['title']; ?>">
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                    }
                    wp_reset_postdata();
                    ?>
                </div>

                <div class='swiper-button-prev'></div>
                <div class='swiper-button-next'></div>
            </div>
        </div>
    </section>

    <section class="infraestrutura bg-(--verde) py-11">
        <div class="container">

        </div>
    </section>
</main>

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper.empreendimentos', {
            direction: 'horizontal',
            loop: false,
            spaceBetween: 30,
            breakpoints: {
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 2,
                },
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    });
</script>