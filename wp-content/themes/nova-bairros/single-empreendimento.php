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
    <?php
    $hero = get_field('hero');
    if ($hero):
        $desktop_img = $hero['desktop'];
        $mobile_img = $hero['mobile'];
        $desktop_id = $desktop_img['ID'] ?? null;
        $mobile_id = $mobile_img['ID'] ?? null;
        $texto = $hero['texto'] ?? '';
        $link_externo = $hero['link_externo'] ?? '';

        $href = '';
        $target = '_self';
        $fancybox = '';
        $play = '';
        switch ($link_externo) {
            case 'externo':
                $href = $hero['url'];
                $target = '_blank';
                break;
            case 'iframe':
                $href = $hero['iframe'];
                $fancybox = 'data-fancybox="banner" data-type="iframe" data-width="80%" data-height="80%"';
                $play = '
                    <div class="absolute w-fit top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8 lg:w-24 lg:h-24 hover:opacity-70 transition-opacity duration-300 ease-in-out">
                        <img src="' . IMG_URI . 'play.svg" alt="" width="140" height="140" class="w-full h-full" loading="lazy" decoding="async">
                    </div>';
                break;
        }
    ?>
        <section class="hero relative !mt-0">
            <a href="<?= $href; ?>" target="<?= $target; ?>" <?= $fancybox; ?> class="relative w-full h-full"
                aria-label="<?= esc_attr($texto ?: get_the_title()); ?>">
                <?= $play; ?>
                <picture>
                    <?php if ($mobile_id): ?>
                        <source media="(max-width: 1023px)" srcset="<?= wp_get_attachment_image_srcset($mobile_id); ?>"
                            sizes="100vw">
                    <?php endif; ?>

                    <?php if ($desktop_id): ?>
                        <source media="(min-width: 1024px)" srcset="<?= wp_get_attachment_image_srcset($desktop_id); ?>"
                            sizes="100vw">
                    <?php endif; ?>

                    <img class="w-full h-full object-cover object-center brightness-70 min-h-[300px] max-h-[680px]"
                        src="<?= esc_url($desktop_img['url'] ?? $mobile_img['url']); ?>"
                        srcset="<?= $desktop_id ? wp_get_attachment_image_srcset($desktop_id) : ''; ?>" sizes="100vw"
                        alt="<?= esc_attr(get_the_title()); ?>" loading="eager" fetchpriority="high">
                </picture>
            </a>
            <div class="gradient"></div>
            <div class="hero-content absolute top-1/2 transform -translate-y-1/2 left-0 w-full">
                <div class="container">
                    <div class="outer-content grid grid-cols-12 gap-8">
                        <div class="inner-content col-span-12 md:col-span-5 self-center">
                            <div class="breadcrumb flex flex-row items-center gap-3">
                                <a class="!text-white font-semibold !uppercase"
                                    href="<?= home_url(); ?>/empreendimentos">empreendimentos</a> <img
                                    src="<?= IMG_URI ?>arrow-left.svg" alt="Seta">
                                <p class="!text-white !uppercase font-bold"><?= get_the_title() ?></p>
                            </div>
                            <h1 class="!text-white !text-start"><?= $hero['titulo'] ?? get_the_title() ?></h1>
                        </div>
                        <div class="col-start-9 col-span-4">
                            <div class="form-container border border-(--verde) rounded-[10px] bg-white px-8 py-6">
                                <h3 class="text-(--verde) mb-4">Deseja saber mais?</h3>
                                <form action="" method="POST" class="flex flex-col gap-5 mt-8">
                                    <div class="form-group flex flex-col">
                                        <label for="nome">Nome Completo</label>
                                        <input type="text" name="nome" placeholder="Nome" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="telefone">Telefone</label>
                                        <input type="tel" name="telefone" placeholder="(XX) XXXXX-XXXX" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="email">E-mail</label>
                                        <input type="mail" name="email" placeholder="contato@gmail.com" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="mensagem">Mensagem</label>
                                        <select type="email" name="email" placeholder="E-mail" required>
                                            <option value="">Selecione</option>
                                            <option value="interessado">Estou interessado em investir</option>
                                            <option value="parceria">Quero ser parceiro</option>
                                            <option value="outros">Outros</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="cta self-start">Enviar formulário</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="resumo">
        <div class="container">
            <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                <div class="col-span-7">
                    <div class="flex flex-col items-start gap-6">
                        <img src="<?= IMG_URI ?>minas.jpg" alt="">
                        <h2>Reserva do Rio Preto</h2>
                        <p>O empreendimento possui praça de lazer completa, pista de caminhada, ciclovia, playground, quadra poliesportiva, academia ao ar livre, sinalização de trânsito e infraestrutura completa.
                            Lotes a partir de 300 m² parcelados em até 180 vezes e sem consulta
                            ao SPC/Serasa.</p>
                        <div class="itens-diferenciais flex items-center justify-between gap-7 w-full">
                            <div class="dif-item flex flex-row items-center gap-3">
                                <div class="rounded-full aspect-square w-15 h-15 relative bg-(--amarelo) content-center justify-items-center">
                                    <img src="<?= IMG_URI ?>door.svg" alt="icon" class="icon">
                                </div>
                                <p>Pórtico de Entrada</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-5">
                    <img class="w-full h-full object-cover rounded-[10px]" src="http://placehold.co/625x422" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="infraestrutura bg-[#FDB9331A] py-8 md:py-16">
        <div class="container">
            <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                <div class="col-span-12">
                    <div class="flex flex-col items-center w-full gap-4">
                        <span>infraestrutura completa</span>
                        <h2>
                            Características do Loteamento
                        </h2>
                        <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                    </div>
                </div>
                <div class="col-span-12 mt-10">
                    <div class="grid grid-cols-4 lg:grid-cols-12 gap-8">
                        <div class="infra-item flex flex-col items-center col-span-2 gap-3">
                            <div class="rounded-full aspect-square w-15 h-15 relative bg-(--verde) content-center justify-items-center">
                                <img src="<?= IMG_URI ?>door-white.svg" alt="icon" class="icon">
                            </div>
                            <p>Pórtico de Entrada</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="galeria">
        <div class="container">
            <div class="swiper galeria">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://placehold.co/1220x450?text=Swiper+1" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/1220x450?text=Swiper+2" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/1220x450?text=Swiper+3" alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://placehold.co/1220x450?text=Swiper+4" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="obra">
        <div class="container">
            <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                <div class="col-span-12">
                    <div class="flex flex-col items-center w-full gap-4">
                        <span>infraestrutura completa</span>
                        <h2>
                            Características do Loteamento
                        </h2>
                        <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6 mt-10">
                    <div class="swiper obras">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="https://placehold.co/720x416" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6 mt-10">
                    <div class="grid grid-cols-6 gap-8">
                        <div class="item-obra col-span-3">
                            <div class="flex items-baseline justify-between w-full">
                                <div class="icon flex flex-row gap-2">
                                    <img src="<?= IMG_URI ?>tree.svg" alt="tree-icon">
                                    <p>Praça</p>
                                </div>
                                <div class="porcentagem">89%</div>
                            </div>
                            <div class="barra">
                                <div class="barra-track">
                                    <div class="barra-fill" style="width: 89%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="loc">
        <div class="container">
            <div
                class="flex flex-row justify-between w-fit text-center items-stretch w-full bg-(--verde) lg:p-11 rounded-[10px]">
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
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et. Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                <a href="#" class="cta w-fit h-full lg:w-auto text-nowrap my-auto">
                    Google Maps
                </a>
                <a href="#" class="cta w-fit h-full lg:w-auto text-nowrap my-auto">
                    Waze
                </a>
            </div>
        </div>
    </section>
    <section class="mapa">
        <div class="container">
            <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                <div class="col-span-12">
                    <div class="flex flex-col items-center w-full gap-4">
                        <span>MAPA DO LOTEAMENTO</span>
                        <h2>
                            Veja as Estrutura do Bairro Planejado
                        </h2>
                        <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                    </div>
                </div>
                <div class="col-span-10 lg:col-span-12 mt-10 mx-auto">
                    <div class="swiper mapa">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="https://placehold.co/1280x500" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.swiper.galeria', {
            loop: true,
            // centeredSlides: true,
            initialSlide: 1,
            slidesPerView: 1.15,
            spaceBetween: 24,
            breakpoints: {
                1024: {
                    slidesPerView: 1.3,
                    spaceBetween: 30,
                },
            },
            pagination: {
                el: '.swiper-pagination',
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
        const swiperMapa = new Swiper('.swiper.mapa', {
            loop: true,
            slidesPerView: 1,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    })
</script>