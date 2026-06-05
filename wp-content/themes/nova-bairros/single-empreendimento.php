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
</main>

<?php get_footer(); ?>