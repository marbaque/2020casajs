<?php

function cptui_register_my_cpts() {

/**
 * Post Type: Eventos.
 */

$labels = [
    "name" => esc_html__( "Eventos", "twentytwentycasajs" ),
    "singular_name" => esc_html__( "Evento", "twentytwentycasajs" ),
    "menu_name" => esc_html__( "Eventos", "twentytwentycasajs" ),
    "all_items" => esc_html__( "Todos los eventos", "twentytwentycasajs" ),
    "add_new" => esc_html__( "Crear nuevo", "twentytwentycasajs" ),
    "add_new_item" => esc_html__( "Crear nuevo evento", "twentytwentycasajs" ),
    "edit_item" => esc_html__( "Editar evento", "twentytwentycasajs" ),
    "new_item" => esc_html__( "Evento nuevo", "twentytwentycasajs" ),
    "view_item" => esc_html__( "Ver evento", "twentytwentycasajs" ),
    "view_items" => esc_html__( "Ver eventos", "twentytwentycasajs" ),
    "search_items" => esc_html__( "Buscar evento", "twentytwentycasajs" ),
];

$args = [
    "label" => esc_html__( "Eventos", "twentytwentycasajs" ),
    "labels" => $labels,
    "description" => "Exposiciones de obras de arte temporales y eventos culturales diversos, como conciertos, presentación de libros, cuenta cuentos, u otros.",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => false,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "rest_namespace" => "wp/v2",
    "has_archive" => "eventos",
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "can_export" => true,
    "rewrite" => [ "slug" => "evento", "with_front" => true ],
    "query_var" => true,
    "menu_position" => 2,
    "menu_icon" => "dashicons-calendar-alt",
    "supports" => [ "title", "editor", "thumbnail" ],
    "taxonomies" => [ "tipo_evento" ],
    "show_in_graphql" => false,
];

register_post_type( "evento", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Tipos de evento.
	 */

	$labels = [
		"name" => esc_html__( "Tipos de evento", "twentytwentycasajs" ),
		"singular_name" => esc_html__( "Tipo de evento", "twentytwentycasajs" ),
		"menu_name" => esc_html__( "Tipos de evento", "twentytwentycasajs" ),
		"all_items" => esc_html__( "Todos los tipos", "twentytwentycasajs" ),
		"edit_item" => esc_html__( "Editar tipo", "twentytwentycasajs" ),
		"view_item" => esc_html__( "Ver tipo", "twentytwentycasajs" ),
		"update_item" => esc_html__( "Actualizar tipo", "twentytwentycasajs" ),
		"add_new_item" => esc_html__( "Añadir tipo", "twentytwentycasajs" ),
		"new_item_name" => esc_html__( "Nombre del tipo nuevo", "twentytwentycasajs" ),
		"parent_item" => esc_html__( "Tipo superior", "twentytwentycasajs" ),
		"parent_item_colon" => esc_html__( "Tipo superior:", "twentytwentycasajs" ),
		"search_items" => esc_html__( "Buscar tipos", "twentytwentycasajs" ),
		"popular_items" => esc_html__( "Tipos populares", "twentytwentycasajs" ),
		"separate_items_with_commas" => esc_html__( "Separar tipos por comas", "twentytwentycasajs" ),
		"add_or_remove_items" => esc_html__( "Añadir o eliminar tipos", "twentytwentycasajs" ),
		"choose_from_most_used" => esc_html__( "Elija los tipos más utilizados", "twentytwentycasajs" ),
		"not_found" => esc_html__( "No se encontraron tipos", "twentytwentycasajs" ),
		"no_terms" => esc_html__( "No hay tipos de actividad", "twentytwentycasajs" ),
		"items_list_navigation" => esc_html__( "Navegación de tipos", "twentytwentycasajs" ),
		"items_list" => esc_html__( "Listado de tipos", "twentytwentycasajs" ),
		"back_to_items" => esc_html__( "Regresar a los tipos", "twentytwentycasajs" ),
	];

	
	$args = [
		"label" => esc_html__( "Tipos de evento", "twentytwentycasajs" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => false,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'tipo_evento', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "tipo_evento",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "tipo_evento", [ "evento" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
