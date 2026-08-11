<?php
define('THEME_URI', get_template_directory_uri());
define('IMG_URI', THEME_URI . '/assets/img/');
define('CSS_URI', THEME_URI . '/assets/css/');
define('JS_URI', THEME_URI . '/assets/js/');
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.4-alpha', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twentysixteen_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup()
	{
		/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
		load_theme_textdomain('twentysixteen', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
		add_theme_support('title-tag');

		/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
		add_theme_support('custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		));

		/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1200, 9999);

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'twentysixteen'),
			'social'  => __('Social Links Menu', 'twentysixteen'),
		));

		/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		));

		/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
		add_editor_style(array('css/editor-style.css', twentysixteen_fonts_url()));

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support('customize-selective-refresh-widgets');
	}
endif; // twentysixteen_setup
add_action('after_setup_theme', 'twentysixteen_setup');

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width()
{
	$GLOBALS['content_width'] = apply_filters('twentysixteen_content_width', 840);
}
add_action('after_setup_theme', 'twentysixteen_content_width', 0);

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Sidebar', 'twentysixteen'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.', 'twentysixteen'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Content Bottom 1', 'twentysixteen'),
		'id'            => 'sidebar-2',
		'description'   => __('Appears at the bottom of the content on posts and pages.', 'twentysixteen'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));

	register_sidebar(array(
		'name'          => __('Content Bottom 2', 'twentysixteen'),
		'id'            => 'sidebar-3',
		'description'   => __('Appears at the bottom of the content on posts and pages.', 'twentysixteen'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'twentysixteen_widgets_init');

if (!function_exists('twentysixteen_fonts_url')) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url()
	{
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Merriweather font: on or off', 'twentysixteen')) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Montserrat font: on or off', 'twentysixteen')) {
			$fonts[] = 'Montserrat:400,700';
		}

		/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
		if ('off' !== _x('on', 'Inconsolata font: on or off', 'twentysixteen')) {
			$fonts[] = 'Inconsolata:400';
		}

		if ($fonts) {
			$fonts_url = add_query_arg(array(
				'family' => urlencode(implode('|', $fonts)),
				'subset' => urlencode($subsets),
			), 'https://fonts.googleapis.com/css');
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection()
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'twentysixteen_javascript_detection', 0);

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts()
{
	// Add custom fonts, used in the main stylesheet.
	// wp_enqueue_style('twentysixteen-fonts', twentysixteen_fonts_url(), array(), null); // comentado: usando fontes locais em assets/css/fonts.css
	// Enqueue local fonts file generated in assets/css/fonts.css
	wp_enqueue_style('theme-local-fonts', CSS_URI . 'fonts.css', array(), null);

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style('genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1');

	// Theme stylesheet.
	wp_enqueue_style('twentysixteen-style', get_stylesheet_uri());

	// Tailwind CSS
	wp_enqueue_style('tailwind-style', get_template_directory_uri() . '/assets/css/tailwind.css', array(), '1.0');

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style('twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array('twentysixteen-style'), '20160412');
	wp_style_add_data('twentysixteen-ie', 'conditional', 'lt IE 10');

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style('twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array('twentysixteen-style'), '20160412');
	wp_style_add_data('twentysixteen-ie8', 'conditional', 'lt IE 9');

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style('twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array('twentysixteen-style'), '20160412');
	wp_style_add_data('twentysixteen-ie7', 'conditional', 'lt IE 8');

	// Load the html5 shiv.
	wp_enqueue_script('twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3');
	wp_script_add_data('twentysixteen-html5', 'conditional', 'lt IE 9');

	wp_enqueue_script('twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160412', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (is_singular() && wp_attachment_is_image()) {
		wp_enqueue_script('twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20160412');
	}

	wp_enqueue_script('twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20160412', true);

	// SweetAlert2
	wp_enqueue_style('sweetalert2-css', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.min.css', array(), '11.4.18');
	wp_enqueue_script('sweetalert2-js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js', array(), '11.4.18', true);

	wp_localize_script('twentysixteen-script', 'screenReaderText', array(
		'expand'   => __('expand child menu', 'twentysixteen'),
		'collapse' => __('collapse child menu', 'twentysixteen'),
	));
}
add_action('wp_enqueue_scripts', 'twentysixteen_scripts');

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes($classes)
{
	// Adds a class of custom-background-image to sites with a custom background image.
	if (get_background_image()) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if (is_multi_author()) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter('body_class', 'twentysixteen_body_classes');

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb($color)
{
	$color = trim($color, '#');

	if (strlen($color) === 3) {
		$r = hexdec(substr($color, 0, 1) . substr($color, 0, 1));
		$g = hexdec(substr($color, 1, 1) . substr($color, 1, 1));
		$b = hexdec(substr($color, 2, 1) . substr($color, 2, 1));
	} else if (strlen($color) === 6) {
		$r = hexdec(substr($color, 0, 2));
		$g = hexdec(substr($color, 2, 2));
		$b = hexdec(substr($color, 4, 2));
	} else {
		return array();
	}

	return array('red' => $r, 'green' => $g, 'blue' => $b);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr($sizes, $size)
{
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ('page' === get_post_type()) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter('wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr($attr, $attachment, $size)
{
	if ('post-thumbnail' === $size) {
		is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		!is_active_sidebar('sidebar-1') && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3);

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args($args)
{
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter('widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args');


// Custom Wordpress Gallery Template
add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr)
{
	global $post;

	if (isset($attr['orderby'])) {
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if (!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
		'include' => '',
		'exclude' => ''
	), $attr));

	$id = intval($id);
	if ('RAND' == $order) $orderby = 'none';

	if (!empty($include)) {
		$include = preg_replace('/[^0-9,]+/', '', $include);
		$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

		$attachments = array();
		foreach ($_attachments as $key => $val) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	}

	if (empty($attachments)) return '';

	$columns = intval($columns);

	// Here's your actual output, you may customize it to your need
	$output = "<div id='gallery-" . $id . "' class='gallery galleryid-62 gallery-columns-" . $columns . " gallery-size-thumbnail'>";
	$postid = $id;

	// Now you loop through each attachment
	foreach ($attachments as $id => $attachment) {
		// Fetch the thumbnail (or full image, it's up to you)
		//      $img = wp_get_attachment_image_src($id, 'medium');
		//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
		$img = wp_get_attachment_image_src($id, 'large');

		$output .= "<figure class='gallery-item'> <div class='gallery-icon thumb'> <a href=\"{$img[0]}\" data-fancybox='gallery-" . $postid . "' data-caption='" . esc_attr($attachment->post_excerpt) . "'>";
		$output .= "<span class='thumb-img' style='background:url(\"{$img[0]}\");'></span>";
		$output .= "<img class='hide' src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt='" . esc_attr($attachment->post_excerpt) . "' />\n";
		$output .= "</a> </div> </figure>";
	}

	$output .= "</div>\n";

	return $output;
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
	return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more($more)
{
	return '[.....]';
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');



add_action('wp_footer', function () {
?>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Alertas para Contact Form 7 (existente)
			if (document.querySelector('.wpcf7-form')) {
				var style = document.createElement('style');
				style.innerText = '.wpcf7-response-output, .wpcf7-spinner { display: none !important; }.wpcf7-form.submitting:before {width: 100%;height: 100%;background: rgba(255, 255, 255, 0.5);top: 0;left: 0;position: absolute;content: " ";display: flex;align-items: center;justify-content: center; z-index: 1;background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/loading.gif);background-repeat: no-repeat;background-position: center;}.wpcf7-form{position:relative;}';
				document.head.appendChild(style);

				$('.wpcf7-form').on('wpcf7mailsent', function(event) {
					Swal.fire({
						title: 'Mensagem enviada!',
						text: event.originalEvent.detail.apiResponse.message ?? 'Sua mensagem foi enviada com sucesso.',
						icon: 'success',
						confirmButtonColor: '#E54344'
					})
				})
				$('.wpcf7-form').on('wpcf7mailfailed wpcf7invalid wpcf7spam', function(event) {
					Swal.fire({
						title: 'Erro ao enviar',
						text: event.originalEvent.detail.apiResponse.message ?? 'Ocorreu um erro ao enviar a mensagem. Tente novamente mais tarde.',
						icon: 'error',
						confirmButtonColor: '#E54344'
					})
				})
			}

			// Alertas para Formulários Manuais (Novos)
			const urlParams = new URLSearchParams(window.location.search);
			const formStatus = urlParams.get('form_sent');

			if (formStatus === 'success') {
				Swal.fire({
					title: 'Enviado com sucesso!',
					text: 'Seus dados foram encaminhados à nossa equipe. Em breve entraremos em contato.',
					icon: 'success',
					confirmButtonColor: '#E54344'
				});
				// Limpa a URL
				window.history.replaceState({}, document.title, window.location.pathname);
			} else if (formStatus === 'error') {
				Swal.fire({
					title: 'Erro no envio',
					text: 'Não foi possível enviar seus dados no momento. Por favor, tente novamente mais tarde.',
					icon: 'error',
					confirmButtonColor: '#E54344'
				});
				// Limpa a URL
				window.history.replaceState({}, document.title, window.location.pathname);
			}
		})
	</script>
	<?php
});

function criar_arquivos_dinamicos_ao_publicar($new_status, $old_status, $post)
{
	if ('publish' !== $new_status || 'publish' === $old_status) {
		return;
	}

	// Lista de post types permitidos
	$post_types_permitidos = ['post', 'page', 'meu_cpt'];

	if (!in_array($post->post_type, $post_types_permitidos, true)) {
		return;
	}

	$css_dir = get_stylesheet_directory() . '/assets/css/';
	if (!file_exists($css_dir)) {
		wp_mkdir_p($css_dir);
	}

	$arquivos_criados = [];

	// CSS por SLUG (somente páginas)
	if ($post->post_type === 'page') {
		$slug = $post->post_name;
		$slug_file = $css_dir . $slug . '.css';
		if (!file_exists($slug_file)) {
			$conteudo_css = "/* Estilo automático para a página: {$slug} */\n";
			if (file_put_contents($slug_file, $conteudo_css) !== false) {
				$arquivos_criados[] = 'assets/css/' . $slug . '.css';
			}
		}

		// Criação de page-slug.php
		$tema_dir = get_stylesheet_directory();
		$novo_template = $tema_dir . '/page-' . $slug . '.php';
		$template_base = get_theme_file_path('page.php');
		if (file_exists($template_base) && !file_exists($novo_template)) {
			if (copy($template_base, $novo_template)) {
				$arquivos_criados[] = 'page-' . $slug . '.php';
			}
		}
	}

	// CSS por TIPO DE POST
	$post_type = $post->post_type;
	$type_file = $css_dir . $post_type . '.css';
	if (!file_exists($type_file)) {
		$conteudo_css = "/* Estilo automático para o tipo de post: {$post_type} */\n";
		if (file_put_contents($type_file, $conteudo_css) !== false) {
			$arquivos_criados[] = 'assets/css/' . $post_type . '.css';
		}
	}

	if (!empty($arquivos_criados)) {
		set_transient('arquivos_criados_aviso', $arquivos_criados, 60);
	}
}
add_action('transition_post_status', 'criar_arquivos_dinamicos_ao_publicar', 10, 3);


/**
 * Exibe um aviso no painel admin sobre os arquivos que foram criados.
 *
 * Lê a informação do transient e a exibe, depois apaga o transient
 * para que o aviso não seja mostrado novamente.
 */
function exibir_aviso_arquivos_criados()
{
	if ($arquivos_criados = get_transient('arquivos_criados_aviso')) {
		echo '<div class="notice notice-success is-dismissible"><p><strong>Arquivos automáticos criados:</strong></p><ul>';
		foreach ($arquivos_criados as $arquivo) {
			echo '<li><code>' . esc_html($arquivo) . '</code></li>';
		}
		echo '</ul></div>';
		delete_transient('arquivos_criados_aviso');
	}
}
add_action('admin_notices', 'exibir_aviso_arquivos_criados');

function carregar_estilos_dinamicos()
{
	$css_dir = get_stylesheet_directory() . '/assets/css/';
	$css_uri = get_stylesheet_directory_uri() . '/assets/css/';

	wp_enqueue_style('estilo-global', $css_uri . 'style.css', [], filemtime($css_dir . 'style.css'));
	wp_enqueue_style('tailwind', $css_uri . 'tailwind.css', [], filemtime($css_dir . 'tailwind.css'));

	$estilos_enfileirados = [];

	// Página: carrega slug.css
	if (is_page()) {
		$slug = get_post_field('post_name', get_the_ID());
		$slug_file = $css_dir . $slug . '.css';
		if (file_exists($slug_file)) {
			wp_enqueue_style('estilo-' . $slug, $css_uri . $slug . '.css', [], filemtime($slug_file));
			$estilos_enfileirados[] = $slug;
		}
	}

	// Singular (post, produto, etc.): carrega tipo.css
	if (is_singular()) {
		$post_type = get_post_type();
		$type_file = $css_dir . $post_type . '.css';
		if (file_exists($type_file)) {
			wp_enqueue_style('estilo-' . $post_type, $css_uri . $post_type . '.css', [], filemtime($type_file));
			$estilos_enfileirados[] = $post_type;
		}
	}

	// Home
	if (is_front_page() || is_home()) {
		$home_file = $css_dir . 'home.css';
		if (file_exists($home_file)) {
			wp_enqueue_style('estilo-home', $css_uri . 'home.css', [], filemtime($home_file));
			$estilos_enfileirados[] = 'home';
		}
	}

	// Arquivo
	if (is_archive() && file_exists($css_dir . 'archive.css')) {
		wp_enqueue_style('estilo-archive', $css_uri . 'archive.css', [], filemtime($css_dir . 'archive.css'));
		$estilos_enfileirados[] = 'archive';
	}

	// Busca
	if (is_search() && file_exists($css_dir . 'search.css')) {
		wp_enqueue_style('estilo-search', $css_uri . 'search.css', [], filemtime($css_dir . 'search.css'));
		$estilos_enfileirados[] = 'search';
	}

	// 404
	if (is_404() && file_exists($css_dir . '404.css')) {
		wp_enqueue_style('estilo-404', $css_uri . '404.css', [], filemtime($css_dir . '404.css'));
		$estilos_enfileirados[] = '404';
	}

	// Debug opcional
	// error_log("CSS enfileirados: " . implode(', ', $estilos_enfileirados));
}
add_action('wp_enqueue_scripts', 'carregar_estilos_dinamicos');


function disable_search_engine_indexing()
{
	$url = site_url();
	$search = "dev.";

	if (strpos($url, $search) !== false) {
		update_option('blog_public', '0');
		// echo 'desindexado';
	} else {
		update_option('blog_public', '1');
	}
}
add_action('init', 'disable_search_engine_indexing');

function add_noindex_admin_bar($wp_admin_bar)
{
	$url = site_url();
	$search = "dev.";

	if (strpos($url, $search) !== false) {
		$wp_admin_bar->remove_node('index');
		$wp_admin_bar->add_node(array(
			'id' => 'noindex',
			'title' => '🚫 Não Indexado',
		));
	} else {
		$wp_admin_bar->remove_node('noindex');
		$wp_admin_bar->add_node(array(
			'id' => 'index',
			'title' => '✅ Indexado',
		));
	}
}
add_action('admin_bar_menu', 'add_noindex_admin_bar', 100);



function theme_enqueue_style_if_exists($slug, $dir, $handle_prefix = 'theme')
{
	$relative = trailingslashit($dir) . $slug . '.css';

	// child first
	$path = get_stylesheet_directory() . $relative;
	$uri  = get_stylesheet_directory_uri() . $relative;

	if (!file_exists($path)) {
		$path = get_template_directory() . $relative;
		$uri  = get_template_directory_uri() . $relative;
	}

	if (!file_exists($path)) {
		return false;
	}

	$handle = "{$handle_prefix}-{$slug}";

	if (!wp_style_is($handle, 'enqueued')) {
		wp_enqueue_style($handle, $uri, [], filemtime($path));
	}

	return true;
}

function get_acf_oembed_data($field_name, $post_id = null, $is_sub = false)
{
	$iframe = $is_sub ? get_sub_field($field_name) : get_field($field_name, $post_id);

	if (!$iframe) {
		return false;
	}

	// Se vier iframe completo, extrai o src
	if (strpos($iframe, '<iframe') !== false) {
		preg_match('/src="([^"]+)"/', $iframe, $matches);
		$iframe = $matches[1] ?? '';
	}

	$data = [
		'url'        => $iframe,
		'video_id'   => null,
		'provider'   => null,
		'thumbnail'  => null,
		'embed_url'  => null,
	];

	if (strpos($iframe, 'youtube') !== false || strpos($iframe, 'youtu.be') !== false) {
		$data['provider'] = 'youtube';

		$video_id = null;

		$parsed_url = parse_url($iframe);

		// Caso: youtu.be/ID
		if (isset($parsed_url['host']) && $parsed_url['host'] === 'youtu.be') {
			$video_id = ltrim($parsed_url['path'], '/');
		}

		// Caso: youtube.com/watch?v=ID
		if (isset($parsed_url['query'])) {
			parse_str($parsed_url['query'], $query_params);

			if (!empty($query_params['v'])) {
				$video_id = $query_params['v'];
			}
		}

		// Caso: /embed/ID ou /shorts/ID
		if (!$video_id && isset($parsed_url['path'])) {
			preg_match('/\/(embed|shorts)\/([a-zA-Z0-9_-]+)/', $parsed_url['path'], $matches);

			if (!empty($matches[2])) {
				$video_id = $matches[2];
			}
		}

		if ($video_id) {
			$data['video_id'] = $video_id;
			$data['thumbnail'] = "https://i.ytimg.com/vi/{$video_id}/maxresdefault.jpg";
			$data['embed_url'] = "https://www.youtube.com/embed/{$video_id}?autoplay=1";
		}
	}

	if (strpos($iframe, 'vimeo') !== false) {
		$data['provider'] = 'vimeo';

		preg_match('/vimeo\.com\/(\d+)/', $iframe, $matches);

		if (!empty($matches[1])) {
			$video_id = $matches[1];
			$data['video_id'] = $video_id;

			$data['embed_url'] = "https://player.vimeo.com/video/{$video_id}?autoplay=1";

			$response = wp_remote_get("https://vimeo.com/api/v2/video/{$video_id}.json");

			if (!is_wp_error($response)) {
				$body = json_decode(wp_remote_retrieve_body($response));

				if (!empty($body[0]->thumbnail_large)) {
					$data['thumbnail'] = $body[0]->thumbnail_large;
				}
			}
		}
	}

	return $data;
}

/**
 * Página Empreendimentos - listagem com paginação via AJAX
 */
function nb_empreendimentos_query($paged = 1, $posts_per_page = 10, $filters = array())
{
	$args = array(
		'post_type' => 'empreendimento',
		'posts_per_page' => $posts_per_page,
		'orderby' => 'date',
		'order' => 'DESC',
		'post_status' => 'publish',
		'paged' => $paged,
	);

	if (!empty($filters)) {
		$tax_query = array('relation' => 'AND');

		if (!empty($filters['estado'])) {
			$tax_query[] = array(
				'taxonomy' => 'estado',
				'field'    => 'slug',
				'terms'    => $filters['estado'],
			);
		}

		if (!empty($filters['tipo'])) {
			$tax_query[] = array(
				'taxonomy' => 'tipo',
				'field'    => 'slug',
				'terms'    => $filters['tipo'],
			);
		}

		if (!empty($filters['status'])) {
			$tax_query[] = array(
				'taxonomy' => 'stt',
				'field'    => 'slug',
				'terms'    => $filters['status'],
			);
		}

		if (count($tax_query) > 1) {
			$args['tax_query'] = $tax_query;
		}
	}

	return new WP_Query($args);
}

function nb_render_empreendimentos_cards($the_query)
{
	ob_start();
	if ($the_query->have_posts()):
		while ($the_query->have_posts()):
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
						<div class="flex flex-row flex-wrap justify-between items-center w-full my-6 gap-3">
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
		endwhile;
	endif;
	wp_reset_postdata();
	return ob_get_clean();
}

/**
 * Monta a lista de páginas a exibir, com "..." para intervalos maiores.
 *
 * @return array<int|string>
 */
function nb_pagination_range($current, $total, $edge = 1, $around = 1)
{
	$range = array();
	$show_items = ($edge * 2) + ($around * 2) + 1;

	if ($total <= $show_items + 2) {
		for ($i = 1; $i <= $total; $i++) {
			$range[] = $i;
		}
		return $range;
	}

	for ($i = 1; $i <= $total; $i++) {
		if ($i === 1 || $i === $total || ($i >= $current - $around && $i <= $current + $around)) {
			$range[] = $i;
		} elseif (empty($range) || end($range) !== '...') {
			$range[] = '...';
		}
	}

	return $range;
}

function nb_render_empreendimentos_pagination($paged, $max_pages)
{
	if ($max_pages <= 1) {
		return '';
	}

	ob_start();
	?>
	<nav class="empreendimentos-pagination" aria-label="Paginação de empreendimentos">
		<?php foreach (nb_pagination_range($paged, $max_pages) as $item): ?>
			<?php if ('...' === $item): ?>
				<span class="empreendimentos-pagination__dots">&hellip;</span>
			<?php else: ?>
				<button
					type="button"
					class="empreendimentos-pagination__item<?= $item === $paged ? ' is-active' : ''; ?>"
					data-page="<?= esc_attr($item); ?>"
					<?= $item === $paged ? 'aria-current="page"' : ''; ?>>
					<?= $item; ?>
				</button>
			<?php endif; ?>
		<?php endforeach; ?>
	</nav>
	<?php
	return ob_get_clean();
}

function nb_ajax_load_empreendimentos()
{
	check_ajax_referer('nb_empreendimentos_nonce', 'nonce');

	$max_pages = 1;
	$paged = isset($_POST['paged']) ? max(1, intval($_POST['paged'])) : 1;
	$filters = isset($_POST['filters']) ? $_POST['filters'] : array();
	$the_query = nb_empreendimentos_query($paged, 10, $filters);
	$max_pages = max(1, (int) $the_query->max_num_pages);
	$paged = min($paged, $max_pages);

	wp_send_json_success(array(
		'cards' => nb_render_empreendimentos_cards($the_query),
		'pagination' => nb_render_empreendimentos_pagination($paged, $max_pages),
	));
}
add_action('wp_ajax_nb_load_empreendimentos', 'nb_ajax_load_empreendimentos');
add_action('wp_ajax_nopriv_nb_load_empreendimentos', 'nb_ajax_load_empreendimentos');

function nb_empreendimentos_scripts()
{
	if (!is_page('empreendimentos')) {
		return;
	}

	wp_enqueue_script('nb-empreendimentos', JS_URI . 'empreendimentos.js', array('jquery'), '1.0', true);
	wp_localize_script('nb-empreendimentos', 'nbEmpreendimentos', array(
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('nb_empreendimentos_nonce'),
	));
}
add_action('wp_enqueue_scripts', 'nb_empreendimentos_scripts');

function get_oembed_data_from_url($iframe)
{
	if (!$iframe) return false;

	$data = [
		'url'        => $iframe,
		'video_id'   => null,
		'provider'   => null,
		'thumbnail'  => null,
		'embed_url'  => null,
	];

	// YouTube
	if (strpos($iframe, 'youtube') !== false || strpos($iframe, 'youtu.be') !== false) {
		$data['provider'] = 'youtube';

		preg_match('/(youtu\.be\/|v=|embed\/|shorts\/)([a-zA-Z0-9_-]+)/', $iframe, $matches);

		if (!empty($matches[2])) {
			$id = $matches[2];

			$data['video_id']  = $id;
			$data['thumbnail'] = "https://i.ytimg.com/vi/{$id}/maxresdefault.jpg";
			$data['embed_url'] = "https://www.youtube.com/embed/{$id}?autoplay=1";
		}
	}

	// Vimeo
	if (strpos($iframe, 'vimeo') !== false) {
		$data['provider'] = 'vimeo';

		preg_match('/vimeo\.com\/(\d+)/', $iframe, $matches);

		if (!empty($matches[1])) {
			$id = $matches[1];

			$data['video_id']  = $id;
			$data['embed_url'] = "https://player.vimeo.com/video/{$id}?autoplay=1";
		}
	}

	return $data;
}

// AJAX para filtrar empreendimentos por estado
add_action('wp_ajax_filter_empreendimentos', 'filter_empreendimentos_ajax');
add_action('wp_ajax_nopriv_filter_empreendimentos', 'filter_empreendimentos_ajax');
function filter_empreendimentos_ajax()
{
	$estado = isset($_POST['estado']) ? sanitize_text_field($_POST['estado']) : '';

	$args_loc = array(
		'post_type'      => 'empreendimento',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post_status'    => 'publish',
	);

	if (!empty($estado)) {
		$args_loc['tax_query'] = array(
			array(
				'taxonomy' => 'estado',
				'field'    => 'name',
				'terms'    => $estado,
			)
		);
	}

	$query_loc = new WP_Query($args_loc);

	if ($query_loc->have_posts()):
		while ($query_loc->have_posts()): $query_loc->the_post();
			$estado_terms = get_the_terms(get_the_ID(), 'estado');
			$estado_sigla = !empty($estado_terms) ? $estado_terms[0]->name : '';
	?>
			<a class="card-outer relative swiper-slide" data-estado="<?= esc_attr($estado_sigla); ?>" href="<?= get_permalink(); ?>">
				<div class="card card-small">
					<h3><?= get_the_title(); ?></h3>
					<div class="flex justify-between">
						<?php if (get_field('cidade')): ?>
							<div class="itm">
								<svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M12.1278 11.755C12.3103 11.6637 12.5199 11.6425 12.717 11.6955C12.9141 11.7485 13.0848 11.872 13.1969 12.0425L13.2453 12.1275L14.9119 15.4608C14.9714 15.5797 15.0016 15.7111 14.9999 15.844C14.9983 15.9769 14.9649 16.1075 14.9025 16.2248C14.8401 16.3422 14.7505 16.4429 14.6413 16.5186C14.532 16.5943 14.4062 16.6428 14.2744 16.66L14.1669 16.6667H0.833602C0.70066 16.6667 0.569637 16.6349 0.451474 16.574C0.333311 16.5131 0.231437 16.4248 0.15436 16.3165C0.0772817 16.2082 0.0272371 16.083 0.00840427 15.9514C-0.0104286 15.8198 0.0024971 15.6856 0.046102 15.56L0.0877686 15.46L1.75444 12.1267C1.84785 11.9336 2.01212 11.7839 2.21307 11.7089C2.41401 11.6339 2.63615 11.6392 2.83326 11.7238C3.03037 11.8084 3.18727 11.9657 3.2713 12.1631C3.35534 12.3604 3.36004 12.5826 3.28444 12.7833L3.24527 12.8725L2.18194 15H12.8186L11.7553 12.8725C11.6566 12.6749 11.6404 12.4462 11.7102 12.2367C11.7801 12.0271 11.9303 11.8539 12.1278 11.755ZM7.50027 0C9.04736 0 10.5311 0.614581 11.6251 1.70854C12.719 2.80251 13.3336 4.28624 13.3336 5.83333C13.3336 7.81833 12.2594 9.43083 11.1478 10.575C10.5338 11.1988 9.85872 11.7594 9.13277 12.2483L8.82194 12.4533L8.54527 12.6275L8.4211 12.7025L8.20693 12.8258C7.76693 13.0758 7.2336 13.0758 6.7936 12.8258L6.57944 12.7017L6.3211 12.5442L6.1786 12.4533L5.86777 12.2483C5.14182 11.7594 4.46677 11.1988 3.85277 10.575C2.7411 9.43083 1.66694 7.81833 1.66694 5.83333C1.66694 4.28624 2.28152 2.80251 3.37548 1.70854C4.46944 0.614581 5.95317 0 7.50027 0ZM7.50027 1.66667C6.3952 1.66667 5.33539 2.10565 4.55399 2.88705C3.77259 3.66846 3.3336 4.72826 3.3336 5.83333C3.3336 7.19667 4.07527 8.4125 5.04777 9.41333C5.63274 10.0042 6.27919 10.5308 6.9761 10.9842L7.25944 11.165C7.34721 11.2189 7.42749 11.2672 7.50027 11.31L7.74194 11.165L8.02444 10.9842C8.72135 10.5308 9.3678 10.0042 9.95277 9.41333C10.9253 8.41333 11.6669 7.19667 11.6669 5.83333C11.6669 4.72826 11.2279 3.66846 10.4465 2.88705C9.66514 2.10565 8.60534 1.66667 7.50027 1.66667ZM7.50027 3.33333C8.16331 3.33333 8.79919 3.59673 9.26804 4.06557C9.73688 4.53441 10.0003 5.17029 10.0003 5.83333C10.0003 6.49637 9.73688 7.13226 9.26804 7.6011C8.79919 8.06994 8.16331 8.33333 7.50027 8.33333C6.83723 8.33333 6.20134 8.06994 5.7325 7.6011C5.26366 7.13226 5.00027 6.49637 5.00027 5.83333C5.00027 5.17029 5.26366 4.53441 5.7325 4.06557C6.20134 3.59673 6.83723 3.33333 7.50027 3.33333ZM7.50027 5C7.27925 5 7.06729 5.0878 6.91101 5.24408C6.75473 5.40036 6.66693 5.61232 6.66693 5.83333C6.66693 6.05435 6.75473 6.26631 6.91101 6.42259C7.06729 6.57887 7.27925 6.66667 7.50027 6.66667C7.72128 6.66667 7.93324 6.57887 8.08952 6.42259C8.2458 6.26631 8.3336 6.05435 8.3336 5.83333C8.3336 5.61232 8.2458 5.40036 8.08952 5.24408C7.93324 5.0878 7.72128 5 7.50027 5Z" fill="#007141" />
								</svg>
								<?php echo get_field('cidade') ?>
							</div>
						<?php endif; ?>
						<?php if (get_field('tamanho')): ?>
							<div class="itm">
								<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.388 0.0120001C11.6613 0.0680001 11.868 0.310667 11.868 0.6V5.93333L11.8547 6.05467C11.8271 6.1903 11.7535 6.31224 11.6464 6.39983C11.5392 6.48742 11.4051 6.53527 11.2667 6.53527C11.1283 6.53527 10.9941 6.48742 10.887 6.39983C10.7798 6.31224 10.7062 6.1903 10.6787 6.05467L10.6667 5.93467V2.04667L2.04933 10.6667L5.93333 10.668L6.05467 10.68C6.1993 10.711 6.32738 10.7943 6.41433 10.914C6.50127 11.0337 6.54095 11.1812 6.52574 11.3284C6.51053 11.4755 6.4415 11.6118 6.33192 11.7112C6.22234 11.8105 6.07992 11.8659 5.932 11.8667H0.6C0.44087 11.8667 0.288258 11.8035 0.175736 11.6909C0.0632143 11.5784 0 11.4258 0 11.2667V5.93333L0.0133333 5.81333C0.0408751 5.6777 0.114461 5.55576 0.221622 5.46817C0.328784 5.38058 0.462931 5.33273 0.601333 5.33273C0.739736 5.33273 0.873883 5.38058 0.981044 5.46817C1.08821 5.55576 1.16179 5.6777 1.18933 5.81333L1.2 5.93333V9.81867L9.81867 1.2H5.93333C5.7742 1.2 5.62159 1.13679 5.50907 1.02426C5.39655 0.911742 5.33333 0.75913 5.33333 0.6C5.33333 0.44087 5.39655 0.288258 5.50907 0.175736C5.62159 0.0632143 5.7742 0 5.93333 0H11.2667L11.388 0.0120001Z" fill="#007141" />
								</svg>
								<?php echo get_field('tamanho') ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="thumbnail-holder thumbnail-holder--small">
						<img class="thumbnail" src="<?= get_field('thumbnail')['url']; ?>" alt="<?= esc_attr(get_field('thumbnail')['title']); ?>">
					</div>
				</div>
				<div class="w-10 h-10 rounded-full bg-(--amarelo) absolute right-4 bottom-4">
					<img class="seta !w-6 !h-6 lg:!w-8 lg:!h-8 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" src="<?= IMG_URI ?>arrow-right.svg" alt="">
				</div>
			</a>
<?php
		endwhile;
		wp_reset_postdata();
	endif;

	wp_die();
}


add_action('phpmailer_init', 'custom_phpmailer_init');
function custom_phpmailer_init($phpmailer)
{

	$phpmailer->isSMTP();
	$phpmailer->Host = 'smtp.gmail.com';
	$phpmailer->Port = 465;
	$phpmailer->Username = 'pleasedontreplyauto@gmail.com';
	$phpmailer->Password =  'ebdi gekv azav jamv';
	$phpmailer->SMTPAuth = true;
	$phpmailer->SMTPSecure = 'ssl';
	$phpmailer->From       = 'pleasedontreplyauto@gmail.com';
	$phpmailer->FromName   = 'Nova Bairros Planejados';
}

add_action('wp_ajax_send_contact_form', 'send_contact_form_ajax');
add_action('wp_ajax_nopriv_send_contact_form', 'send_contact_form_ajax');

function send_contact_form_ajax()
{
	check_ajax_referer('send_contact_form_nonce', 'nonce');

	$form_type = isset($_POST['form_type']) ? sanitize_text_field($_POST['form_type']) : '';

	$attachments = [];
	$temp_file = '';
	if (!empty($_FILES['anexo']['tmp_name'])) {
		$upload_dir = wp_upload_dir();
		$file_name = sanitize_file_name($_FILES['anexo']['name']);
		$temp_file = trailingslashit($upload_dir['basedir']) . 'temp_anexo_' . time() . '_' . $file_name;
		if (move_uploaded_file($_FILES['anexo']['tmp_name'], $temp_file)) {
			$attachments[] = $temp_file;
		}
	}

	$headers = ['Content-Type: text/html; charset=UTF-8'];
	$reply_to = '';

	if ($form_type === 'canal_denuncia') {
		$to = ['gabrielasilveira@novabairrosplanejados.com.br', 'rodrigooliveira@novabairrosplanejados.com.br'];
		$subject = 'Canal de Denúncia - Nova Bairros';

		$identificar = sanitize_text_field($_POST['identificar']);
		$nome = sanitize_text_field($_POST['nome']);
		$email = sanitize_email($_POST['email']);
		$tipo_relato = sanitize_text_field($_POST['tipo_relato']);
		$local_relato = sanitize_text_field($_POST['local_relato']);
		$descricao = sanitize_textarea_field($_POST['descricao']);

		if ($email) {
			$reply_to = $email;
		}

		$body = "<h2>Novo Relato - Canal de Denúncia</h2>";
		if ($identificar === 'sim') {
			$body .= "<p><strong>Nome:</strong> {$nome}</p>";
			$body .= "<p><strong>E-mail:</strong> {$email}</p>";
		} else {
			$body .= "<p><strong>Identificação:</strong> Anônimo</p>";
		}
		$body .= "<p><strong>Tipo de Relato:</strong> {$tipo_relato}</p>";
		$body .= "<p><strong>Local do Relato:</strong> {$local_relato}</p>";
		$body .= "<p><strong>Descrição:</strong><br/>" . nl2br($descricao) . "</p>";
	} elseif ($form_type === 'sobre') {
		$to = ['josejunior@novabairrosplanejados.com.br', 'rodrigodiniz@novabairrosplanejados.com.br'];
		// $to = ['edujoseph@gmail.com'];
		$subject = 'Novos Negócios - Nova Bairros';

		$nome = sanitize_text_field($_POST['nome']);
		$telefone = sanitize_text_field($_POST['telefone']);
		$email = sanitize_email($_POST['email']);
		$estado = sanitize_text_field($_POST['estado']);
		$cidade = sanitize_text_field($_POST['cidade']);

		if ($email) {
			$reply_to = $email;
		}

		$body = "<h2>Contato - Novos Negócios</h2>";
		$body .= "<p><strong>Nome:</strong> {$nome}</p>";
		$body .= "<p><strong>Telefone:</strong> {$telefone}</p>";
		$body .= "<p><strong>E-mail:</strong> {$email}</p>";
		$body .= "<p><strong>Estado:</strong> {$estado}</p>";
		$body .= "<p><strong>Cidade:</strong> {$cidade}</p>";
	} elseif ($form_type === 'contato') {
		$to = 'sac@novabairrosplanejados.com.br';
		$subject = 'Fale Conosco - Nova Bairros';

		$nome = sanitize_text_field($_POST['nome']);
		$email = sanitize_email($_POST['email']);
		$mensagem = sanitize_textarea_field($_POST['mensagem']);

		if ($email) {
			$reply_to = $email;
		}

		$body = "<h2>Fale Conosco</h2>";
		$body .= "<p><strong>Nome:</strong> {$nome}</p>";
		$body .= "<p><strong>E-mail:</strong> {$email}</p>";
		$body .= "<p><strong>Mensagem:</strong><br/>" . nl2br($mensagem) . "</p>";
	} else {
		wp_send_json_error(['message' => 'Tipo de formulário inválido.']);
	}

	if (!empty($reply_to)) {
		$headers[] = "Reply-To: {$reply_to}";
	}

	$sent = wp_mail($to, $subject, $body, $headers, $attachments);

	if (!empty($temp_file) && file_exists($temp_file)) {
		unlink($temp_file);
	}

	if ($sent) {
		wp_send_json_success(['message' => 'Sua mensagem foi enviada com sucesso! Obrigado pelo contato.']);
	} else {
		wp_send_json_error(['message' => 'Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.']);
	}
}
