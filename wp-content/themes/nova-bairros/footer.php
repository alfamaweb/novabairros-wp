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

<footer class="mt-16 md:mt-28 <?= is_page('contato') ? 'bg-[#F8F8F8] pt-6' : '' ?>">
    <div class="container">
        <div
            class="grid grid-cols-12 items-center justify-center content-center <?= is_page('contato') ? 'hidden' : '' ?>">
            <div class="inner-content col-span-12 lg:col-span-10 col-start-1 lg:col-start-2 mb-12">
                <div class="flex flex-col items-center justify-center gap-6">
                    <a href="<?= home_url() ?>" aria-label="Home Kraft" class="navbar-brand">
                        <img src="<?= IMG_URI ?>logo.svg" alt="">
                    </a>
                    <h3 class="text-center !font-normal">SOFISTICAÇÃO, TÉCNICA E IDENTIDADE EM CADA PROJETO</h3>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center pb-6">
            <div class="flex flex-col md:flex-row text-center text-sm items-center gap-5">
                <p class="text-end xl:text-start">Copyright <?= date('Y'); ?> - Todos os direitos reservados.</p>
                <div class="hidden md:block w-[1px] h-4 bg-[#D9D9D9] mx-3"></div>
                <a class="font-medium !underline text-center" href="">Política de Privacidade</a>
                <div class="hidden md:block w-[1px] h-4 bg-[#D9D9D9] mx-3"></div>
                <a class="text-center md:text-start" href="">Desenvolvido por <span
                        class="font-medium underline">AlfamaWeb em parceria com LZ MKT e Negócios</span></a>
            </div>
        </div>
    </div>
</footer>

<a aria-label="Falar com Corretor" href="https://api.whatsapp.com/send/?phone=5531982247411&text=Ol%C3%A1%2C+Kraft&type=phone_number&app_absent=0" target="_blank" class="fixed <?= is_single() && 'empreendimento' == get_post_type() ? 'bottom-24 lg:bottom-6' : 'bottom-6' ?> right-4 lg:right-11 w-fit h-fit z-50">
    <div class="relative w-16 h-16 rounded-full bg-[#484848] shadow-[0_4px_4px_0_#00000040]">
        <svg class="absolute top-1/2 left-1/2 -translate-1/2" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask0_2039_476" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="2" width="26" height="26">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.72998 26.6637C2.70643 26.7485 2.70564 26.8379 2.72771 26.9231C2.74977 27.0082 2.7939 27.086 2.85565 27.1487C2.9174 27.2113 2.99457 27.2565 3.07939 27.2798C3.16421 27.3031 3.25366 27.3036 3.33873 27.2812L9.09748 25.7762C10.9246 26.7659 12.9696 27.2844 15.0475 27.285H15.0525C21.91 27.285 27.5 21.7275 27.5 14.895C27.5042 13.2657 27.1843 11.6518 26.559 10.1473C25.9337 8.64272 25.0153 7.27757 23.8575 6.13125C22.7016 4.97551 21.3286 4.05972 19.8175 3.43653C18.3064 2.81334 16.687 2.49506 15.0525 2.5C8.19498 2.5 2.60498 8.0575 2.60498 14.8887C2.60498 17.0625 3.17748 19.1975 4.26748 21.0812L2.72998 26.6637ZM11.1075 8.9625C11.3362 8.96875 11.59 8.98125 11.8312 9.51625C11.9912 9.8725 12.26 10.5287 12.48 11.0637C12.6512 11.48 12.7912 11.8225 12.8262 11.8925C12.9075 12.0525 12.9562 12.2362 12.8512 12.4525L12.8162 12.525C12.7312 12.7 12.6712 12.825 12.5287 12.9875L12.35 13.2C12.2437 13.33 12.1375 13.4575 12.0475 13.5475C11.8862 13.7075 11.72 13.88 11.905 14.2C12.09 14.52 12.74 15.5725 13.6987 16.4212C14.4 17.0537 15.2046 17.5611 16.0775 17.9212C16.165 17.9587 16.2358 17.9904 16.29 18.0162C16.6112 18.1762 16.8025 18.1512 16.9875 17.9362C17.1737 17.72 17.7912 17 18.0087 16.68C18.2187 16.36 18.4337 16.41 18.7312 16.52C19.0287 16.6312 20.6112 17.4075 20.9325 17.5662L21.1112 17.6537C21.335 17.76 21.4862 17.8337 21.5512 17.9412C21.6312 18.0775 21.6312 18.7162 21.3662 19.4687C21.0937 20.2187 19.7825 20.9387 19.1887 20.9937L19.02 21.0137C18.475 21.0787 17.785 21.1637 15.325 20.195C12.2925 19.0025 10.2912 16.045 9.88748 15.4462L9.82123 15.3512L9.81498 15.3412C9.62998 15.095 8.50373 13.5887 8.50373 12.0337C8.50373 10.5462 9.23748 9.77125 9.57123 9.41875L9.62998 9.35625C9.73801 9.23421 9.87 9.13572 10.0177 9.0669C10.1655 8.99809 10.3258 8.96042 10.4887 8.95625C10.705 8.95625 10.9225 8.95625 11.1075 8.9625Z" fill="white" />
            </mask>
            <g mask="url(#mask0_2039_476)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.72998 26.6637C2.70643 26.7485 2.70564 26.8379 2.72771 26.9231C2.74977 27.0082 2.7939 27.086 2.85565 27.1487C2.9174 27.2113 2.99457 27.2565 3.07939 27.2798C3.16421 27.3031 3.25366 27.3036 3.33873 27.2812L9.09748 25.7762C10.9246 26.7659 12.9696 27.2844 15.0475 27.285H15.0525C21.91 27.285 27.5 21.7275 27.5 14.895C27.5042 13.2657 27.1843 11.6518 26.559 10.1473C25.9337 8.64272 25.0153 7.27757 23.8575 6.13125C22.7016 4.97551 21.3286 4.05972 19.8175 3.43653C18.3064 2.81334 16.687 2.49506 15.0525 2.5C8.19498 2.5 2.60498 8.0575 2.60498 14.8887C2.60498 17.0625 3.17748 19.1975 4.26748 21.0812L2.72998 26.6637ZM11.1075 8.9625C11.3362 8.96875 11.59 8.98125 11.8312 9.51625C11.9912 9.8725 12.26 10.5287 12.48 11.0637C12.6512 11.48 12.7912 11.8225 12.8262 11.8925C12.9075 12.0525 12.9562 12.2362 12.8512 12.4525L12.8162 12.525C12.7312 12.7 12.6712 12.825 12.5287 12.9875L12.35 13.2C12.2437 13.33 12.1375 13.4575 12.0475 13.5475C11.8862 13.7075 11.72 13.88 11.905 14.2C12.09 14.52 12.74 15.5725 13.6987 16.4212C14.4 17.0537 15.2046 17.5611 16.0775 17.9212C16.165 17.9587 16.2358 17.9904 16.29 18.0162C16.6112 18.1762 16.8025 18.1512 16.9875 17.9362C17.1737 17.72 17.7912 17 18.0087 16.68C18.2187 16.36 18.4337 16.41 18.7312 16.52C19.0287 16.6312 20.6112 17.4075 20.9325 17.5662L21.1112 17.6537C21.335 17.76 21.4862 17.8337 21.5512 17.9412C21.6312 18.0775 21.6312 18.7162 21.3662 19.4687C21.0937 20.2187 19.7825 20.9387 19.1887 20.9937L19.02 21.0137C18.475 21.0787 17.785 21.1637 15.325 20.195C12.2925 19.0025 10.2912 16.045 9.88748 15.4462L9.82123 15.3512L9.81498 15.3412C9.62998 15.095 8.50373 13.5887 8.50373 12.0337C8.50373 10.5462 9.23748 9.77125 9.57123 9.41875L9.62998 9.35625C9.73801 9.23421 9.87 9.13572 10.0177 9.0669C10.1655 8.99809 10.3258 8.96042 10.4887 8.95625C10.705 8.95625 10.9225 8.95625 11.1075 8.9625Z" fill="white" stroke="white" stroke-width="2.33333" stroke-linejoin="round" />
            </g>
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