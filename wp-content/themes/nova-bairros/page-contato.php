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
                                <span class="wow fadeIn"><?= esc_html($contatos['label']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($contatos['titulo'])): ?>
                                <h2 class="wow fadeIn" data-wow-delay=".2s"><?= esc_html($contatos['titulo']); ?></h2>
                            <?php endif; ?>
                            <div data-wow-delay="0.4s" class="wow fadeInUp border-b border-(--amarelo) border-[3px] w-full"></div>
                        </div>
                    </div>
                    <div class="col-span-12 contatos-swiper-wrap">
                        <div class="swiper contatos py-8!">
                            <div class="swiper-wrapper !items-stretch">
                                <?php foreach ($contatos['unidades'] as $unidade):
                                    if (empty($unidade['cidade']) && empty($unidade['telefone'])) continue;
                                ?>
                                    <div class="swiper-slide !h-auto">
                                        <div class="card relative flex flex-col items-center h-full gap-4 pt-8 pb-4">
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
                            <!-- <div class="swiper-pagination contato-pagination"></div> -->
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
                <div class="flex justify-center mt-4">
                    <div class='swiper-pagination contato-pagination'></div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $sede = get_field('sede');
    if (!empty($sede) && (!empty($sede['titulo']) || !empty($sede['subtitulo']))):
    ?>
        <section class="sede bg-[#FDB9331A] py-10">
            <div class="container">
                <div class="flex flex-col justify-start gap-3 w-fit items-center w-full">
                    <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                        <div class="col-span-12">
                            <div class="flex flex-col justify-center gap-3 w-fit mx-auto text-center items-center mb-10">
                                <?php if (!empty($sede['subtitulo'])): ?>
                                    <span class="wow fadeIn"><?= esc_html($sede['subtitulo']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($sede['titulo'])): ?>
                                    <h2 class="wow fadeIn" data-wow-delay=".2s"><?= esc_html($sede['titulo']); ?></h2>
                                <?php endif; ?>
                                <div data-wow-delay="0.4s" class="wow fadeInUp border-b border-(--amarelo) border-[3px] w-full"></div>
                            </div>
                        </div>
                        <?php if (!empty($sede['telefones'])): ?>
                            <div class="col-span lg:col-span-4 mb-10">
                                <div class="bloco-sede">
                                    <div class="sede-content-container">
                                        <div class="sede-title-container">
                                            <div class="sede-icon">
                                                <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.12218 3.10103C6.97423 2.69825 6.67777 2.36734 6.2936 2.17619C5.90944 1.98504 5.46669 1.94812 5.05618 2.07303C3.11018 2.67303 1.75018 4.34303 2.04218 6.27503C2.37077 8.4188 3.09725 10.4822 4.18418 12.359C5.26109 14.2308 6.67328 15.8884 8.35018 17.249C9.85818 18.469 11.9742 18.133 13.4662 16.733C13.78 16.4385 13.9704 16.0358 13.999 15.6064C14.0276 15.1769 13.8922 14.7526 13.6202 14.419L12.5522 13.113C12.3383 12.8504 12.0504 12.6581 11.7258 12.5611C11.4013 12.4641 11.0551 12.4669 10.7322 12.569L8.26818 13.349L7.83818 12.905C7.29661 12.3429 6.82272 11.7193 6.42618 11.047C6.04214 10.3667 5.74259 9.64198 5.53418 8.88903L5.36818 8.29903L7.26818 6.54903C7.51957 6.31669 7.69592 6.01464 7.77466 5.6815C7.8534 5.34837 7.83095 4.99932 7.71018 4.67903L7.12218 3.10103ZM4.46818 0.161027C5.36648 -0.113818 6.33589 -0.0347148 7.17775 0.382127C8.01962 0.798969 8.6702 1.52199 8.99618 2.40303L9.58218 3.97903C9.84149 4.67131 9.88867 5.42515 9.71769 6.14436C9.5467 6.86357 9.16531 7.51552 8.62218 8.01703L7.64218 8.91903C7.76818 9.26703 7.93818 9.66503 8.15818 10.051C8.37818 10.431 8.63418 10.777 8.86818 11.059L10.1282 10.659C10.8326 10.4366 11.5876 10.4308 12.2954 10.6422C13.0031 10.8537 13.6312 11.2727 14.0982 11.845L15.1662 13.151C15.7597 13.8768 16.0556 14.8009 15.9939 15.7365C15.9323 16.6721 15.5178 17.5493 14.8342 18.191C12.8462 20.057 9.60018 20.831 7.09418 18.803C5.22667 17.2883 3.65381 15.443 2.45418 13.359C1.24137 11.2658 0.43077 8.96426 0.0641763 6.57303C-0.415824 3.38703 1.87018 0.961027 4.46818 0.163027" fill="#007141" />
                                                </svg>
                                            </div>
                                            <h3 class="sede-title">Telefones</h3>
                                        </div>
                                        <div class="sede-content">
                                            <p><?= esc_html($sede['telefones']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($sede['localizacao'])): ?>
                            <div class="col-span lg:col-span-4 mb-10">
                                <div class="bloco-sede">
                                    <div class="sede-content-container">
                                        <div class="sede-title-container">
                                            <div class="sede-icon">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 10C16 7.79 14.21 6 12 6C9.79 6 8 7.79 8 10C8 12.21 9.79 14 12 14C14.21 14 16 12.21 16 10ZM10 10C10 8.9 10.9 8 12 8C13.1 8 14 8.9 14 10C14 11.1 13.1 12 12 12C10.9 12 10 11.1 10 10Z" fill="#007141" />
                                                    <path d="M11.4201 21.81C11.5901 21.93 11.8001 22 12.0001 22C12.2001 22 12.4101 21.94 12.5801 21.81C12.8801 21.59 20.0301 16.44 20.0001 9.98999C20.0001 5.57999 16.4101 1.98999 12.0001 1.98999C7.59009 1.98999 4.00009 5.57999 4.00009 9.98999C3.97009 16.43 11.1201 21.59 11.4201 21.81ZM12.0001 3.99999C15.3101 3.99999 18.0001 6.68999 18.0001 9.99999C18.0201 14.44 13.6101 18.43 12.0001 19.74C10.3901 18.43 5.98009 14.45 6.00009 9.99999C6.00009 6.68999 8.69009 3.99999 12.0001 3.99999Z" fill="#007141" />
                                                </svg>
                                            </div>
                                            <h3 class="sede-title">Localização</h3>
                                        </div>
                                        <div class="sede-content">
                                            <p><?= esc_html($sede['localizacao']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($sede['emails'])): ?>
                            <div class="col-span lg:col-span-4 mb-10">
                                <div class="bloco-sede">
                                    <div class="sede-content-container">
                                        <div class="sede-title-container">
                                            <div class="sede-icon">

                                                <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 16C1.45 16 0.979333 15.8043 0.588 15.413C0.196667 15.0217 0.000666667 14.5507 0 14V2C0 1.45 0.196 0.979333 0.588 0.588C0.98 0.196666 1.45067 0.000666667 2 0H18C18.55 0 19.021 0.196 19.413 0.588C19.805 0.98 20.0007 1.45067 20 2V14C20 14.55 19.8043 15.021 19.413 15.413C19.0217 15.805 18.5507 16.0007 18 16H2ZM10 9L2 4V14H18V4L10 9ZM10 7L18 2H2L10 7ZM2 4V2V14V4Z" fill="#007141" />
                                                </svg>

                                            </div>
                                            <h3 class="sede-title">Emails</h3>
                                        </div>
                                        <div class="sede-content">
                                            <p><?= esc_html($sede['emails']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
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
                        <div class="flex flex-col justify-start gap-3 w-fit items-start w-full">
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
                                <form id="ajax-contact-form" action="" method="POST" class="flex flex-col gap-5 mt-8">
                                    <input type="hidden" name="form_type" value="contato">
                                    <?php wp_nonce_field('send_contact_form_nonce', 'nonce'); ?>
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
        const form = document.getElementById('ajax-contact-form');
        if (form) {
            function showFormPopupMessage(message, isSuccess) {
                const existingMsg = document.getElementById('form-popup-message');
                if (existingMsg) existingMsg.remove();
                
                const msgDiv = document.createElement('div');
                msgDiv.id = 'form-popup-message';
                
                msgDiv.style.position = 'fixed';
                msgDiv.style.bottom = '20px';
                msgDiv.style.right = '20px';
                msgDiv.style.zIndex = '9999';
                msgDiv.style.padding = '16px 24px';
                msgDiv.style.borderRadius = '8px';
                msgDiv.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
                msgDiv.style.fontWeight = '500';
                msgDiv.style.transition = 'all 0.5s ease-in-out';
                msgDiv.style.transform = 'translateY(40px)';
                msgDiv.style.opacity = '0';
                msgDiv.style.fontFamily = 'inherit';
                msgDiv.style.borderLeft = '4px solid';
                
                if (isSuccess) {
                    msgDiv.style.backgroundColor = '#dcfce7'; 
                    msgDiv.style.color = '#166534'; 
                    msgDiv.style.borderColor = '#22c55e'; 
                } else {
                    msgDiv.style.backgroundColor = '#fee2e2'; 
                    msgDiv.style.color = '#991b1b'; 
                    msgDiv.style.borderColor = '#ef4444'; 
                }
                
                msgDiv.innerText = message;
                document.body.appendChild(msgDiv);
                
                setTimeout(() => {
                    msgDiv.style.transform = 'translateY(0)';
                    msgDiv.style.opacity = '1';
                }, 10);
                
                setTimeout(() => {
                    msgDiv.style.transform = 'translateY(40px)';
                    msgDiv.style.opacity = '0';
                    setTimeout(() => msgDiv.remove(), 500);
                }, 5000);
            }

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const btn = form.querySelector('button[type="submit"]');
                const originalText = btn.innerText;
                btn.innerText = 'Enviando...';
                btn.disabled = true;
                btn.style.opacity = '0.7';
                
                const formData = new FormData(form);
                formData.append('action', 'send_contact_form');
                
                fetch('<?= admin_url('admin-ajax.php') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(res => {
                    showFormPopupMessage(res.data.message || 'Erro ao enviar.', res.success);
                    
                    if (res.success) {
                        form.reset();
                    }
                })
                .catch(err => {
                    showFormPopupMessage('Ocorreu um erro inesperado.', false);
                })
                .finally(() => {
                    btn.innerText = originalText;
                    btn.disabled = false;
                    btn.style.opacity = '1';
                });
            });
        }

        if (document.querySelector('.swiper.contatos')) {
            new Swiper('.swiper.contatos', {
                direction: 'horizontal',
                loop: true,
                spaceBetween: 30,
                breakpoints: {
                    0: {
                        slidesPerView: 1.2
                    },
                    768: {
                        slidesPerView: 2
                    },
                    1024: {
                        slidesPerView: 3
                    },
                    1400: {
                        slidesPerView: 3
                    }
                },
                pagination: {
                    el: '.contato-pagination',
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }
    });
</script>