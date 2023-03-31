<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php

	$archive_subtitle = '';

	$archive_subtitle = get_the_archive_description();

	?>

	<header class="archive-header has-text-align-center header-footer-group">

		<div class="archive-header-inner section-inner medium">

			<h1 class="archive-title">Eventos</h1>


			<?php if ($archive_subtitle) { ?>
				<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post(wpautop($archive_subtitle)); ?></div>
			<?php } ?>

		</div><!-- .archive-header-inner -->

	</header><!-- .archive-header -->

	<?php

	if (have_posts()) {

	?>
		<h2 class="eventos-title">Eventos próximos</h2>

		<div class="programacion futuro">
			<?php

			$date_args = array(
				'posts_per_page'    => -1,
				'post_type'         => 'evento',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'meta_query' => array(
					array(
						'key' => 'fecha_inicio',
						'compare' => '>=',
						'value' => date("Y-m-d"),
						'type' => 'DATE'
					)
				),
			);

			$date_query = new WP_Query($date_args);

			// The Loop
			if ( $date_query->have_posts() ) {
				while ( $date_query->have_posts() ) {
					$date_query->the_post();
					get_template_part('template-parts/content', get_post_type());
				}
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();

			?>

		</div> <!-- programación -->

		<h2 class="eventos-title">Eventos pasados</h2>

		<div class="programacion pasado">
			<?php

			$date_args2 = array(
				'posts_per_page'    => -1,
				'post_type'         => 'evento',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'meta_query' => array(
					array(
						'key' => 'fecha_inicio',
						'compare' => '<',
						'value' => date("Y-m-d"),
						'type' => 'DATE'
					)
				),
			);

			$date_query2 = new WP_Query($date_args2);


			// The Loop
			if ($date_query2->have_posts()) {
				while ($date_query2->have_posts()) {
					$date_query2->the_post();
					get_template_part('template-parts/content', get_post_type());
				}
			} else {
				// no posts found
				echo 'No se encontraron eventos pasados.';
			}
			/* Restore original Post Data */
			wp_reset_postdata();


			?>


		</div> <!-- programación -->


	<?php
	} ?>

	<?php get_template_part('template-parts/pagination'); ?>


</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
