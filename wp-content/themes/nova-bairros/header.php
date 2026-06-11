<?php

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <!-- Head Tags -->
    <!-- Meta Data -->
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Viewport  -->
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <!-- Favicon -->
    <!-- INSERIR AQUI CONFORME CHECKLIST -->

    <meta name="theme-color" content="#ffffff">

    <!-- Meta -->
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">

    <!-- Wordpress Shit -->
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>

    <!-- jQuery -->
    <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/assets/libs/jquery/jquery-1.11.1.min.js'></script>

    <!-- Bootstrap -->
    <!-- <link rel='stylesheet' type='text/css' href='<?php echo get_template_directory_uri(); ?>/assets/libs/bootstrap/bootstrap.min.css'> -->

    <!-- Fancybox -->
    <link rel='stylesheet' type='text/css' href='<?php echo get_template_directory_uri(); ?>/assets/libs/fancybox/fancybox.css'>

    <!-- Swiper -->
    <!-- <link rel='stylesheet' type='text/css' href='<?php echo get_template_directory_uri(); ?>/assets/libs/swiper/swiper-bundle.min.css'> -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

    <!-- Main CSS -->
    <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/assets/css/style.css'>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>

<body <?php body_class(); ?>>

    <div class="loading">
        <span class="loader"></span>
    </div>

    <header class="site-header">
        <div class="container mx-auto">
            <div class="navbar flex flex-row items-center flex-nowrap !pt-6 !pb-5">
                <a href="<?= home_url() ?>" aria-label="Home Kraft" class="navbar-brand">
                    <img src="<?= IMG_URI ?>logo.svg" alt="">
                </a>
                <nav class="flex flex-row items-center gap-8 ms-auto">
                    <a class="menu-item <?= is_page('sobre') ? 'active' : '' ?> hidden lg:block" href="<?= home_url() ?>/sobre">Sobre</a>
                    <a class="menu-item <?= is_singular('empreendimento') || is_page('empreendimentos') ? 'active' : '' ?> hidden lg:block" href="<?= home_url() ?>/empreendimentos">Empreendimentos</a>
                    <a class="menu-item <?= is_home() || is_page('blog') ? 'active' : '' ?> hidden lg:block" href="<?= home_url() ?>/blog">Blog</a>
                    <a class="menu-item <?= is_page('contato') ? 'active' : '' ?> hidden lg:block" href="<?= home_url() ?>/contato">Fale Conosco</a>
                    <a class="cta !hidden lg:!block" href="#">Área do Cliente</a>
                    <a class="block lg:hidden js-menu-toggle" href="#" aria-label="Abrir menu"><img src="<?= IMG_URI ?>menu.svg" alt="Menu"></a>
                </nav>
            </div>
        </div>
    </header>

    <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <button class="mobile-menu__close js-menu-close" aria-label="Fechar menu">
            <span></span>
            <span></span>
        </button>
        <nav class="mobile-menu__nav">
            <a href="<?= home_url() ?>/sobre">Sobre</a>
            <a href="<?= home_url() ?>/empreendimentos">Empreendimentos</a>
            <a href="<?= home_url() ?>/blog">Blog</a>
            <a href="<?= home_url() ?>/contato">Fale Conosco</a>
            <a class="cta" href="#">Área do Cliente</a>
        </nav>
    </div>