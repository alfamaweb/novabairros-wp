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

    <section class="filter wow fadeInUp">
        <div class="container">
            <div class="flex lg:flex-row flex-col gap-6">
                <div class="form-group flex flex-col flex-1">
                    <label for="estado">Região ou Estado</label>
                    <select name="estado" placeholder="Estado" required>
                        <option value="">Todos</option>
                        <?php
                        $estado_param = isset($_GET['estado']) ? strtolower(sanitize_text_field($_GET['estado'])) : '';
                        $terms = get_terms(array(
                            'taxonomy' => 'estado',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                        ?>
                            <option value="<?= esc_attr($term->slug); ?>" <?= ($estado_param === $term->slug) ? 'selected' : ''; ?>><?= esc_html($term->name); ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group flex flex-col flex-1">
                    <label for="tipo">Tipo de Empreendimento</label>
                    <select name="tipo" placeholder="Tipo de Empreendimento" required>
                        <option value="">Todos</option>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'tipo',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                        ?>
                            <option value="<?= $term->slug; ?>"><?= $term->name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group flex flex-col flex-1">
                    <label for="status">Status da Obra</label>
                    <select name="status" placeholder="Status da Obra" required>
                        <option value="">Todos</option>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'stt',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                        ?>
                            <option value="<?= $term->slug; ?>"><?= $term->name; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="empreendimentos !mt-10">
        <div class="container">
            <div id="empreendimentos-cards" class="flex flex-col xl:grid grid-cols-12 gap-8 ">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $filters = array();
                if (isset($_GET['estado']) && !empty($_GET['estado'])) {
                    $filters['estado'] = strtolower(sanitize_text_field($_GET['estado']));
                }

                $the_query = nb_empreendimentos_query($paged, 10, $filters);
                echo nb_render_empreendimentos_cards($the_query);
                $max_pages = (int) $the_query->max_num_pages;
                ?>
            </div>
            <div id="empreendimentos-pagination-wrapper">
                <?php echo nb_render_empreendimentos_pagination($paged, $max_pages); ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>