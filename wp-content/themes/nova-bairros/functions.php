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

	wp_enqueue_style('estilo-global', $css_uri . 'style.css');
	wp_enqueue_style('tailwind', $css_uri . 'tailwind.css');

	$estilos_enfileirados = [];

	// Página: carrega slug.css
	if (is_page()) {
		$slug = get_post_field('post_name', get_the_ID());
		$slug_file = $css_dir . $slug . '.css';
		if (file_exists($slug_file)) {
			wp_enqueue_style('estilo-' . $slug, $css_uri . $slug . '.css');
			$estilos_enfileirados[] = $slug;
		}
	}

	// Singular (post, produto, etc.): carrega tipo.css
	if (is_singular()) {
		$post_type = get_post_type();
		$type_file = $css_dir . $post_type . '.css';
		if (file_exists($type_file)) {
			wp_enqueue_style('estilo-' . $post_type, $css_uri . $post_type . '.css');
			$estilos_enfileirados[] = $post_type;
		}
	}

	// Home
	if (is_front_page() || is_home()) {
		$home_file = $css_dir . 'home.css';
		if (file_exists($home_file)) {
			wp_enqueue_style('estilo-home', $css_uri . 'home.css');
			$estilos_enfileirados[] = 'home';
		}
	}

	// Arquivo
	if (is_archive() && file_exists($css_dir . 'archive.css')) {
		wp_enqueue_style('estilo-archive', $css_uri . 'archive.css');
		$estilos_enfileirados[] = 'archive';
	}

	// Busca
	if (is_search() && file_exists($css_dir . 'search.css')) {
		wp_enqueue_style('estilo-search', $css_uri . 'search.css');
		$estilos_enfileirados[] = 'search';
	}

	// 404
	if (is_404() && file_exists($css_dir . '404.css')) {
		wp_enqueue_style('estilo-404', $css_uri . '404.css');
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
