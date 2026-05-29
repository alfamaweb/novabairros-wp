<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */

get_header(); ?>

<main class="h-svh overflow-hidden">
    <section class="hero h-full relative !mt-0">
        <div class="menu w-full h-fit absolute top-0 right-0">
            <div class="container mx-auto">
                <nav class="flex flex-row items-center justify-end-safe gap-8 mt-10">
                    <a class="!text-white hidden lg:block" href="/quem-somos">QUEM SOMOS</a>
                    <a class="!text-white hidden lg:block" href="/portfolio">PORTÓLIO</a>
                    <a class="!text-white hidden lg:block" href="/contato">CONTATO</a>
                    <a class="" href=""><img src="<?= IMG_URI ?>instagram.svg" alt="Instagram"></a>
                    <a class="block lg:hidden js-menu-toggle" href="#" aria-label="Abrir menu"><img src="<?= IMG_URI ?>menu-white.svg" alt="Menu"></a>
                </nav>
            </div>
        </div>
        <video class="w-full h-full object-cover" autoplay muted loop>
            <source
            src="<?= IMG_URI ?>VIDEO_HOME.mp4"
            type="video/mp4"/>
        </video>
    </section>
</main>

<?php get_footer(); ?>