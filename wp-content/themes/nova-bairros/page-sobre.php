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
    if (!empty(get_field('sobre_nos'))):
        $sobre = get_field('sobre_nos');
    ?>
        <section class="sobre">
            <div class="container">
                <div class="flex md:grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex flex-col items-start w-fit gap-3">
                            <span class="text-(--verde)">há mais de 14 anos no mercado</span>
                            <h2><?= $sobre['titulo']; ?></h2>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                        </div>
                        <div class="content mt-8">
                            <?= nl2br($sobre['texto']); ?>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <img src="<?= $sobre['imagem']['url']; ?>" alt="<?= $sobre['imagem']['title']; ?>">
                    </div>
                </div>
            </div>
        </section>
    <?php
    endif;
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
    if (have_rows('mvv')):
    ?>
        <section class="mvv">
            <div class="container">
                <div class="flex md:grid grid-cols-12 gap-8">
                    <div class="col-span-12">
                        <div class="flex flex-col items-center w-full gap-3">
                            <span class="text-(--verde)">missão, visão e valores</span>
                            <h2><?= $sobre['titulo']; ?></h2>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                        </div>
                    </div>
                    <?php while (have_rows('mvv')): the_row(); ?>
                        <div class="col-span-12 lg:col-span-4">
                            <div class="flex flex-col items-center rounded-[10px] bg-(--verde) gap-3 p-8">
                                <img src="<?= get_sub_field('icone')['url']; ?>" alt="">
                                <h3 class="!text-white text-center"><?= get_sub_field('titulo'); ?></h3>
                                <p class="text-white text-center"><?= get_sub_field('texto'); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php
    endif;
    if (have_rows('cards')):
    ?>
        <section class="diferenciais cards overflow-hidden">
            <div class="container">
                <div class="flex flex-col items-center w-full gap-3">
                    <span class="text-(--verde)">diferenciais</span>
                    <h2><?= get_field('titulo_diferenciais'); ?></h2>
                    <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                </div>
                <div class="swiper cards-diferenciais !overflow-visible mt-10">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('cards')): the_row(); ?>
                            <div class="swiper-slide">
                                <div class="flex flex-col items-center rounded-[10px] bg-(--verde) gap-3 p-8">
                                    <img src="<?= get_sub_field('icone')['url']; ?>" alt="">
                                    <h3 class="!text-white text-center"><?= get_sub_field('titulo'); ?></h3>
                                    <p class="text-white text-center"><?= get_sub_field('texto'); ?></p>
                                </div>
                            </div>

                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    endif;
    if (have_rows('blocos')):
    ?>
        <section class="socios">
            <div class="container">
                <?php
                $i = 0;
                while (have_rows('blocos')): the_row();
                ?>
                    <div class="flex lg:grid grid-cols-12 gap-8 mb-8">
                        <div class="bloco-texto col-span-12 lg:col-span-6 <?= $i % 2 !== 0 ? 'lg:order-last' : ''; ?>">
                            <div class="flex flex-col items-start w-fit gap-3">
                                <?php if ($i === 0) : ?>
                                    <span class="text-(--verde)"><?= get_field('titulo_socios') ?></span>
                                <?php endif; ?>
                                <h2><?= get_sub_field('titulo'); ?></h2>
                                <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                            </div>
                            <div class="content mt-8">
                                <?= nl2br(get_sub_field('texto')); ?>
                            </div>
                        </div>
                        <div class="bloco-img col-span-12 lg:col-span-6 <?= $i % 2 !== 0 ? 'lg:order-first' : ''; ?>">
                            <img class="w-full h-full object-cover" src="<?= get_sub_field('imagem')['url']; ?>" alt="<?= get_sub_field('imagem')['title']; ?>">
                        </div>
                    </div>
                <?php $i++;
                endwhile; ?>
            </div>
        </section>
    <?php
    endif;
    if (!empty(get_field('bloco_socios'))):
        $socios = get_field('bloco_socios');
    ?>
        <section class="socios bg-[#FDB9331A] py-6 md:py-8">
            <div class="container">
                <div class="flex flex-col items-center w-full gap-3">
                    <span class="text-(--verde)">ÁREA DO INVESTIDOR</span>
                    <h2><?= $socios['titulo']; ?></h2>
                    <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                </div>
                <div class="flex flex-col lg:grid grid-cols-12 gap-8 mt-10">
                    <div class="content col-span-12 lg:col-span-10 lg:col-start-2 mx-auto">
                        <p class="text-center"><?= nl2br($socios['texto']) ?></p>
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row gap-8 w-full items-center justify-center mt-8">
                    <?php if ($socios['portfolio']): ?>
                        <a href="<?= $socios['portfolio']; ?>" class="cta">Baixar Portfólio</a>
                    <?php endif;
                    if ($socios['e-mail']):  ?>
                        <a href="mailto:<?= $socios['e-mail']; ?>" class="cta">Enviar e-mail para o setor responsável</a>
                </div>
            <?php endif; ?>
            </div>
        </section>
    <?php endif;
    if (!empty(get_field('negocios'))):
    $negocios = get_field('negocios'); ?>
        <section class="negocios">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-6">
                        <div class="flex flex-col items-start w-fit gap-3">
                            <span class="text-(--verde)">novos negócios</span>
                            <h2><?= $negocios['titulo']; ?></h2>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px]"></div>
                        </div>
                        <div class="content mt-8">
                            <?= nl2br($negocios['texto']); ?>
                        </div>
                        <a href="#" class="cta mt-6">Fale conosco pelo Whatsapp</a>
                    </div>
                    <div class="col-span-6">
                        <div class="form-container border border-(--verde) rounded-[10px] px-8 py-6">
                            <h3 class="text-(--verde) mb-4">Entre em contato</h3>
                            <p>Para mais informações sobre novas oportunidades </p>
                            <form action="" method="POST" class="flex flex-col gap-5 mt-8">
                                <div class="form-group flex flex-col">
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" name="nome" placeholder="Nome" required>
                                </div>
                                <div class="flex lg:flex-row flex-col gap-6">
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="telefone">Telefone</label>
                                        <input type="tel" name="telefone" placeholder="Telefone" required>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="mensagem">Mensagem</label>
                                        <input type="email" name="email" placeholder="E-mail" required></input>
                                    </div>
                                </div>
                                <div class="flex lg:flex-row flex-col gap-6">
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="telefone">Telefone</label>
                                        <select type="tel" name="telefone" placeholder="Telefone" required>
                                            <option value="">Selecione</option>
                                            <option value="whatsapp">WhatsApp</option>
                                            <option value="telefone">Telefone Fixo</option>
                                        </select>
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
                                </div>
                                <a id="anexo-trigger" class="flex flex-row justify-between items-center cursor-pointer" href="#" onclick="document.getElementById('anexo-input').click(); return false;">
                                    <p id="anexo-label">Anexos e Documentação  (Word / PDF / JPEG / PNG )</p>
                                    <img src="<?= IMG_URI ?>anexo.svg" alt="anexo" loading="lazy">
                                </a>
                                <input type="file" id="anexo-input" name="anexo" class="hidden" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png">
                                <button type="submit" class="cta self-start">Enviar</button>
                            </form>
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
        const anexoInput = document.getElementById('anexo-input');
        const anexoLabel = document.getElementById('anexo-label');
        if (anexoInput && anexoLabel) {
            anexoInput.addEventListener('change', function() {
                anexoLabel.textContent = this.files.length ? this.files[0].name : 'Anexos e Documentação (Word / PDF / JPEG / PNG )';
            });
        }

        const swiper = new Swiper('.cards-diferenciais', {
            // centeredSlides: true,
            loop: true,
            initialSlide: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    spaceBetween: 33,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 33,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 33,
                },
            },
        });
    });
</script>