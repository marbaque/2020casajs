<?php

define('CHILD_DIR', get_stylesheet_directory_uri());

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
        $theme->get('1.2.5') // this only works if you have Version in the style header
    );
}

// Add Colors to the Default Core Color Palette
function twentytwentycasajs_setup() {

	// Block Editor Palette.
	$editor_color_palette = array(
        array(
			'name'  => __( 'Café principal', 'twentytwentycasajs' ),
			'slug'  => 'cafe',
			'color' => '#6d3137',
		),
        array(
			'name'  => __( 'Café colorado', 'twentytwentycasajs' ),
			'slug'  => 'cafemaduro',
			'color' => '#8d2942',
		),
        array(
			'name'  => __( 'Café oscuro', 'twentytwentycasajs' ),
			'slug'  => 'cafenegro',
			'color' => '#412126',
		),
        array(
			'name'  => __( 'Crema', 'twentytwentycasajs' ),
			'slug'  => 'cremita',
			'color' => '#f5efe1',
		),
        array(
			'name'  => __( 'Verde', 'twentytwentycasajs' ),
			'slug'  => 'turquesa',
			'color' => '#45818e',
		),
        array(
			'name'  => __( 'Dorado', 'twentytwentycasajs' ),
			'slug'  => 'doradito',
			'color' => '#d6c3a5',
		),
        array(
			'name'  => __( 'Blanco', 'twentytwentycasajs' ),
			'slug'  => 'blanco',
			'color' => '#fff',
		),
        array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
        array(
			'name'  => _x( 'Primary', 'color', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => _x( 'Secondary', 'color', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}
 
    add_theme_support( 'disable-custom-colors' );
}
add_action( 'after_setup_theme', 'twentytwentycasajs_setup', 50 );

/* enqueue styles for gutenberg editor */   
function legit_block_editor_styles() {
    wp_enqueue_style('legit-editor-styles', get_theme_file_uri( '/assets/css/editor-style.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );





/**
 * Custom Blocks
 */
require (get_stylesheet_directory() . '/inc/custom-blocks.php');



require 'assets/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/marbaque/twentytwentycasajs',
    __FILE__, //Full path to the main plugin file or functions.php.
    'twentytwentycasajs'
);
$myUpdateChecker->setBranch('main');
