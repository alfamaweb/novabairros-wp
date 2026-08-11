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
        <section class="sobre wow fadeInUp">
            <div class="container">
                <div class="flex flex-col md:grid grid-cols-12">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="flex flex-col items-start w-fit gap-3">
                            <span class="text-(--verde)"><?php echo get_field('titulo_sobre'); ?></span>
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
        <section class="diferenciais bg-[#FDB9331A] py-8 md:py-16 wow fadeInUp">
            <div class="container">
                <div class="flex flex-col md:grid md:grid-cols-12 items-center justify-center content-center gap-x-7 gap-y-8">
                    <?php
                    while (have_rows('itens')) : the_row();
                    ?>
                        <div class="w-full md:col-span-6 xl:col-span-3">
                            <div class="flex flex-col items-center gap-6">
                                <span class="w-full text-center !text-white py-2 bg-(--verde) rounded-[10px]"><?= get_sub_field('rotulo'); ?></span>
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
                <div class="flex flex-col md:grid grid-cols-12 gap-8">
                    <div class="col-span-12">
                        <div class="flex flex-col items-center w-full gap-3 text-center">
                            <span class="text-(--verde) wow fadeIn">missão, visão e valores</span>
                            <h2 class="wow fadeIn" data-wow-delay="0.2s"><?= $sobre['titulo']; ?></h2>
                            <div data-wow-delay="0.2s" class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px] wow fadeIn"></div>
                        </div>
                    </div>
                    <?php $i = 0;
                    while (have_rows('mvv')): the_row(); ?>
                        <div class="col-span-12 lg:col-span-4 wow fadeIn <?= $i == 0 ? 'fadeInLeft' : '' ?> <?= $i == 2 ? 'fadeInRight' : '' ?>">
                            <div class="flex flex-col items-center rounded-[10px] bg-(--verde) h-full gap-3 p-8">
                                <img src="<?= get_sub_field('icone')['url']; ?>" alt="">
                                <h3 class="!text-white text-center"><?= get_sub_field('titulo'); ?></h3>
                                <p class="text-white text-center"><?= get_sub_field('texto'); ?></p>
                            </div>
                        </div>
                    <?php $i++;
                    endwhile; ?>
                </div>
            </div>
        </section>
    <?php
    endif;
    if (have_rows('cards')):
    ?>
        <section class="diferenciais cards overflow-hidden">
            <div class="container">
                <div class="flex flex-col items-center w-full gap-3 text-center">
                    <span class="text-(--verde) wow fadeIn">diferenciais</span>
                    <h2 class="wow fadeIn" data-wow-delay="0.2s"><?= get_field('titulo_diferenciais'); ?></h2>
                    <div data-wow-delay="0.2s" class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px] wow fadeIn"></div>
                </div>
                <div class="relative swiper-container wow fadeInUp" data-wow-delay="0.3s">
                    <div class="swiper cards-diferenciais !overflow-visible mt-10 !pt-20">
                        <div class="swiper-wrapper">
                            <?php while (have_rows('cards')): the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="card relative pt-[80px]">
                                        <div class="holder absolute -top-[44px] inset-x-0">
                                            <div class="relative justify-items-center">
                                                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full aspect-square w-15 h-15 bg-(--amarelo) content-center justify-items-center">
                                                    <img src="<?= get_sub_field('icone')['url']; ?>" alt="">
                                                </div>
                                                <h3 class="!text-white text-center bg-(--verde) px-8 md:px-10 xl:px-14 pt-7 pb-3 rounded-[10px] w-fit"><?= get_sub_field('titulo'); ?></h3>
                                            </div>
                                        </div>
                                        <p class="text-center"><?= get_sub_field('texto'); ?></p>
                                    </div>
                                </div>

                            <?php endwhile; ?>
                        </div>
                        <div class="mt-12 relative">
                            <div class="dif-pagination swiper-pagination"></div>
                        </div>
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
                    <div class="flex flex-col lg:grid grid-cols-12 gap-8 mb-8 <?= $i % 2 !== 0 ? 'wow fadeInLeft' : 'wow fadeInRight'; ?>">
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
    if (!empty(get_field('bloco_socios')['titulo'])):
        $socios = get_field('bloco_socios');
    ?>
        <section class="socios bg-[#FDB9331A] py-6 md:py-8 wow fadeInUp">
            <div class="container">
                <div class="flex flex-col items-center w-full gap-3 text-center">
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
        <section class="negocios bg-[#00663B] py-8 md:py-16 wow fadeInUp">
            <div class="container">
                <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                    <div class="col-span-6">
                        <div class="flex flex-col items-start w-fit gap-3">
                            <span class="!text-white">novos negócios</span>
                            <h2 class="!text-white"><?= $negocios['titulo']; ?></h2>
                            <div class="border-b border-(--amarelo) border-[3px] w-full max-w-[300px] !text-white"></div>
                        </div>
                        <div class="content mt-8 !text-white">
                            <?= nl2br($negocios['texto']); ?>
                        </div>
                        <a href="<?php echo get_field('negocios')['whatsapp'] ?>" class="cta mt-6 d-inline-flex" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M28.5752 7.36502C27.1998 5.97618 25.5617 4.87497 23.7565 4.12556C21.9512 3.37616 20.0148 2.99354 18.0602 3.00002C9.87019 3.00002 3.1952 9.67502 3.1952 17.865C3.1952 20.49 3.8852 23.04 5.1752 25.29L3.0752 33L10.9502 30.93C13.1252 32.115 15.5702 32.745 18.0602 32.745C26.2502 32.745 32.9252 26.07 32.9252 17.88C32.9252 13.905 31.3802 10.17 28.5752 7.36502ZM18.0602 30.225C15.8402 30.225 13.6652 29.625 11.7602 28.5L11.3102 28.23L6.6302 29.46L7.8752 24.9L7.5752 24.435C6.34152 22.4656 5.68658 20.1889 5.6852 17.865C5.6852 11.055 11.2352 5.50502 18.0452 5.50502C21.3452 5.50502 24.4502 6.79502 26.7752 9.13502C27.9266 10.2808 28.8391 11.6438 29.4596 13.145C30.0802 14.6462 30.3965 16.2556 30.3902 17.88C30.4202 24.69 24.8702 30.225 18.0602 30.225ZM24.8402 20.985C24.4652 20.805 22.6352 19.905 22.3052 19.77C21.9602 19.65 21.7202 19.59 21.4652 19.95C21.2102 20.325 20.5052 21.165 20.2952 21.405C20.0852 21.66 19.8602 21.69 19.4852 21.495C19.1102 21.315 17.9102 20.91 16.5002 19.65C15.3902 18.66 14.6552 17.445 14.4302 17.07C14.2202 16.695 14.4002 16.5 14.5952 16.305C14.7602 16.14 14.9702 15.87 15.1502 15.66C15.3302 15.45 15.4052 15.285 15.5252 15.045C15.6452 14.79 15.5852 14.58 15.4952 14.4C15.4052 14.22 14.6552 12.39 14.3552 11.64C14.0552 10.92 13.7402 11.01 13.5152 10.995H12.7952C12.5402 10.995 12.1502 11.085 11.8052 11.46C11.4752 11.835 10.5152 12.735 10.5152 14.565C10.5152 16.395 11.8502 18.165 12.0302 18.405C12.2102 18.66 14.6552 22.41 18.3752 24.015C19.2602 24.405 19.9502 24.63 20.4902 24.795C21.3752 25.08 22.1852 25.035 22.8302 24.945C23.5502 24.84 25.0352 24.045 25.3352 23.175C25.6502 22.305 25.6502 21.57 25.5452 21.405C25.4402 21.24 25.2152 21.165 24.8402 20.985Z" fill="#252525"></path>
                            </svg>
                            Fale conosco pelo Whatsapp</a>
                    </div>
                    <div class="col-span-6">
                        <div class="form-container border border-(--verde) !bg-white rounded-[10px] px-8 py-6">
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
                                        <label for="email">Email</label>
                                        <input type="email" name="email" placeholder="E-mail" required>
                                    </div>
                                </div>
                                <div class="flex lg:flex-row flex-col gap-6">
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="estado">Estado</label>
                                        <select name="estado" placeholder="estado" required>
                                            <option value="">Estado</option>
                                            <option value="ACRE">ACRE</option>
                                            <option value="ALAGOAS">ALAGOAS</option>
                                            <option value="AMAPÁ">AMAPÁ</option>
                                            <option value="AMAZONAS">AMAZONAS</option>
                                            <option value="BAHIA">BAHIA</option>
                                            <option value="CEARÁ">CEARÁ</option>
                                            <option value="DISTRITO FEDERAL">DISTRITO FEDERAL</option>
                                            <option value="ESPÍRITO SANTO">ESPÍRITO SANTO</option>
                                            <option value="GOIÁS">GOIÁS</option>
                                            <option value="MARANHÃO">MARANHÃO</option>
                                            <option value="MATO GROSSO">MATO GROSSO</option>
                                            <option value="MATO GROSSO DO SUL">MATO GROSSO DO SUL</option>
                                            <option value="MINAS GERAIS">MINAS GERAIS</option>
                                            <option value="PARÁ">PARÁ</option>
                                            <option value="PARAÍBA">PARAÍBA</option>
                                            <option value="PARANÁ">PARANÁ</option>
                                            <option value="PERNAMBUCO">PERNAMBUCO</option>
                                            <option value="PIAUÍ">PIAUÍ</option>
                                            <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
                                            <option value="RIO GRANDE DO NORTE">RIO GRANDE DO NORTE</option>
                                            <option value="RIO GRANDE DO SUL">RIO GRANDE DO SUL</option>
                                            <option value="RONDÔNIA">RONDÔNIA</option>
                                            <option value="RORAIR">RORAIR</option>
                                            <option value="SANTA CATARINA">SANTA CATARINA</option>
                                            <option value="SÃO PAULO">SÃO PAULO</option>
                                            <option value="SERGIPE">SERGIPE</option>
                                            <option value="TOCANTINS">TOCANTINS</option>
                                        </select>
                                    </div>
                                    <div class="form-group flex flex-col flex-1">
                                        <label for="cidade">Cidade</label>
                                        <input type="text" name="cidade" placeholder="Cidade" required>
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

<style>
    footer {
        margin-top: 0;
    }

    @media (max-width: 992px) {
        section.hero.interna {
            height: 350px;
        }
    }
</style>

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
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.dif-pagination'
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