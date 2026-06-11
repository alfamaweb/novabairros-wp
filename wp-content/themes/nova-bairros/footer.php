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

$footer_opts    = get_field('footer', 'option') ?: [];
$redes          = get_field('redes_sociais', 'option') ?: [];
$contatos_footer = get_field('contatos', 'option') ?: [];
$links_rapidos  = get_field('links_rapidos', 'option') ?: [];
$links_uteis    = get_field('links_uteis', 'option') ?: [];

$tagline             = $footer_opts['tagline'] ?? '';
$whatsapp_flutuante  = $footer_opts['whatsapp_flutuante'] ?? '';
$politica_url        = $footer_opts['politica_privacidade'] ?? '';
$texto_rodape        = $footer_opts['texto_rodape'] ?? 'Todos os direitos reservados.';
$desenvolvido_por    = $footer_opts['desenvolvido_por'] ?? [];
?>

<footer class="mt-16 md:mt-28">
    <div class="container">
        <div class="flex flex-col md:grid md:grid-cols-12 gap-8 py-12">

            <!-- Logo + tagline + redes sociais -->
            <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-6">
                <a href="<?= home_url(); ?>" aria-label="Home" class="navbar-brand w-fit">
                    <img src="<?= IMG_URI ?>logo.svg" alt="Logo">
                </a>
                <?php if (!empty($tagline)): ?>
                    <p class="text-white!"><?= esc_html($tagline); ?></p>
                <?php endif; ?>
                <?php if (!empty($redes)): ?>
                    <div class="flex flex-row gap-3">
                        <?php foreach ($redes as $rede):
                            if (empty($rede['url']) && empty($rede['icone'])) continue;
                        ?>
                            <a href="<?= esc_url($rede['url'] ?? '#'); ?>"
                                target="_blank" rel="noopener noreferrer"
                                aria-label="<?= esc_attr($rede['aria_label'] ?? ''); ?>"
                                class="dif-item flex flex-row items-center gap-3">
                                <div class="rounded-full w-10 h-10 relative bg-white/20 content-center justify-items-center hover:bg-(--amarelo) transition-colors duration-300">
                                    <?php if (!empty($rede['icone'])): ?>
                                        <img src="<?= esc_url($rede['icone']['url']); ?>"
                                            alt="<?= esc_attr($rede['aria_label'] ?? ''); ?>"
                                            class="w-5 h-5">
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Links Rápidos -->
            <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-5">
                <h4 class="text-white! border-b border-white/20 pb-3">
                    <?= esc_html($links_rapidos['titulo'] ?? 'Links Rápidos'); ?>
                </h4>
                <nav class="flex flex-col gap-3">
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>">Home</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/sobre">Sobre</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/empreendimentos">Empreendimentos</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/blog">Blog</a>
                    <a class="!text-white/80 hover:!text-white transition-colors" href="<?= home_url(); ?>/contato">Contato</a>
                </nav>
            </div>

            <!-- Principais Contatos -->
            <?php if (!empty($contatos_footer)): ?>
                <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-5">
                    <h4 class="text-white! border-b border-white/20 pb-3">Principais Contatos</h4>
                    <div class="flex flex-col gap-4">
                        <?php foreach ($contatos_footer as $contato):
                            if (empty($contato['texto'])) continue;
                        ?>
                            <a href="<?= esc_attr($contato['url'] ?? '#'); ?>"
                                class="dif-item flex flex-row items-center gap-3">
                                <div class="rounded-full w-10 h-10 shrink-0 relative bg-white/20 content-center justify-items-center">
                                    <?php if (!empty($contato['icone'])): ?>
                                        <img src="<?= esc_url($contato['icone']['url']); ?>"
                                            alt="" class="w-5 h-5 brightness-0 invert">
                                    <?php endif; ?>
                                </div>
                                <p class="text-white/80! mb-0!"><?= esc_html($contato['texto']); ?></p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Links Úteis -->
            <?php if (!empty($links_uteis) && !empty($links_uteis['links'])): ?>
                <div class="col-span-12 md:col-span-6 lg:col-span-3 flex flex-col gap-5">
                    <h4 class="text-white! border-b border-white/20 pb-3">
                        <?= esc_html($links_uteis['titulo'] ?? 'Links Úteis'); ?>
                    </h4>
                    <div class="flex flex-col gap-3">
                        <?php foreach ($links_uteis['links'] as $link):
                            if (empty($link['texto'])) continue;
                        ?>
                            <a href="<?= esc_url($link['url'] ?? '#'); ?>" class="cta text-sm!">
                                <?= esc_html($link['texto']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

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

<?php if (!empty($whatsapp_flutuante)): ?>
    <a aria-label="Falar com Corretor"
        href="<?= esc_url($whatsapp_flutuante); ?>"
        target="_blank" rel="noopener noreferrer"
        class="fixed bottom-6 md:bottom-12 lg:bottom-32 right-4 lg:right-11 w-fit h-fit z-50">
        <div class="relative w-16 h-16 rounded-full bg-(--amarelo) shadow-[0_4px_4px_0_#00000040]">
            <svg class="absolute top-1/2 left-1/2 -translate-1/2" width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M28.5752 7.36502C27.1998 5.97618 25.5617 4.87497 23.7565 4.12556C21.9512 3.37616 20.0148 2.99354 18.0602 3.00002C9.87019 3.00002 3.1952 9.67502 3.1952 17.865C3.1952 20.49 3.8852 23.04 5.1752 25.29L3.0752 33L10.9502 30.93C13.1252 32.115 15.5702 32.745 18.0602 32.745C26.2502 32.745 32.9252 26.07 32.9252 17.88C32.9252 13.905 31.3802 10.17 28.5752 7.36502ZM18.0602 30.225C15.8402 30.225 13.6652 29.625 11.7602 28.5L11.3102 28.23L6.6302 29.46L7.8752 24.9L7.5752 24.435C6.34152 22.4656 5.68658 20.1889 5.6852 17.865C5.6852 11.055 11.2352 5.50502 18.0452 5.50502C21.3452 5.50502 24.4502 6.79502 26.7752 9.13502C27.9266 10.2808 28.8391 11.6438 29.4596 13.145C30.0802 14.6462 30.3965 16.2556 30.3902 17.88C30.4202 24.69 24.8702 30.225 18.0602 30.225ZM24.8402 20.985C24.4652 20.805 22.6352 19.905 22.3052 19.77C21.9602 19.65 21.7202 19.59 21.4652 19.95C21.2102 20.325 20.5052 21.165 20.2952 21.405C20.0852 21.66 19.8602 21.69 19.4852 21.495C19.1102 21.315 17.9102 20.91 16.5002 19.65C15.3902 18.66 14.6552 17.445 14.4302 17.07C14.2202 16.695 14.4002 16.5 14.5952 16.305C14.7602 16.14 14.9702 15.87 15.1502 15.66C15.3302 15.45 15.4052 15.285 15.5252 15.045C15.6452 14.79 15.5852 14.58 15.4952 14.4C15.4052 14.22 14.6552 12.39 14.3552 11.64C14.0552 10.92 13.7402 11.01 13.5152 10.995H12.7952C12.5402 10.995 12.1502 11.085 11.8052 11.46C11.4752 11.835 10.5152 12.735 10.5152 14.565C10.5152 16.395 11.8502 18.165 12.0302 18.405C12.2102 18.66 14.6552 22.41 18.3752 24.015C19.2602 24.405 19.9502 24.63 20.4902 24.795C21.3752 25.08 22.1852 25.035 22.8302 24.945C23.5502 24.84 25.0352 24.045 25.3352 23.175C25.6502 22.305 25.6502 21.57 25.5452 21.405C25.4402 21.24 25.2152 21.165 24.8402 20.985Z" fill="#252525" />
            </svg>
        </div>
    </a>
<?php endif; ?>

<!-- Footer Links Libraries -->

<!--  Fancybox -->
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/fancybox.umd.js'></script>

<!--  Swiper Slide  -->
<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

<!-- Main JS -->
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/js/app.js'></script>

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