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
	<div class="breadcrumb mt-15">
		<div class="container">
			<div class="flex flex-row justify-center items-center gap-3">
				<a class="font-semibold" href="<?= home_url(); ?>">INÍCIO</a>
				<img src="<?= IMG_URI ?>arrow-left.svg" alt="Seta">
				<p class="!uppercase font-bold">BLOG</p>
			</div>
			<h1 class="text-center"><?= get_the_title() ?></h1>
		</div>
	</div>
	<main>
		<div class="container">
			<section class="thumbnail rounded-[10px] overflow-hidden">
				<div class="top bg-(--verde) hidden md:block py-7">
					<div class="flex flex-col md:flex-row w-full justify-center items-center gap-2">
						<p>Publicado em <?= get_the_date('F \d\e Y') ?></p>
						<span>•</span>
						<p>Compartilhe nas redes sociais</p>
						<?php
						$post_url   = urlencode(get_permalink());
						$post_title = urlencode(get_the_title());
						?>
						<div class="flex flex-row justify-center items-center gap-4 py-8 ms-4">
							<a href="https://api.whatsapp.com/send?text=<?= $post_title ?>%20<?= $post_url ?>" target="_blank" rel="noopener noreferrer">
								<img src="<?= IMG_URI ?>ic_baseline-whatsapp.svg" alt="WhatsApp" class="w-7 h-7">
							</a>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?= $post_url ?>" target="_blank" rel="noopener noreferrer">
								<img src="<?= IMG_URI ?>mingcute_facebook-line.svg" alt="Facebook" class="w-7 h-7">
							</a>
							<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $post_url ?>" target="_blank" rel="noopener noreferrer">
								<img src="<?= IMG_URI ?>iconoir_linkedin.svg" alt="LinkedIn" class="w-7 h-7">
							</a>
							<a href="https://twitter.com/intent/tweet?url=<?= $post_url ?>&text=<?= $post_title ?>" target="_blank" rel="noopener noreferrer">
								<img src="<?= IMG_URI ?>codicon_twitter.svg" alt="Twitter" class="w-7 h-7">
							</a>
						</div>
					</div>
				</div>
				<img class="w-full h-full max-h-140 object-cover" src="<?= get_the_post_thumbnail_url(get_the_id(), 'large') ?>" alt="thumbnail">
			</section>
			<div class="top bg-(--verde) md:hidden px-4 py-7 mt-5 rounded-[10px]">
				<div class="flex flex-col md:flex-row w-full gap-2">
					<p>Publicado em <?= get_the_date('F \d\e Y') ?></p>
					<div class="bg-(--amarelo) h-1 w-full"></div>
					<p>Compartilhe nas redes sociais</p>
					<?php
					$post_url   = urlencode(get_permalink());
					$post_title = urlencode(get_the_title());
					?>
					<div class="flex flex-row gap-4 pt-3">
						<a href="https://api.whatsapp.com/send?text=<?= $post_title ?>%20<?= $post_url ?>" target="_blank" rel="noopener noreferrer">
							<img src="<?= IMG_URI ?>ic_baseline-whatsapp.svg" alt="WhatsApp" class="w-7 h-7">
						</a>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?= $post_url ?>" target="_blank" rel="noopener noreferrer">
							<img src="<?= IMG_URI ?>mingcute_facebook-line.svg" alt="Facebook" class="w-7 h-7">
						</a>
						<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= $post_url ?>" target="_blank" rel="noopener noreferrer">
							<img src="<?= IMG_URI ?>iconoir_linkedin.svg" alt="LinkedIn" class="w-7 h-7">
						</a>
						<a href="https://twitter.com/intent/tweet?url=<?= $post_url ?>&text=<?= $post_title ?>" target="_blank" rel="noopener noreferrer">
							<img src="<?= IMG_URI ?>codicon_twitter.svg" alt="Twitter" class="w-7 h-7">
						</a>
					</div>
				</div>
			</div>
			<section class="content border-b pb-6 border-[#9C9C9C40]">
				<?= get_the_content() ?>
			</section>
			<section class="empreendimentos">
				<div class="container">
					<div class="flex flex-col justify-center gap-3 w-fit mx-auto text-center items-center mb-10">
						<span>outras notícias</span>
						<h2>Você também pode gostar</h2>
						<div class="border-b border-(--amarelo) border-[3px] w-full"></div>
					</div>
					<div class='swiper blog'>
						<div class='swiper-wrapper'>
							<?php
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 5,
								'orderby' => 'date',
								'order' => 'DESC',
								'post_status' => 'publish'
							);
							$the_query = new WP_Query($args);
							if ($the_query->have_posts()) {
								while ($the_query->have_posts()) {
									$the_query->the_post();
							?>
									<div class="swiper-slide">
										<a class="card-outer relative" href="<?= get_permalink(); ?>">
											<div class="card">
												<h3><?= get_the_title(); ?></h3>
												<p class="!my-4"><?= get_the_excerpt(); ?></p>
												<div class="thumbnail-holder">
													<img class="thumbnail"
														src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"
														alt="<?= get_the_title(); ?>">
												</div>
											</div>
											<div class="w-10 h-10 lg:w-15 lg:h-15 rounded-full bg-(--amarelo) absolute right-[30px] bottom-[30px]">
												<img class="seta !w-6 !h-6 lg:!w-12 lg:!h-12 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
													src="<?= IMG_URI ?>arrow-right.svg" alt="">
											</div>
										</a>
									</div>
							<?php
								}
							} else {
							}
							wp_reset_postdata();
							?>
						</div>

						<div class='swiper-button-prev'></div>
						<div class='swiper-button-next'></div>
					</div>
				</div>
			</section>
		</div>
	</main>
</div>

<?php get_footer(); ?>