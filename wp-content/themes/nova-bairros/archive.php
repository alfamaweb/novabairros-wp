<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage None Plate
 * @since None Plate
 */

get_header(); ?>

<meta property='og:image' content='<?php echo get_template_directory_uri(); ?>/assets/img/meta/thumbnail.jpg'/>

<div id="content" class="reading reading-archive">
	<!-- BREADCRUMB -->
	<div class="bread-crumb" typeof="BreadcrumbList" vocab="http://schema.org/">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12">
	                <?php
	                    if(function_exists('bcn_display')) {
	                        bcn_display();
	                    }
	                ?>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- BLOG ROLL -->
	<section id="blog-roll" class="archive">
		<div class="blog-roll-container page-container">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<header class="page-header">
							<div class="the-title">
								<h1><?php single_cat_title(); ?></h1>
							</div>
						</header>

						<?php 
							// WP QUERY
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						    query_posts( array(
						          'post_type' => 'post',
						          'posts_per_page' => 6,
						          'posts_per_rss' => 6,
						          'paged' => $paged,
						          'orderby'=> 'date&order=ASC',
						          'cat' => $cat,
						          'post__not_in' => array($post_ID)
						     )); 

						?>
						<?php 
							// LOOP
						    if ( have_posts() ) :
						        while ( have_posts() ) : the_post();
						?>
							<?php
								$categoryclass = '';
								$categories = get_the_category();
								foreach ( $categories as $category ) { 
								    $categoryclass .= ' ct-'.esc_attr( $category->slug ); 
								}
							?>

							<article id="post-<?php echo $post->ID; ?>" class="post post-excerpt post-<?php echo $post->ID; ?><?php echo $categoryclass; ?>">
								<div class="container-fluid nopadding">
									<div class="row">
										<div class="col-md-3">
											<!-- Post Thumbnail -->
											<?php
												// Sizes Example: thumbnail, medium, large, full
									            $post_thumbnail_id = get_post_thumbnail_id($post->ID);
									            $post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, $size='large')[0];

									    	?>
									    	<div class="thumb">
									    		<a href="<?php the_permalink(); ?>" rel="bookmark">
										    		<span class="thumb-img" style="background:url(<?php echo $post_thumbnail_url; ?>);"></span>
										    		<img src="<?php echo $post_thumbnail_url; ?>" alt="<?php the_title(); ?>" class="hide">
										    	</a>
									    	</div>
										</div>
										<div class="col-md-9">
											<!-- Post Title -->
											<header class="excerpt-header">
												<div class="the-title">
													<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
												</div>
												<div class="the-date">
													<p>Publicado em <?php echo get_the_date(); ?></p>
												</div>
												<div class="the-categories">
													<?php echo get_the_category_list(); ?>
												</div>
											</header>
											<!-- Post Excerpt -->
											<div class="the-content">
												<a href="<?php the_permalink(); ?>" rel="bookmark">
													<?php has_excerpt() ? the_excerpt() : false; ?>
												</a>
											</div>
										</div>
									</div>
								</div>
							</article>

						<?php
						        endwhile;
						    else :
						?>
						    <p>Nada foi encontrado</p>
						<?php
						    endif;
						?>

				        <div class="pagenate">
							<?php echo paginate_links( $args ); ?>
				        </div>

				        <?php wp_reset_query(); ?>

					</div> <!-- col-md-12 -->
				</div> <!-- row -->
			</div> <!-- container -->
		</div> <!-- blog-roll-container -->
	</section>
</div>

<?php get_footer(); ?>
