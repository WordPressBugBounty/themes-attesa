<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Attesa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php attesa_before_post_content(); ?>
	<?php $attesa_featImagePosts = apply_filters( 'attesa_post_featured_image_style', attesa_options('_featimage_style_posts', 'content') ); ?>
	<header class="entry-header">
		<?php attesa_entry_header(); ?>
	</header><!-- .entry-header -->
	<?php
		if ('post' === get_post_type() && $attesa_featImagePosts == 'content') {
			attesa_post_thumbnail();
		} elseif('post' !== get_post_type()) {
			attesa_post_thumbnail();
		}
	?>

	<div class="entry-content" <?php attesa_schema_markup('text'); ?>>
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'attesa' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span class="page-links-number">',
			'link_after'  => '</span>'
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php attesa_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php attesa_after_post_content(); ?>
</article><!-- #post-<?php the_ID(); ?> -->
