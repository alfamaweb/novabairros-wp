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
            <div class="flex items-center justify-center my-12">
                <a href="/blog" class="cta w-full h-full lg:w-auto text-nowrap my-auto">
                    Ver todos empreendimentos
                </a>
            </div>
        </div>
    </section>

    <section class="infraestrutura bg-(--verde) py-11">
        <div class="container">
            <div class="flex flex-col justify-center gap-3 w-fit mx-auto text-center items-center mb-10">
                <span>INFRAESTRUTURA COMPLETA</span>
                <h2>Qualidade de vida que você merece</h2>
                <div class="border-b border-(--amarelo) border-[3px] w-full"></div>
            </div>
            <?php
            if (have_rows('cards')) :
            ?>
                <div class='swiper infraestrutura'>
                    <div class='swiper-wrapper'>
                        <?php
                        while (have_rows('cards')) : the_row();
                        ?>
                            <div class='swiper-slide'>
                                <div class="card">
                                    <img src="<?= get_sub_field('icone')['url']; ?>" alt="<?= get_sub_field('icone')['title']; ?>">
                                    <h3><?= get_sub_field('titulo'); ?></h3>
                                    <p><?= get_sub_field('texto'); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php
    if (have_rows('itens')) :
    ?>
        <section class="diferenciais bg-[#FDB9331A] py-8 md:py-16">
            <div class="container">
                <div class="flex flex-col md:grid md:grid-cols-12 items-center justify-center content-center gap-x-7 gap-y-8">
                    <?php
                    while (have_rows('itens')) : the_row();
                    ?>
                        <div class="w-full md:col-span-6 xl:col-span-3">
                            <div class="flex flex-col items-center gap-6">
                                <span class="w-full text-center text-white py-2 bg-(--verde) rounded-[10px]"><?= get_sub_field('rotulo'); ?></span>
                                <div class="flex flex-row items-center gap-2">
                                    <img src="<?= get_sub_field('icone')['url']; ?>" alt="<?= get_sub_field('icone')['title']; ?>">
                                    <h3><?= get_sub_field('titulo'); ?></h3>
                                </div>
                                <p><?= get_sub_field('texto'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php
    endif;
    if (!empty(get_field('sobre_nos'))):
        $sobre = get_field('sobre_nos');
    ?>
        <section class="sobre">
            <div class="container">
                <div class="grid grid-cols-12 items-center justify-center content-center gap-x-7 gap-y-8">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex flex-col items-start w-fit gap-3">
                            <span>SOBRE NÓS</span>
                            <h2><?= $sobre['titulo']; ?></h2>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                        </div>
                        <div class="content mt-8">
                            <?= nl2br($sobre['texto']); ?>
                        </div>
                        <a href="#" class="cta">Saiba mais sobre nós</a>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <img src="<?= $sobre['imagem']['url']; ?>" alt="<?= $sobre['imagem']['title']; ?>">
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="app">
        <div class="container">
            <div class="flex flex-row justify-between w-fit text-center items-stretch w-full bg-(--verde) lg:p-11 rounded-[10px]">
                <div class="flex flex-col items-center justify-center">
                    <img src="<?= IMG_URI ?>app.svg" alt="App Store">
                </div>
                <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                <div class="flex flex-col items-start text-white justify-center">
                    <span>CONFIRA AGORA</span>
                    <h2>Nosso aplicativo</h2>
                </div>
                <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                <div class="flex flex-col items-center justify-center max-w-120">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                <a href="#" class="cta w-full h-full lg:w-auto text-nowrap my-auto">
                    Acesse o aplicativo
                </a>
            </div>
        </div>
    </section>

    <section class="empreendimentos">
        <div class="container">
            <div class="flex flex-col justify-center gap-3 w-fit mx-auto text-center items-center mb-10">
                <span>BLOG DE NOTÍCIAS</span>
                <h2>Fique por dentro das novidades</h2>
                <div class="border-b border-(--amarelo) border-[3px] w-full"></div>
            </div>
            <div class='swiper blog'>
                <div class='swiper-wrapper'>
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 5,
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
                                    <p class="!my-4"><?= get_the_excerpt(); ?></p>
                                    <img class="thumbnail" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>" alt="<?= get_the_title(); ?>">
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
            <div class="flex items-center justify-center my-12">
                <a href="/blog" class="cta w-full h-full lg:w-auto text-nowrap my-auto">
                    Ver todas as notícias
                </a>
            </div>
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
        const swiperInfra = new Swiper('.swiper.infraestrutura', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            breakpoints: {
                0: {
                    slidesPerView: 1.5,
                    centedredSlides: true,
                    spaceBetween: 36
                },
                768: {
                    slidesPerView: 2.5
                },
                1200: {
                    slidesPerView: 6,
                    spaceBetween: 30
                },
            },
            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
        const swiperBlog = new Swiper('.swiper.blog', {
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