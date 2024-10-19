<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Attesa
 */
if ( ! is_active_sidebar( attesa_get_classic_sidebar() ) || ! attesa_check_bar('classic') ) {
	return;
}
?>

<aside id="secondary" class="widget-area" <?php attesa_schema_markup('sidebar'); ?>>
	<div class="sidebar-container">
		<?php attesa_before_classic_sidebar(); ?>
		<?php dynamic_sidebar( attesa_get_classic_sidebar() ); ?>
		<?php attesa_after_classic_sidebar(); ?>
	</div>
</aside><!-- #secondary -->
