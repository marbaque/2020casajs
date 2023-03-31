<?php

/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	if (!is_search()) {
		get_template_part('template-parts/featured-image');
	}

	if ( is_singular() ) {
		the_title( '<h1 class="entry-title">', '</h1>' );
	} else {
		the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
	}
	
	?>
	<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php 
			$terms = get_terms('tipo_evento', $post->ID );
			echo '<ul class="evento-cats">';
			foreach ($terms as $term) {
				//Always check if it's an error before continuing. get_term_link() can be finicky sometimes
				$term_link = get_term_link( $term, 'tipo_evento' );
				if( is_wp_error( $term_link ) )
					continue;
				//We successfully got a link. Print it out.
		
		
				echo '<li class="cat"><a href="' . $term_link . '">' . $term->name . '</a></li>';
			}
			echo '</ul>';
			

			if (get_field('fecha_inicio', $post->ID)) {
				the_field('fecha_inicio', $post->ID);
			}

			if (get_field('fecha_inicio', $post->ID)) {
				the_field('fecha_inicio', $post->ID);
			}

			if (is_search() || !is_singular()) {

				if (get_field('resumen', $post->ID)) {
					the_field('resumen', $post->ID);
				} else {
					the_excerpt();
				}

				echo '<div class="wp-block-button is-style-outline"><a href="' . esc_url(get_permalink()) . '" class="wp-block-button__link">Ver más</a></div>';
			} else {
				the_content(__('Continue reading', 'twentytwenty'));
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

</article><!-- .post -->