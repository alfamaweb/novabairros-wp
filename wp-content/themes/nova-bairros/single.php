<?php

/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate 1.0
 */

get_header(); ?>

<?php
// Recebe o Thumbnail da Imagem Destacada
// Sizes Example: thumbnail, medium, large, full
$post_thumbnail_id = get_post_thumbnail_id($post->ID);
$post_thumbnail_url = wp_get_attachment_image_src($post_thumbnail_id, $size = 'large')[0];

// Recebe as Categorias
$categoryclass = '';
$categories = get_the_category();
foreach ($categories as $category) {
	$categoryclass .= ' ct-' . esc_attr($category->slug);
}
?>

<meta property='og:image' content='<?php echo $post_thumbnail_url; ?>' />

<div id="content" class="reading reading-single">
	<div class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="content">
					<p><a href="<?= home_url() ?>/noticias">Notícias</a> > Leitura</p>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>