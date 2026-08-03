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
            <div id="empreendimentos-cards" class="flex flex-col lg:grid grid-cols-12 gap-8">
                <?php
                $paged = 1;
                $the_query = nb_empreendimentos_query($paged, 10);
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