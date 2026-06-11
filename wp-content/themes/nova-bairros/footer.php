<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */
?>

<footer class="mt-16 md:mt-28">
    <div class="container">
        <div class="flex flex-col md:grid md:grid-cols-12 gap-8 py-12">

            <!-- Logo + tagline + redes sociais -->
            <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-6">
                <a href="<?= home_url() ?>" aria-label="Home" class="navbar-brand w-fit">
                    <img src="<?= IMG_URI ?>logo.svg" alt="Logo">
                </a>
                <p class="!text-white">SOFISTICAÇÃO, TÉCNICA E IDENTIDADE EM CADA PROJETO</p>
                <div class="flex flex-row gap-3">
                    <a href="#" aria-label="Instagram" class="dif-item flex flex-row items-center gap-3">
                        <div class="rounded-full w-10 h-10 relative bg-white/20 content-center justify-items-center hover:bg-(--amarelo) transition-colors duration-300">
                            <img src="<?= IMG_URI ?>instagram.svg" alt="Instagram" class="w-5 h-5">
                        </div>
                    </a>
                    <a href="https://api.whatsapp.com/send/?phone=5531982247411" target="_blank" aria-label="WhatsApp" class="dif-item flex flex-row items-center gap-3">
                        <div class="rounded-full w-10 h-10 relative bg-white/20 content-center justify-items-center hover:bg-(--amarelo) transition-colors duration-300">
                            <svg class="w-5 h-5" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.73 26.66a1 1 0 001.22.26l5.76-1.5A12.45 12.45 0 0015.05 27.3C21.91 27.3 27.5 21.73 27.5 14.9A12.47 12.47 0 0015.05 2.5C8.2 2.5 2.61 8.06 2.61 14.89c0 2.17.57 4.31 1.66 6.19L2.73 26.66zm8.38-17.7c.23.006.48.018.72.55l1.35 3.18c.13.315.065.63-.1.84l-.35.42c-.11.13-.21.26-.3.35-.16.16-.33.33-.14.65.184.32.833 1.374 1.792 2.222A7.47 7.47 0 0016.08 17.9c.087.037.156.069.21.096.32.16.51.135.696-.08.186-.216.803-.936 1.02-1.255.217-.32.432-.27.73-.16.296.11 1.878.886 2.2 1.045l.178.087c.224.107.375.18.44.287.08.136.08.775-.185 1.527-.272.75-1.583 1.47-2.177 1.525l-.169.02c-.545.065-1.235.15-3.695-.818C10.3 19 8.3 16.04 7.9 15.44l-.066-.095C7.63 15.095 6.5 13.59 6.5 12.03c0-1.487.734-2.262 1.068-2.615l.059-.062a1.09 1.09 0 01.83-.385c.217 0 .434 0 .619.008l.034.003z" fill="white" />
                            </svg>
                        </div>
                    </a>
                    <a href="#" aria-label="Facebook" class="dif-item flex flex-row items-center gap-3">
                        <div class="rounded-full w-10 h-10 relative bg-white/20 content-center justify-items-center hover:bg-(--amarelo) transition-colors duration-300">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3V2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Links Rápidos -->
            <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-5">
                <h4 class="!text-white border-b border-white/20 pb-3">Links Rápidos</h4>
                <nav class="flex flex-col gap-3">
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>">Home</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/sobre">Sobre</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/empreendimentos">Empreendimentos</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/blog">Blog</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/contato">Contato</a>
                </nav>
            </div>

            <!-- Principais Contatos -->
            <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-5">
                <h4 class="!text-white border-b border-white/20 pb-3">Principais Contatos</h4>
                <div class="flex flex-col gap-4">
                    <a href="tel:+5500000000000" class="dif-item flex flex-row items-center gap-3">
                        <div class="rounded-full w-10 h-10 shrink-0 relative bg-white/20 content-center justify-items-center">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.77 11a19.79 19.79 0 01-3.07-8.67A2 2 0 012.68 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.55a16 16 0 006.06 6.06l.92-1.02a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="!text-white/80 !mb-0">(XX) XXXXX-XXXX</p>
                    </a>
                    <a href="#" class="dif-item flex flex-row items-center gap-3">
                        <div class="rounded-full w-10 h-10 shrink-0 relative bg-white/20 content-center justify-items-center">
                            <img src="<?= IMG_URI ?>pin.svg" alt="" class="w-5 h-5 brightness-0 invert">
                        </div>
                        <p class="!text-white/80 !mb-0">Rua Exemplo, 123 — Manaus, AM</p>
                    </a>
                    <a href="mailto:contato@novabairros.com.br" class="dif-item flex flex-row items-center gap-3">
                        <div class="rounded-full w-10 h-10 shrink-0 relative bg-white/20 content-center justify-items-center">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <polyline points="22,6 12,13 2,6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <p class="!text-white/80 !mb-0">contato@novabairros.com.br</p>
                    </a>
                </div>
            </div>

            <!-- Links Úteis -->
            <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-5">
                <h4 class="!text-white border-b border-white/20 pb-3">Links Úteis</h4>
                <div class="flex flex-col gap-3">
                    <a href="#" class="cta !text-sm">Política de Privacidade</a>
                    <a href="#" class="cta !text-sm">Termos de Uso</a>
                    <a href="#" class="cta !text-sm">FAQ</a>
                </div>
            </div>

        </div>

        <!-- Barra de copyright -->
        <div class="border-t border-white/20 flex justify-center items-center py-6">
            <div class="flex flex-col md:flex-row text-center text-sm items-center gap-5">
                <p class="!text-white/60">Copyright <?= date('Y'); ?> - Todos os direitos reservados.</p>
                <div class="hidden md:block w-[1px] h-4 bg-white/20 mx-3"></div>
                <a class="!text-white/60 font-medium !underline" href="#">Política de Privacidade</a>
                <div class="hidden md:block w-[1px] h-4 bg-white/20 mx-3"></div>
                <a class="!text-white/60" href="#">Desenvolvido por <span class="font-medium underline">AlfamaWeb em parceria com LZ MKT e Negócios</span></a>
            </div>
        </div>
    </div>
</footer>

<a aria-label="Falar com Corretor" href="https://api.whatsapp.com/send/?phone=5531982247411&text=Ol%C3%A1%2C+Kraft&type=phone_number&app_absent=0" target="_blank" class="fixed bottom-6 md:bottom-12 lg:bottom-32 right-4 lg:right-11 w-fit h-fit z-50">
    <div class="relative w-16 h-16 rounded-full bg-(--amarelo) shadow-[0_4px_4px_0_#00000040]">
        <svg class="absolute top-1/2 left-1/2 -translate-1/2" width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M28.5752 7.36502C27.1998 5.97618 25.5617 4.87497 23.7565 4.12556C21.9512 3.37616 20.0148 2.99354 18.0602 3.00002C9.87019 3.00002 3.1952 9.67502 3.1952 17.865C3.1952 20.49 3.8852 23.04 5.1752 25.29L3.0752 33L10.9502 30.93C13.1252 32.115 15.5702 32.745 18.0602 32.745C26.2502 32.745 32.9252 26.07 32.9252 17.88C32.9252 13.905 31.3802 10.17 28.5752 7.36502ZM18.0602 30.225C15.8402 30.225 13.6652 29.625 11.7602 28.5L11.3102 28.23L6.6302 29.46L7.8752 24.9L7.5752 24.435C6.34152 22.4656 5.68658 20.1889 5.6852 17.865C5.6852 11.055 11.2352 5.50502 18.0452 5.50502C21.3452 5.50502 24.4502 6.79502 26.7752 9.13502C27.9266 10.2808 28.8391 11.6438 29.4596 13.145C30.0802 14.6462 30.3965 16.2556 30.3902 17.88C30.4202 24.69 24.8702 30.225 18.0602 30.225ZM24.8402 20.985C24.4652 20.805 22.6352 19.905 22.3052 19.77C21.9602 19.65 21.7202 19.59 21.4652 19.95C21.2102 20.325 20.5052 21.165 20.2952 21.405C20.0852 21.66 19.8602 21.69 19.4852 21.495C19.1102 21.315 17.9102 20.91 16.5002 19.65C15.3902 18.66 14.6552 17.445 14.4302 17.07C14.2202 16.695 14.4002 16.5 14.5952 16.305C14.7602 16.14 14.9702 15.87 15.1502 15.66C15.3302 15.45 15.4052 15.285 15.5252 15.045C15.6452 14.79 15.5852 14.58 15.4952 14.4C15.4052 14.22 14.6552 12.39 14.3552 11.64C14.0552 10.92 13.7402 11.01 13.5152 10.995H12.7952C12.5402 10.995 12.1502 11.085 11.8052 11.46C11.4752 11.835 10.5152 12.735 10.5152 14.565C10.5152 16.395 11.8502 18.165 12.0302 18.405C12.2102 18.66 14.6552 22.41 18.3752 24.015C19.2602 24.405 19.9502 24.63 20.4902 24.795C21.3752 25.08 22.1852 25.035 22.8302 24.945C23.5502 24.84 25.0352 24.045 25.3352 23.175C25.6502 22.305 25.6502 21.57 25.5452 21.405C25.4402 21.24 25.2152 21.165 24.8402 20.985Z" fill="#252525" />
        </svg>
    </div>
</a>

<!-- Footer Links Libraries -->

<!--  Fancybox -->
<!-- https://fancyapps.com/ -->
<!-- ATIVAR CSS NO HEADER! -->
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/fancybox.umd.js'>
</script>

<!--  Swiper Slide  -->
<!-- https://swiperjs.com/ -->
<!-- ATIVAR CSS NO HEADER! -->
<!-- <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/libs/swiper/swiper-bundle.min.js'></script> -->
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

<!--  WOW  -->
<!-- https://wowjs.uk/ -->
<!-- <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/libs/wow/wow.min.js'></script> -->

<!-- Bootstrap -->
<!-- <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/libs/bootstrap/bootstrap.min.js'></script> -->

<!-- Main JS -->
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/js/app.js'></script>
<!-- <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/js/header-search.js'></script> -->

<!-- Footer Tags -->
<?php wp_footer(); ?>
</body>

<script>
    Fancybox.bind("[data-fancybox]", {
        groupAll: false,
        infinite: false,
        Toolbar: {
            display: ["zoom", "close"],
        },
    });
</script>

</html>