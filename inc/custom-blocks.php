<?php


function oeg_register_acf_block_types()
{
    // Register testimonials block
    acf_register_block_type([
        'name'            => 'oeg-testimonial-slider',
        'title'           => __('Slider Testimonios UNED'),
        'description'     => __('Un bloque con citas de testimonios.'),
        'render_template' => '/assets/blocks/testimonial-slider.php',
        'enqueue_script'    => CHILD_DIR . '/assets/js/slider.js',
        'mode'            => 'edit',
        'category'        => 'design',
        'icon'            => 'format-quote',
    ]);

    // Register People Gallery Block
    acf_register_block_type([
        'name'            => 'oeg-people-grid',
        'title'           => __('Cuadrícula de personas'),
        'description'     => __('Un bloque de personas.'),
        'render_template' => '/assets/blocks/oeg-people.php',
        'category'        => 'design',
        'icon'            => 'buddicons-buddypress-logo',
        'mode'            => 'edit',
    ]);
}

// Check function exists.
if (function_exists('acf_register_block_type')) {
    add_action('acf/init', 'oeg_register_acf_block_types');
}


include_once(get_stylesheet_directory() . '/assets/blocks/fields.php');
