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
    <section class="hero relative !mt-0 z-0">
        <div class="swiper hero">
            <div class="swiper-wrapper">
                <?php
                if (have_rows('banner')):
                    $index = 0;
                    while (have_rows('banner')):
                        the_row();
                        $desktop_img = get_sub_field('desktop');
                        $mobile_img = get_sub_field('mobile');

                        $desktop_id = $desktop_img['ID'] ?? null;
                        $mobile_id = $mobile_img['ID'] ?? null;

                        $texto = get_sub_field('texto') ?? '';
                        $link_externo = get_sub_field('link_externo');

                        $is_first = ($index === 0);
                ?>
                        <div class="swiper-slide">
                            <a <?php
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
                                ?> href="<?= $href ?? ''; ?>" target="<?= $target ?? ''; ?>" <?= $fancybox ?? ''; ?>
                                class="relative w-full h-full" aria-label="<?= esc_attr($texto ?: 'Banner'); ?>">
                                <?= $play ?? ''; ?>
                                <picture>
                                    <?php if ($mobile_id): ?>
                                        <source media="(max-width: 1023px)"
                                            srcset="<?= wp_get_attachment_image_srcset($mobile_id); ?>" sizes="100vw">
                                    <?php endif; ?>

                                    <?php if ($desktop_id): ?>
                                        <source media="(min-width: 1024px)"
                                            srcset="<?= wp_get_attachment_image_srcset($desktop_id); ?>" sizes="100vw">
                                    <?php endif; ?>

                                    <img src="<?= esc_url($desktop_img['url'] ?? $mobile_img['url']); ?>"
                                        srcset="<?= $desktop_id ? wp_get_attachment_image_srcset($desktop_id) : ''; ?>"
                                        sizes="100vw" alt="Banner Stanza" loading="<?= $is_first ? 'eager' : 'lazy'; ?>"
                                        fetchpriority="<?= $is_first ? 'high' : 'auto'; ?>">
                                </picture>
                            </a>
                            <div class="gradient"></div>
                            <div class="hero-content absolute top-[120%] md:top-1/2 transform -translate-y-[120%] md:-translate-y-1/2 left-0 w-full z-10">
                                <div class="container">
                                    <div class="outer-content grid grid-cols-12">
                                        <div
                                            class="inner-content flex flex-col items-center lg:items-start col-span-12 md:col-span-6 xl:col-span-4 bg-(--verde) p-5 md:p-7 rounded-[10px]">
                                            <div class="slide-text text-center md:text-start">
                                                <span><?= get_sub_field('texto_superior') ?></span>
                                                <h2><?= get_sub_field('texto') ?></h2>
                                            </div>
                                            <a href="/empreendimentos"
                                                class="cta mt-6 xl:mt-10"><?= get_sub_field('texto_botao'); ?></a>
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
                                <a class="card-outer relative" href="<?= get_permalink(); ?>">
                                    <div class="card">
                                        <h3><?= get_the_title(); ?></h3>
                                        <?php if (have_rows('diferenciais_card')): ?>
                                            <div class="flex flex-row flex-nowrap justify-between items-center w-full my-6">
                                                <?php $i = 0; while (have_rows('diferenciais_card')):
                                                    the_row(); ?>
                                                    <div class="inline-flex flex-[1_1_auto] items-center dif-<?= $i; ?> gap-2">
                                                        <img class="w-7 h-7 object-contain" src="<?= get_sub_field('icone')['url'] ?>" alt="icon">
                                                        <p class="mb-0"><?= get_sub_field('texto'); ?></p>
                                                    </div>
                                                <?php $i++; endwhile; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="thumbnail-holder">
                                            <img class="thumbnail" src="<?= get_field('thumbnail')['url']; ?>"
                                                alt="<?= get_field('thumbnail')['title']; ?>">
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 lg:w-15 lg:h-15 rounded-full bg-(--amarelo) absolute right-[30px] bottom-[30px]">
                                        <img class="seta !w-6 !h-6 lg:!w-12 lg:!h-12 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                            src="<?= IMG_URI ?>arrow-right.svg" alt="">
                                    </div>
                                </a>
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
                <a href="/empreendimentos" class="cta w-full h-full lg:w-auto text-nowrap my-auto">
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
            if (have_rows('cards')):
            ?>
                <div class='swiper infraestrutura'>
                    <div class='swiper-wrapper'>
                        <?php
                        while (have_rows('cards')):
                            the_row();
                        ?>
                            <div class='swiper-slide'>
                                <div class="card">
                                    <img src="<?= get_sub_field('icone')['url']; ?>"
                                        alt="<?= get_sub_field('icone')['title']; ?>">
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
    $textos = get_field('textos');
    ?>
    <section class="localizacoes">
        <div class="container">
            <div class="flex flex-col md:grid md:grid-cols-12 items-start md:items-center">
                <div class="col-span-12 md:col-span-6">
                    <div class="flex flex-col items-start w-fit gap-4">
                        <span>Localizações</span>
                        <h2>
                            <?= $textos['titulo']; ?>
                        </h2>
                        <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                        <p><?= $textos['texto']; ?></p>
                        <div class="loc flex flex-row items-center gap-3">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M23.4039 21.4747C23.6959 21.3287 24.0314 21.2948 24.3467 21.3796C24.662 21.4644 24.9352 21.6619 25.1146 21.9347L25.1919 22.0707L27.8586 27.4041C27.9538 27.5943 28.002 27.8045 27.9994 28.0171C27.9968 28.2298 27.9433 28.4387 27.8435 28.6265C27.7436 28.8143 27.6003 28.9755 27.4255 29.0966C27.2507 29.2177 27.0495 29.2952 26.8386 29.3227L26.6666 29.3334H5.33327C5.12057 29.3335 4.91093 29.2827 4.72187 29.1852C4.53281 29.0877 4.36981 28.9464 4.24649 28.7731C4.12316 28.5998 4.04309 28.3995 4.01296 28.189C3.98283 27.9784 4.00351 27.7637 4.07327 27.5627L4.13994 27.4027L6.80661 22.0694C6.95607 21.7605 7.21891 21.5211 7.54042 21.401C7.86193 21.2809 8.21735 21.2895 8.53273 21.4248C8.8481 21.5602 9.09914 21.8119 9.2336 22.1277C9.36806 22.4435 9.37558 22.7989 9.25461 23.1201L9.19194 23.2627L7.49061 26.6667H24.5093L22.8079 23.2627C22.65 22.9466 22.6241 22.5807 22.7359 22.2454C22.8476 21.9101 23.0879 21.6329 23.4039 21.4747ZM15.9999 2.66675C18.4753 2.66675 20.8493 3.65008 22.5996 5.40042C24.3499 7.15076 25.3333 9.52473 25.3333 12.0001C25.3333 15.1761 23.6146 17.7561 21.8359 19.5867C20.8535 20.5848 19.7735 21.4817 18.6119 22.2641L18.1146 22.5921L17.6719 22.8707L17.4733 22.9907L17.1306 23.1881C16.4266 23.5881 15.5733 23.5881 14.8693 23.1881L14.5266 22.9894L14.1133 22.7374L13.8853 22.5921L13.3879 22.2641C12.2264 21.4817 11.1463 20.5848 10.1639 19.5867C8.38528 17.7561 6.66661 15.1761 6.66661 12.0001C6.66661 9.52473 7.64994 7.15076 9.40028 5.40042C11.1506 3.65008 13.5246 2.66675 15.9999 2.66675ZM15.9999 5.33341C14.2318 5.33341 12.5361 6.03579 11.2859 7.28604C10.0357 8.53628 9.33327 10.232 9.33327 12.0001C9.33327 14.1814 10.5199 16.1267 12.0759 17.7281C13.0119 18.6734 14.0462 19.516 15.1613 20.2414L15.6146 20.5307C15.7551 20.617 15.8835 20.6943 15.9999 20.7627L16.3866 20.5307L16.8386 20.2414C17.9537 19.516 18.988 18.6734 19.9239 17.7281C21.4799 16.1281 22.6666 14.1814 22.6666 12.0001C22.6666 10.232 21.9642 8.53628 20.714 7.28604C19.4637 6.03579 17.7681 5.33341 15.9999 5.33341ZM15.9999 8.00008C17.0608 8.00008 18.0782 8.42151 18.8284 9.17165C19.5785 9.9218 19.9999 10.9392 19.9999 12.0001C19.9999 13.0609 19.5785 14.0784 18.8284 14.8285C18.0782 15.5787 17.0608 16.0001 15.9999 16.0001C14.9391 16.0001 13.9217 15.5787 13.1715 14.8285C12.4214 14.0784 11.9999 13.0609 11.9999 12.0001C11.9999 10.9392 12.4214 9.9218 13.1715 9.17165C13.9217 8.42151 14.9391 8.00008 15.9999 8.00008ZM15.9999 10.6667C15.6463 10.6667 15.3072 10.8072 15.0571 11.0573C14.8071 11.3073 14.6666 11.6465 14.6666 12.0001C14.6666 12.3537 14.8071 12.6928 15.0571 12.9429C15.3072 13.1929 15.6463 13.3334 15.9999 13.3334C16.3536 13.3334 16.6927 13.1929 16.9428 12.9429C17.1928 12.6928 17.3333 12.3537 17.3333 12.0001C17.3333 11.6465 17.1928 11.3073 16.9428 11.0573C16.6927 10.8072 16.3536 10.6667 15.9999 10.6667Z"
                                    fill="#FDB933" />
                            </svg>
                            <span>MANAUS - AMAZONAS</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-4 mt-10">
                        <?php
                        $args_loc = array(
                            'post_type'      => 'empreendimento',
                            'posts_per_page' => 2,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'post_status'    => 'publish',
                        );
                        $query_loc = new WP_Query($args_loc);
                        if ($query_loc->have_posts()):
                            while ($query_loc->have_posts()):
                                $query_loc->the_post();
                        ?>
                                <a class="card-outer relative col-span-3" href="<?= get_permalink(); ?>">
                                    <div class="card card-small">
                                        <h3><?= get_the_title(); ?></h3>
                                        <div class="thumbnail-holder thumbnail-holder--small">
                                            <img class="thumbnail" src="<?= get_field('thumbnail')['url']; ?>"
                                                alt="<?= get_field('thumbnail')['title']; ?>">
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 rounded-full bg-(--amarelo) absolute right-4 bottom-4">
                                        <img class="seta !w-6 !h-6 lg:!w-8 lg:!h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                            src="<?= IMG_URI ?>arrow-right.svg" alt="">
                                    </div>
                                </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6">
                    <img src="<?= IMG_URI ?>map.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <?php
    if (have_rows('itens')):
    ?>
        <section class="diferenciais bg-[#FDB9331A] py-8 md:py-16">
            <div class="container">
                <div
                    class="flex flex-col md:grid md:grid-cols-12 items-center justify-center content-center gap-x-7 gap-y-8">
                    <?php
                    while (have_rows('itens')):
                        the_row();
                    ?>
                        <div class="w-full md:col-span-6 xl:col-span-3">
                            <div class="flex flex-col items-center gap-6">
                                <span
                                    class="w-full text-center !text-white py-2 bg-(--verde) rounded-[10px]"><?= get_sub_field('rotulo'); ?></span>
                                <div class="flex flex-row items-center gap-2">
                                    <img src="<?= get_sub_field('icone')['url']; ?>"
                                        alt="<?= get_sub_field('icone')['title']; ?>">
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
                <div class="flex flex-col md:grid md:grid-cols-12 items-center justify-center content-center gap-x-7 gap-y-8">
                    <div class="col-span-12 md:col-span-6">
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
                    <div class="col-span-12 md:col-span-6">
                        <img src="<?= $sobre['imagem']['url']; ?>" alt="<?= $sobre['imagem']['title']; ?>">
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="app">
        <div class="container">
            <div
                class="flex flex-col lg:flex-row lg:justify-between text-center items-center lg:items-stretch w-full bg-(--verde) p-6 lg:p-11 rounded-[10px] gap-6 lg:gap-0">
                <div class="flex flex-col items-center justify-center">
                    <img src="<?= IMG_URI ?>app.svg" alt="App Store">
                </div>
                <div class="hidden lg:block border-r border-(--amarelo) border-[3px] h-auto"></div>
                <div class="flex flex-col items-center lg:items-start text-white justify-center">
                    <span>CONFIRA AGORA</span>
                    <h2>Nosso aplicativo</h2>
                </div>
                <div class="hidden lg:block border-r border-(--amarelo) border-[3px] h-auto"></div>
                <div class="flex flex-col items-center justify-center max-w-120">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et. Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="hidden lg:block border-r border-(--amarelo) border-[3px] h-auto"></div>
                <a href="#" class="cta w-full lg:w-auto text-nowrap my-auto">
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
                                <a class="card-outer relative" href="<?= get_permalink(); ?>">
                                    <div class="card">
                                        <h3><?= get_the_title(); ?></h3>
                                        <p class="!my-4"><?= get_the_excerpt(); ?></p>
                                        <div class="thumbnail-holder">
                                            <img class="thumbnail"
                                                src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"
                                                alt="<?= get_the_title(); ?>">
                                        </div>
                                    </div>
                                    <div class="w-10 h-10 lg:w-15 lg:h-15 rounded-full bg-(--amarelo) absolute right-[30px] bottom-[30px]">
                                        <img class="seta !w-6 !h-6 lg:!w-12 lg:!h-12 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                            src="<?= IMG_URI ?>arrow-right.svg" alt="">
                                    </div>
                                </a>
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
            pagination: false,
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