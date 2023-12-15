<?php

/**
 * Header file for the Twenty Twenty WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
	wp_body_open();

	if (!is_page_template( get_template_directory_uri() . 'templates/template-cover.php' )) {
		// On the cover page template, output the cover header.
		$color_overlay_style   = '';
		$color_overlay_classes = '';

		// Get the color used for the color overlay.
		$color_overlay_color = get_theme_mod('cover_template_overlay_background_color');
		if ($color_overlay_color) {
			$color_overlay_style = ' style="color: ' . esc_attr($color_overlay_color) . ';"';
		} else {
			$color_overlay_style = '';
		}

		// Get the opacity of the color overlay.
		$color_overlay_opacity  = get_theme_mod('cover_template_overlay_opacity');
		$color_overlay_opacity  = (false === $color_overlay_opacity) ? 80 : $color_overlay_opacity;
		$color_overlay_classes .= ' opacity-' . $color_overlay_opacity;

	}

	?>

	<?php
	if (!is_front_page() && !is_page_template('templates/template-cover.php')) {
		$frontpage_id = get_option('page_on_front');
		$image = get_the_post_thumbnail_url($frontpage_id, 'full');
	}
	?>

	<header id="site-header" class="header-footer-group" <?php if (!is_front_page()) : ?> style="background-image:url(<?php echo $image; ?>);" <?php endif; ?>>
		<!-- Menu institucional 2023 -->
		<div class="contenedor_cintillo">
		<div class="cintillo">
			<div class="cintillo-svg"><a href="https://www.uned.ac.cr/" target="_blank"><img src="<?php echo CHILD_DIR; ?>/img/uned_cintillo.svg" alt="UNED" border="0"></a></div>
			<div class="cintillo-tx"><a href="https://www.uned.ac.cr/" target="_blank">Universidad Estatal a Distancia, Costa Rica</a></div>
		</div>
		</div><!-- Menu institucional 2023 -->
		
		<div class="capacafe cover-color-overlay color-accent<?php echo esc_attr($color_overlay_classes); ?>" <?php echo $color_overlay_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;) 
																												?>></div>
		<div class="header-inner section-inner">

			<div class="header-titles-wrapper">

				<?php

				// Check whether the header search is activated in the customizer.
				$enable_header_search = get_theme_mod('enable_header_search', true);

				if (true === $enable_header_search) {

				?>

					<button class="toggle search-toggle mobile-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
						<span class="toggle-inner">
							<span class="toggle-icon">
								<?php twentytwenty_the_theme_svg('search'); ?>
							</span>
							<span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
						</span>
					</button><!-- .search-toggle -->

				<?php } ?>

				<div class="header-titles">


					<?php if (is_front_page()) : ?>

						<div class="logo-home flag wave">
							<?php if (wp_is_mobile()) : ?>
								<img src="<?= CHILD_DIR; ?>/img/cjs_logo_casa_sm.svg" class="logo-svg" alt="Logo del sitio de <?php bloginfo('name'); ?>">
							<?php else : ?>
								<img src="<?= CHILD_DIR; ?>/img/cjs_logo_casa_blanco.svg" class="logo-svg" alt="Logo del sitio de <?php bloginfo('name'); ?>">
							<?php endif; ?>
						</div>

					<?php else : ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-home" title="<?php bloginfo('name'); ?>">
							<?php if (wp_is_mobile()) : ?>
								<img src="<?= CHILD_DIR; ?>/img/cjs_logo_casa_sm.svg" class="logo-svg" alt="Logo del sitio de <?php bloginfo('name'); ?>">
							<?php else : ?>
								<img src="<?= CHILD_DIR; ?>/img/cjs_logo_casa_blanco.svg" class="logo-svg" alt="Logo del sitio de <?php bloginfo('name'); ?>">
							<?php endif; ?>
						</a>
					<?php endif; ?>
					<div class="hidden">
						<h1><a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link" title="<?php bloginfo('name'); ?>"><?php esc_html(bloginfo('title')); ?></a></h1>
						<p><?php esc_html(bloginfo('description')); ?></p>
					</div>
				</div><!-- .header-titles -->

				<button class="toggle nav-toggle mobile-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
					<span class="toggle-inner">
						<span class="toggle-icon">
							<?php twentytwenty_the_theme_svg('ellipsis'); ?>
						</span>
						<span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
					</span>
				</button><!-- .nav-toggle -->

			</div><!-- .header-titles-wrapper -->

			<div class="header-navigation-wrapper">

				<?php
				if (has_nav_menu('primary') || !has_nav_menu('expanded')) {
				?>

					<nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Horizontal', 'menu', 'twentytwenty'); ?>">

						<ul class="primary-menu reset-list-style">

							<?php
							if (has_nav_menu('primary')) {

								wp_nav_menu(
									array(
										'container'  => '',
										'items_wrap' => '%3$s',
										'theme_location' => 'primary',
									)
								);
							} elseif (!has_nav_menu('expanded')) {

								wp_list_pages(
									array(
										'match_menu_classes' => true,
										'show_sub_menu_icons' => true,
										'title_li' => false,
										'walker'   => new TwentyTwenty_Walker_Page(),
									)
								);
							}
							?>

						</ul>

					</nav><!-- .primary-menu-wrapper -->

				<?php
				}

				if (true === $enable_header_search || has_nav_menu('expanded')) {
				?>

					<div class="header-toggles hide-no-js">

						<?php
						if (has_nav_menu('expanded')) {
						?>

							<div class="toggle-wrapper nav-toggle-wrapper has-expanded-menu">

								<button class="toggle nav-toggle desktop-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
									<span class="toggle-inner">
										<span class="toggle-text"><?php _e('Menu', 'twentytwenty'); ?></span>
										<span class="toggle-icon">
											<?php twentytwenty_the_theme_svg('ellipsis'); ?>
										</span>
									</span>
								</button><!-- .nav-toggle -->

							</div><!-- .nav-toggle-wrapper -->

						<?php
						}

						if (true === $enable_header_search) {
						?>

							<div class="toggle-wrapper search-toggle-wrapper">

								<button class="toggle search-toggle desktop-search-toggle" data-toggle-target=".search-modal" data-toggle-body-class="showing-search-modal" data-set-focus=".search-modal .search-field" aria-expanded="false">
									<span class="toggle-inner">
										<?php twentytwenty_the_theme_svg('search'); ?>
										<span class="toggle-text"><?php _ex('Search', 'toggle text', 'twentytwenty'); ?></span>
									</span>
								</button><!-- .search-toggle -->

							</div>

						<?php
						}
						?>

					</div><!-- .header-toggles -->
				<?php
				}
				?>

			</div><!-- .header-navigation-wrapper -->

		</div><!-- .header-inner -->

		<?php
		// Output the search modal (if it is activated in the customizer).
		if (true === $enable_header_search) {
			get_template_part('template-parts/modal-search');
		}
		?>

	</header><!-- #site-header -->

	<?php
	// Output the menu modal.
	get_template_part('template-parts/modal-menu');
