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

    <!-- <section class="filter">
        <div class="container">
            <div class="flex lg:flex-row flex-col gap-6">
                <div class="form-group flex flex-col flex-1">
                    <label for="telefone">Região ou Estado</label>
                    <select type="tel" name="telefone" placeholder="Telefone" required>
                        <option value="">Selecione</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="telefone">Telefone Fixo</option>
                    </select>
                </div>
                <div class="form-group flex flex-col flex-1">
                    <label for="mensagem">Tipo de Empreendimento</label>
                    <select type="email" name="email" placeholder="E-mail" required>
                        <option value="">Selecione</option>
                        <option value="interessado">Estou interessado em investir</option>
                        <option value="parceria">Quero ser parceiro</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
                <div class="form-group flex flex-col flex-1">
                    <label for="mensagem">Status da Obra</label>
                    <select type="email" name="email" placeholder="E-mail" required>
                        <option value="">Selecione</option>
                        <option value="interessado">Estou interessado em investir</option>
                        <option value="parceria">Quero ser parceiro</option>
                        <option value="outros">Outros</option>
                    </select>
                </div>
            </div>
        </div>
    </section> -->

    <section class="empreendimentos !mt-10">
        <div class="container">
            <div class="flex flex-col lg:grid grid-cols-12 gap-8">
                <?php
                $args = array(
                    'post_type' => 'empreendimento',
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
                                <h3>
                                    <?= get_the_title(); ?>
                                </h3>
                                <?php
                                if (have_rows('diferenciais_card')):
                                    ?>
                                    <div class="flex flex-row flex-nowrap justify-between items-center w-full my-6">
                                        <?php
                                        while (have_rows('diferenciais_card')):
                                            the_row();
                                            ?>
                                            <div class="inline-flex flex-[1_1_auto] items-center gap-2">
                                                <?php
                                                $icone = get_sub_field('icone');
                                                $svg_path = get_attached_file($icone['ID']);
                                                if ($svg_path && file_exists($svg_path)) {
                                                    echo file_get_contents($svg_path);
                                                }
                                                ?>
                                                <p class="mb-0">
                                                    <?= get_sub_field('texto'); ?>
                                                </p>
                                            </div>
                                        <?php endwhile; ?>

                                    </div>
                                <?php endif; ?>
                                <div class="thumbnail-holder">
                                    <img class="thumbnail" src="<?= get_field('thumbnail')['url']; ?>"
                                        alt="<?= get_field('thumbnail')['title']; ?>">
                                </div>
                            </div>
                            <div class="w-10 h-10 lg:w-15 lg:h-15 rounded-full bg-(--amarelo) absolute right-[30px] bottom-[30px]">
                                <img class="seta !w-6 !h-6 lg:!w-12 lg:!h-12 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
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