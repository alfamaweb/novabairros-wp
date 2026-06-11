<?php
$hero = get_field('hero');
$desktop_img = $hero['desktop'] ?? null;
$mobile_img = $hero['mobile'] ?? null;
$desktop_id = $desktop_img['ID'] ?? null;
$mobile_id = $mobile_img['ID'] ?? null;
?>
<section class="hero interna h-auto relative !mt-0 mb-30 md:mb-40">
    <picture>
        <?php if ($mobile_id): ?>
            <source media="(max-width: 1023px)" srcset="<?= wp_get_attachment_image_srcset($mobile_id); ?>" sizes="100vw">
        <?php endif; ?>

        <?php if ($desktop_id): ?>
            <source media="(min-width: 1024px)" srcset="<?= wp_get_attachment_image_srcset($desktop_id); ?>" sizes="100vw">
        <?php endif; ?>

        <img src="<?= esc_url($desktop_img['url'] ?? $mobile_img['url']); ?>"
            srcset="<?= $desktop_id ? wp_get_attachment_image_srcset($desktop_id) : ''; ?>" sizes="100vw"
            alt="hero image" class="w-full h-full object-cover object-center min-h-[180px] max-h-[220px] md:min-h-[260px] md:max-h-[400px]"
            loading="eager" fetchpriority="high">
    </picture>
    <div class="absolute -bottom-2/7 left-0 w-full h-auto">
        <div class="container">
            <div
                class="inner-content w-full h-full flex flex-col items-center justify-center bg-(--verde) rounded-[10px] max-w-[1125px] mx-auto gap-5 pt-6 pb-10 px-4">
                <div class="breadcrumb flex flex-row items-center gap-3"><a class="!text-white font-semibold"
                        href="<?= home_url(); ?>">INÍCIO</a> <img src="<?= IMG_URI ?>arrow-left.svg" alt="Seta">
                    <p class="!text-white !uppercase font-bold"><?= get_the_title() ?></p>
                </div>
                <h1 class="!text-white text-center"><?= $hero['titulo'] ?? get_the_title() ?></h1>
            </div>
        </div>
    </div>
</section>