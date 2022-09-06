<?php

define('CHILD_DIR', get_stylesheet_directory_uri());

/**
 * Register custom fonts.
 */
function child_fonts_url()
{
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Nunito Sans and EB+Garamond, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$sansSerif = _x('on', 'Nunito+Sans font: on or off', 'twentytwentycasajs');
	$serif = _x('on', 'EB+Garamond: on or off', 'twentytwentycasajs');

	$font_families = array();

	if ('off' !== $sansSerif) {
		$font_families[] = 'Nunito Sans:400,400i,700,700i';
	}

	if ('off' !== $serif) {
		$font_families[] = 'EB Garamond:400,400i,700,700i';
	}


	if (in_array('on', array($sansSerif, $serif))) {

		$query_args = array(
			'family' => urlencode(implode('|', $font_families)),
			'subset' => urlencode('latin,latin-ext'),
		);

		$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
	}

	return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function child_resource_hints($urls, $relation_type)
{
	if (wp_style_is('twentytwentycasajs-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'child_resource_hints', 10, 2);


// Enque child theme style and scripts
add_action('wp_enqueue_scripts', 'twenty_child_enqueue_styles');
function twenty_child_enqueue_styles()
{
	$parenthandle = 'twentytwenty'; // This is 'twentytwenty' for the Twenty Twenty theme.
	$theme = wp_get_theme();
	wp_enqueue_style(
		$parenthandle,
		get_template_directory_uri() . '/style.css',
		array(),  // if the parent theme code has a dependency, copy it to here
		$theme->parent()->get('Version')
	);
	wp_enqueue_style(
		'child-style',
		get_stylesheet_uri(),
		array($parenthandle),
		$theme->get('1.3.6') // this only works if you have Version in the style header
	);
	wp_enqueue_style('twentytwentycasajs-google-fonts', child_fonts_url());

	// GLightbox stylesheet
	wp_enqueue_style('glightbox', get_stylesheet_directory_uri() .
		'/assets/css/glightbox.css');

	// GLightbox JS
	wp_enqueue_script('glightbox', get_stylesheet_directory_uri() .
		'/assets/js/glightbox.min.js', '', '', true);

	// Main.js file
	wp_enqueue_script('twentytwentycasajs', get_stylesheet_directory_uri() .
		'/assets/js/glightbox-init.js', '', '', true);
}

/**
 *  Adjuntar una clase a los links padres de imágenes ernlazadas
 *  Funciona para los contenidos existentes
 */
add_filter('the_content', 'glightbox_class');
function glightbox_class($content)
{
	global $post;
	$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1 class="lightbox" href=$2$3.$4$5$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

// Add Colors to the Default Core Color Palette
function twentytwentycasajs_setup()
{

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __('Café principal', 'twentytwentycasajs'),
			'slug'  => 'cafe',
			'color' => '#6d3137',
		),
		array(
			'name'  => __('Café colorado', 'twentytwentycasajs'),
			'slug'  => 'cafemaduro',
			'color' => '#8d2942',
		),
		array(
			'name'  => __('Café oscuro', 'twentytwentycasajs'),
			'slug'  => 'cafenegro',
			'color' => '#412126',
		),
		array(
			'name'  => __('Crema', 'twentytwentycasajs'),
			'slug'  => 'cremita',
			'color' => '#f5efe1',
		),
		array(
			'name'  => __('Verde', 'twentytwentycasajs'),
			'slug'  => 'turquesa',
			'color' => '#45818e',
		),
		array(
			'name'  => __('Dorado', 'twentytwentycasajs'),
			'slug'  => 'doradito',
			'color' => '#d6c3a5',
		),
		array(
			'name'  => __('Blanco', 'twentytwentycasajs'),
			'slug'  => 'blanco',
			'color' => '#fff',
		),
		array(
			'name'  => __('Accent Color', 'twentytwenty'),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area('content', 'accent'),
		),
		array(
			'name'  => _x('Primary', 'color', 'twentytwenty'),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area('content', 'text'),
		),
		array(
			'name'  => _x('Secondary', 'color', 'twentytwenty'),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area('content', 'secondary'),
		),
		array(
			'name'  => __('Subtle Background', 'twentytwenty'),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area('content', 'borders'),
		),
	);

	// If we have accent colors, add them to the block editor palette.
	if ($editor_color_palette) {
		add_theme_support('editor-color-palette', $editor_color_palette);
	}

	add_theme_support('disable-custom-colors');
}
add_action('after_setup_theme', 'twentytwentycasajs_setup', 50);

/* enqueue styles for gutenberg editor */
function legit_block_editor_styles()
{
	wp_enqueue_style('legit-editor-styles', get_theme_file_uri('/assets/css/editor-style.css'), false, '1.0', 'all');
}
add_action('enqueue_block_editor_assets', 'legit_block_editor_styles');




/**
 * Custom Blocks
 */
require(get_stylesheet_directory() . '/inc/custom-blocks.php');

/**
 * Custom CSS file that overrides the default H5P CSS
 */

function casajs_alter_styles(&$styles, $libraries, $embed_type) {
	$styles[] = (object) array(
	  // Path must be relative to wp-content/uploads/h5p or absolute.
	  'path' => get_stylesheet_directory_uri() . '/assets/css/custom-h5p.css',
	  'version' => '?ver=0.1' // Cache buster
	);
  }
  add_action('h5p_alter_library_styles', 'casajs_alter_styles', 10, 3);



require 'assets/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/marbaque/twentytwentycasajs',
	__FILE__, //Full path to the main plugin file or functions.php.
	'twentytwentycasajs'
);
$myUpdateChecker->setBranch('main');
