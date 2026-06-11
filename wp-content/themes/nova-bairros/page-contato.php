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

    <?php include 'hero-interna.php'; ?>

    <?php
    $contatos = get_field('contatos');
    if (!empty($contatos) && !empty($contatos['unidades'])):
    ?>
        <section class="contatos">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-12">
                        <div class="flex flex-col justify-center gap-3 w-fit mx-auto text-center items-center mb-10">
                            <?php if (!empty($contatos['label'])): ?>
                                <span><?= esc_html($contatos['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($contatos['titulo'])): ?>
                                <h2><?= esc_html($contatos['titulo']); ?></h2>
                            <?php endif; ?>
                            <div class="border-b border-(--amarelo) border-[3px] w-full"></div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <div class="swiper contatos py-8!">
                            <div class="swiper-wrapper">
                                <?php foreach ($contatos['unidades'] as $unidade):
                                    if (empty($unidade['cidade']) && empty($unidade['telefone'])) continue;
                                ?>
                                    <div class="swiper-slide">
                                        <div class="card relative flex flex-col items-center gap-4 pt-8 pb-4">
                                            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full aspect-square w-10 h-10 bg-(--amarelo) content-center justify-items-center">
                                                <img class="w-5! h-5!" src="<?= IMG_URI ?>location.svg" alt="">
                                            </div>
                                            <div class="text-center">
                                                <?php if (!empty($unidade['cidade'])): ?>
                                                    <span><?= esc_html($unidade['cidade']); ?></span>
                                                <?php endif; ?>
                                                <?php if (!empty($unidade['telefone'])): ?>
                                                    <p><?= esc_html($unidade['telefone']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (!empty($unidade['endereco'])): ?>
                                                <div class="text-center">
                                                    <span>Localização</span>
                                                    <p><?= esc_html($unidade['endereco']); ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($unidade['link_maps'])): ?>
                                                <a href="<?= esc_url($unidade['link_maps']); ?>" target="_blank" rel="noopener noreferrer" class="cta w-fit">Ver localização</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $fale_conosco = get_field('fale_conosco');
    if (!empty($fale_conosco) && (!empty($fale_conosco['titulo']) || !empty($fale_conosco['texto']))):
    ?>
        <section class="fale-conosco">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-6">
                        <div class="flex flex-col justify-start gap-3 w-fit items-start">
                            <?php if (!empty($fale_conosco['label'])): ?>
                                <span><?= esc_html($fale_conosco['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($fale_conosco['titulo'])): ?>
                                <h2><?= esc_html($fale_conosco['titulo']); ?></h2>
                            <?php endif; ?>
                            <div class="border-b border-(--amarelo) border-[3px] max-w-75 w-full"></div>
                            <?php if (!empty($fale_conosco['texto'])): ?>
                                <p><?= esc_html($fale_conosco['texto']); ?></p>
                            <?php endif; ?>
                            <div class="form-container border border-(--verde) rounded-[10px] bg-white w-full px-8 py-6 mt-3">
                                <h3 class="text-(--verde) mb-4">Envie sua Mensagem</h3>
                                <p>Entre em contato com a nossa equipe.</p>
                                <form action="" method="POST" class="flex flex-col gap-5 mt-8">
                                    <div class="form-group flex flex-col">
                                        <label for="nome">Nome Completo</label>
                                        <input type="text" name="nome" placeholder="Nome" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="email">E-mail</label>
                                        <input type="email" name="email" placeholder="contato@gmail.com" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="mensagem">Digite aqui</label>
                                        <input type="text" name="mensagem" placeholder="Sua mensagem" required>
                                    </div>
                                    <button type="submit" class="cta self-start">Enviar formulário</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($fale_conosco['imagem'])): ?>
                        <div class="col-span-6">
                            <img class="w-full h-full object-cover rounded-[10px]"
                                src="<?= esc_url($fale_conosco['imagem']['url']); ?>"
                                alt="<?= esc_attr($fale_conosco['imagem']['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (document.querySelector('.swiper.contatos')) {
            new Swiper('.swiper.contatos', {
                direction: 'horizontal',
                loop: true,
                spaceBetween: 30,
                breakpoints: {
                    0: { slidesPerView: 1.2 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 },
                    1400: { slidesPerView: 6 }
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
    });
</script>
