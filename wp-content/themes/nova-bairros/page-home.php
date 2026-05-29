<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */

get_header(); ?>

<main class="h-svh overflow-hidden">
    <section class="hero h-full relative !mt-0">
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
                            <div class="hero-content">
                                <div class="container h-100">
                                    <div class="row h-100 align-items-center">
                                        <div class="col-lg-6">
                                            <div class="slide-text">
                                                <?=
                                                get_sub_field('texto')
                                                ?>
                                            </div>
                                            <a href="/empreendimentos" class="cta mt-10">CONHEÇA SEU NOVO LAR</a>
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
</main>

<?php get_footer(); ?>