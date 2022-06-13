<?php

/**
 * Displays the content when the cover template is used.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php
	if (wp_is_mobile()) {
		$imgSize = 'medium';
	} else {
		$imgSize = 'large';
	}
	?>

	<div class="cover-header" <?php
								if (has_post_thumbnail()) {
									echo 'style="background-image: url(' . get_the_post_thumbnail_url($post->ID, $imgSize) . ');"';
								}
								?>>
		<div class="capacafe"></div>
		<div class="cover-header-inner-wrapper screen-height">
			<div class="cover-header-inner">

				<header class="entry-header has-text-align-center">
					<div class="entry-header-inner section-inner medium">

						<h1 class="entry-title"><?php esc_html(bloginfo('title')); ?></h1>
						<h2 class="entry-subtitle"><?php esc_html(bloginfo('description')); ?></h2>
						<div class="ornamento" aria-hidden="true"></div>

					</div><!-- .entry-header-inner -->
				</header><!-- .entry-header -->

			</div><!-- .cover-header-inner -->
		</div><!-- .cover-header-inner-wrapper -->
	</div><!-- .cover-header -->

	<div class="post-inner" id="post-inner">

		<div class="entry-content">

			<?php
			the_content();
			?>

		</div><!-- .entry-content -->
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__('Page', 'twentytwenty') . '"><span class="label">' . __('Pages:', 'twentytwenty') . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();
		// Single bottom post meta.
		twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');

		if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {

			get_template_part('template-parts/entry-author-bio');
		}
		?>

	</div><!-- .post-inner -->

	<?php

	if (is_single()) {

		get_template_part('template-parts/navigation');
	}

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
	?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

	<?php
	}
	?>

</article><!-- .post -->