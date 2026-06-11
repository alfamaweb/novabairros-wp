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

    <section class="blog !mt-10">
        <div class="container">
            <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 10,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish'
                );
                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                        ?>
                        <a class="card-outer relative col-span-6" href="<?= get_permalink(); ?>">
                            <div class="card">
                                <h3><?= get_the_title(); ?></h3>
                                <p class="!my-4"><?= get_the_excerpt(); ?></p>
                                <div class="thumbnail-holder">
                                    <img class="thumbnail"
                                        src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
                                        alt="<?= esc_attr(get_the_title()); ?>">
                                </div>
                            </div>
                            <div class="w-15 h-15 rounded-full bg-(--amarelo) absolute right-[30px] bottom-[30px]">
                                <img class="seta !w-12 !h-12 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                    src="<?= IMG_URI ?>arrow-right.svg" alt="">
                            </div>
                        </a>
                        <?php
                    }
                } else {
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>