<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Attesa
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) : ?>
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php echo apply_filters('attesa_filter_custom_title_404', esc_html__( 'Oops! That page can&rsquo;t be found.', 'attesa' )); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
					
						<?php attesa_filter_before_text_404(); ?>
						
						<p class="errorDesc"><?php echo apply_filters('attesa_filter_custom_text_404', esc_html__( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'attesa' )); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

						<?php attesa_filter_after_text_404(); ?>

						<?php
						if (attesa_404_show_search_form()) {
							get_search_form();
						}
						if (attesa_404_show_recent_posts()) {
							the_widget( 'WP_Widget_Recent_Posts' );
						}
						?>

						<?php
						if (attesa_404_show_archives()) {
							/* translators: %1$s: smiley */
							$attesa_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'attesa' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$attesa_archive_content" );
						}
						if(attesa_404_show_tags()) {
							the_widget( 'WP_Widget_Tag_Cloud' );
						}
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
