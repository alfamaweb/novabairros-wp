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
        $mobile_img  = $hero['mobile'];
        $desktop_id  = $desktop_img['ID'] ?? null;
        $mobile_id   = $mobile_img['ID'] ?? null;
        $texto       = $hero['texto'] ?? '';
        $link_externo = $hero['link_externo'] ?? '';

        $href     = '';
        $target   = '_self';
        $fancybox = '';
        $play     = '';
        switch ($link_externo) {
            case 'externo':
                $href   = $hero['url'];
                $target = '_blank';
                break;
            case 'iframe':
                $href     = $hero['iframe'];
                $fancybox = 'data-fancybox="banner" data-type="iframe" data-width="80%" data-height="80%"';
                $play     = '
                    <div class="absolute w-fit top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-8 h-8 lg:w-24 lg:h-24 hover:opacity-70 transition-opacity duration-300 ease-in-out">
                        <img src="' . IMG_URI . 'play.svg" alt="" width="140" height="140" class="w-full h-full" loading="lazy" decoding="async">
                    </div>';
                break;
        }
    ?>
        <section class="hero relative !mt-0">
            <a href="<?= esc_url($href); ?>" target="<?= esc_attr($target); ?>" <?= $fancybox; ?> class="relative w-full h-full"
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
                                    href="<?= esc_url(home_url()); ?>/empreendimentos">empreendimentos</a>
                                <img src="<?= IMG_URI ?>arrow-left.svg" alt="Seta">
                                <p class="!text-white !uppercase font-bold"><?= get_the_title(); ?></p>
                            </div>
                            <h1 class="!text-white !text-start"><?= esc_html($hero['titulo'] ?? get_the_title()); ?></h1>
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
                                        <input type="email" name="email" placeholder="contato@gmail.com" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="mensagem">Mensagem</label>
                                        <select name="mensagem" required>
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

    <?php
    $resumo = get_field('resumo');
    if (!empty($resumo) && (!empty($resumo['titulo']) || !empty($resumo['texto']))):
    ?>
        <section class="resumo">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-7">
                        <div class="flex flex-col items-start gap-6">
                            <?php if (!empty($resumo['logo'])): ?>
                                <img src="<?= esc_url($resumo['logo']['url']); ?>"
                                    alt="<?= esc_attr($resumo['logo']['alt']); ?>">
                            <?php endif; ?>

                            <?php if (!empty($resumo['titulo'])): ?>
                                <h2><?= esc_html($resumo['titulo']); ?></h2>
                            <?php endif; ?>

                            <?php if (!empty($resumo['texto'])): ?>
                                <div class="content"><?= wp_kses_post($resumo['texto']); ?></div>
                            <?php endif; ?>

                            <?php if (!empty($resumo['itens_diferenciais'])): ?>
                                <div class="itens-diferenciais flex items-center justify-between gap-7 w-full">
                                    <?php foreach ($resumo['itens_diferenciais'] as $item):
                                        if (empty($item['icone']) && empty($item['label'])) continue;
                                    ?>
                                        <div class="dif-item flex flex-row items-center gap-3">
                                            <?php if (!empty($item['icone'])): ?>
                                                <div class="rounded-full aspect-square w-15 h-15 relative bg-(--amarelo) content-center justify-items-center">
                                                    <img src="<?= esc_url($item['icone']['url']); ?>"
                                                        alt="<?= esc_attr($item['icone']['alt']); ?>" class="icon">
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($item['label'])): ?>
                                                <p><?= esc_html($item['label']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!empty($resumo['imagem'])): ?>
                        <div class="col-span-5">
                            <img class="w-full h-full object-cover rounded-[10px]"
                                src="<?= esc_url($resumo['imagem']['url']); ?>"
                                alt="<?= esc_attr($resumo['imagem']['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $infraestrutura = get_field('infraestrutura');
    if (!empty($infraestrutura) && !empty($infraestrutura['itens'])):
    ?>
        <section class="infraestrutura bg-[#FDB9331A] py-8 md:py-16">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-12">
                        <div class="flex flex-col items-center w-full gap-4">
                            <?php if (!empty($infraestrutura['label'])): ?>
                                <span><?= esc_html($infraestrutura['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($infraestrutura['titulo'])): ?>
                                <h2><?= esc_html($infraestrutura['titulo']); ?></h2>
                            <?php endif; ?>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-75"></div>
                        </div>
                    </div>
                    <div class="col-span-12 mt-10">
                        <div class="grid grid-cols-4 lg:grid-cols-12 gap-8">
                            <?php foreach ($infraestrutura['itens'] as $item):
                                if (empty($item['icone']) && empty($item['label'])) continue;
                            ?>
                                <div class="infra-item flex flex-col items-center col-span-2 gap-3">
                                    <?php if (!empty($item['icone'])): ?>
                                        <div class="rounded-full aspect-square w-15 h-15 relative bg-(--verde) content-center justify-items-center">
                                            <img src="<?= esc_url($item['icone']['url']); ?>"
                                                alt="<?= esc_attr($item['icone']['alt']); ?>" class="icon">
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['label'])): ?>
                                        <p><?= esc_html($item['label']); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $galeria = get_field('galeria');
    if (!empty($galeria)):
    ?>
        <section class="galeria">
            <div class="container">
                <div class="swiper galeria">
                    <div class="swiper-wrapper">
                        <?php foreach ($galeria as $img): ?>
                            <div class="swiper-slide">
                                <img class="w-full object-cover !h-130" src="<?= esc_url($img['url']); ?>"
                                    alt="<?= esc_attr($img['alt']); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $obra = get_field('obra');
    if (!empty($obra) && (!empty($obra['fotos']) || !empty($obra['etapas']))):
    ?>
        <section class="obra">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-12">
                        <div class="flex flex-col items-center w-full gap-4">
                            <?php if (!empty($obra['label'])): ?>
                                <span><?= esc_html($obra['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($obra['titulo'])): ?>
                                <h2><?= esc_html($obra['titulo']); ?></h2>
                            <?php endif; ?>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-75"></div>
                        </div>
                    </div>

                    <?php if (!empty($obra['fotos'])): ?>
                        <div class="col-span-12 lg:col-span-6 mt-10">
                            <div class="swiper obras">
                                <div class="swiper-wrapper">
                                    <?php foreach ($obra['fotos'] as $foto): ?>
                                        <div class="swiper-slide">
                                            <img class="w-full object-cover h-100" src="<?= esc_url($foto['url']); ?>"
                                                alt="<?= esc_attr($foto['alt']); ?>">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($obra['etapas'])): ?>
                        <div class="col-span-12 <?= !empty($obra['fotos']) ? 'lg:col-span-6' : ''; ?> mt-10">
                            <div class="grid grid-cols-6 gap-8">
                                <?php foreach ($obra['etapas'] as $etapa):
                                    if (empty($etapa['label'])) continue;
                                    $pct = intval($etapa['porcentagem'] ?? 0);
                                ?>
                                    <div class="item-obra col-span-3">
                                        <div class="flex items-baseline justify-between w-full">
                                            <div class="icon flex flex-row gap-2">
                                                <?php if (!empty($etapa['icone'])): ?>
                                                    <img src="<?= esc_url($etapa['icone']['url']); ?>"
                                                        alt="<?= esc_attr($etapa['icone']['alt']); ?>">
                                                <?php endif; ?>
                                                <p><?= esc_html($etapa['label']); ?></p>
                                            </div>
                                            <div class="porcentagem"><?= $pct; ?>%</div>
                                        </div>
                                        <div class="barra">
                                            <div class="barra-track">
                                                <div class="barra-fill" style="width: <?= $pct; ?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $localizacao = get_field('localizacao');
    if (!empty($localizacao) && (!empty($localizacao['titulo']) || !empty($localizacao['google_maps']) || !empty($localizacao['waze']))):
    ?>
        <section class="loc">
            <div class="container">
                <div class="flex flex-row justify-between text-center items-stretch w-full bg-(--verde) lg:p-11 rounded-[10px]">
                    <div class="flex flex-col items-center justify-center">
                        <img src="<?= IMG_URI ?>app.svg" alt="App Store">
                    </div>
                    <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                    <div class="flex flex-col items-start text-white justify-center">
                        <span>CONFIRA AGORA</span>
                        <?php if (!empty($localizacao['titulo'])): ?>
                            <h2><?= esc_html($localizacao['titulo']); ?></h2>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($localizacao['texto'])): ?>
                        <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                        <div class="flex flex-col items-center justify-center max-w-120">
                            <p><?= esc_html($localizacao['texto']); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($localizacao['google_maps']) || !empty($localizacao['waze'])): ?>
                        <div class="border-r border-(--amarelo) border-[3px] h-auto"></div>
                        <?php if (!empty($localizacao['google_maps'])): ?>
                            <a href="<?= esc_url($localizacao['google_maps']); ?>" target="_blank" rel="noopener noreferrer"
                                class="cta w-fit h-full lg:w-auto text-nowrap my-auto">
                                Google Maps
                            </a>
                        <?php endif; ?>
                        <?php if (!empty($localizacao['waze'])): ?>
                            <a href="<?= esc_url($localizacao['waze']); ?>" target="_blank" rel="noopener noreferrer"
                                class="cta w-fit h-full lg:w-auto text-nowrap my-auto">
                                Waze
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $mapa = get_field('mapa');
    if (!empty($mapa) && !empty($mapa['imagens'])):
    ?>
        <section class="mapa">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-12">
                        <div class="flex flex-col items-center w-full gap-4">
                            <?php if (!empty($mapa['label'])): ?>
                                <span><?= esc_html($mapa['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($mapa['titulo'])): ?>
                                <h2><?= esc_html($mapa['titulo']); ?></h2>
                            <?php endif; ?>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-75"></div>
                        </div>
                    </div>
                    <div class="col-span-10 lg:col-span-12 mt-10">
                        <div class="swiper mapa">
                            <div class="swiper-wrapper">
                                <?php foreach ($mapa['imagens'] as $img): ?>
                                    <div class="swiper-slide">
                                        <img class="max-h-120 w-full object-cover rounded-[10px]" src="<?= esc_url($img['url']); ?>"
                                            alt="<?= esc_attr($img['alt']); ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.swiper.galeria')) {
            new Swiper('.swiper.galeria', {
                loop: true,
                centeredSlides: true,
                initialSlide: 1,
                slidesPerView: 1.15,
                spaceBetween: 24,
                breakpoints: {
                    1024: {
                        slidesPerView: 1,
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
        }

        if (document.querySelector('.swiper.obras')) {
            new Swiper('.swiper.obras', {
                loop: true,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }

        if (document.querySelector('.swiper.mapa')) {
            new Swiper('.swiper.mapa', {
                loop: true,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    });
</script>
