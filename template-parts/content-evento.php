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
		echo '<a href="' . esc_url(get_permalink()) . '">';
		get_template_part('template-parts/featured-image');
		echo '</a>';
	}

	if (is_singular()) {
		the_title('<h1 class="entry-title">', '</h1>');
	} else {
		the_title('<h2 class="entry-title heading-size-1"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>');
	}

	?>
	<div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">

		<div class="entry-content">

			<?php
			$terms = get_the_terms(get_the_ID(), 'tipo_evento');

			if ($terms && !is_wp_error($terms)) :

				$term_links = array();

				foreach ($terms as $term) {
					$term_links[] = '<li class="cat"><a href="' . esc_attr(get_term_link($term->slug, 'tipo_evento')) . '">' . __($term->name) . '</a></li>';
				}

				$all_terms = join('', $term_links);

				echo '<ul class="evento-cats terms-' . esc_attr($term->slug) . '">' . __($all_terms) . '</ul>';

			endif;

			$fechai = get_field('fecha_inicio');
			$fechaf = get_field('fecha_final');
			echo '<div class="fecha">';
			if ($fechai) {
				$inicio = strtotime($fechai);
				
				if ($fechaf) {
					echo date_i18n("d F", $inicio);
				} else {
					echo date_i18n("d F, Y", $inicio);
				}
				
			}

			if ($fechaf) {
				$final = strtotime($fechaf);
				echo ' - ' . date_i18n("d F, Y", $final);
			}
			echo '</div>';



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