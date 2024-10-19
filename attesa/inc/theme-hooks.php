<?php
/**
 * Register all Attesa Theme hooks
 *
 * If you are a developer, check out the theme hooks and their location in case you need to add custom code.
 *
 * @package Attesa
 */
 
/**
* Fire the wp_body_open action.
* Adds backward compatibility for WordPress versions < 5.2
*/
if ( ! function_exists( 'wp_body_open' ) ) {
    do_action( 'wp_body_open' );
}

/**
* Show the top bar
* DO NOT USE TO CUSTOMIZE
*/
function attesa_top_bar() {
	do_action( 'attesa_top_bar' );
}

/**
* Inside the top bar (left side)
*/
function attesa_inside_top_bar_left() {
	do_action( 'attesa_inside_top_bar_left' );
}

/**
* Inside the top bar (right side)
*/
function attesa_inside_top_bar_right() {
	do_action( 'attesa_inside_top_bar_right' );
}

/**
* Show the header
* DO NOT USE TO CUSTOMIZE
*/
function attesa_header() {
	do_action( 'attesa_header' );
}

/**
* Next to the header menu
*/
function attesa_header_next_to_menu() {
	do_action( 'attesa_header_next_to_menu' );
}

/**
* Show the featured image as a hero section (after <header>)
* DO NOT USE TO CUSTOMIZE
*/
function attesa_big_featured_image_style() {
	do_action( 'attesa_big_featured_image_style' );
}

/**
* Inside hero section for posts
*/
function attesa_inside_feat_box_post() {
	do_action( 'attesa_inside_feat_box_post' );
}

/**
* Inside hero section for pages
*/
function attesa_inside_feat_box_page() {
	do_action( 'attesa_inside_feat_box_page' );
}

/**
* Inside hero section for the main blog page (only if blog page is a static page, not front page)
*/
function attesa_inside_feat_box_blog() {
	do_action( 'attesa_inside_feat_box_blog' );
}

/**
* Inside hero section for the main WooCommerce shop page
*/
function attesa_inside_feat_box_shop_page() {
	do_action( 'attesa_inside_feat_box_shop_page' );
}

/**
* Creates custom hero section based on different post type than page/post/woocommerce shop page
*/
function attesa_additional_cases_big_featured_images() {
	do_action( 'attesa_additional_cases_big_featured_images' );
}

/**
* Before <div class="attesa-content-container"> site content
*/
function attesa_before_site_content() {
	do_action( 'attesa_before_site_content' );
}

/**
* After <div class="attesa-content-container"> site content
*/
function attesa_after_site_content() {
	do_action( 'attesa_after_site_content' );
}

/**
* Show posts navigation
* DO NOT USE TO CUSTOMIZE
*/
function attesa_posts_navigation() {
	do_action( 'attesa_posts_navigation' );
}

/**
* After <article> single post content
*/
function attesa_after_single_post_content() {
	do_action( 'attesa_after_single_post_content' );
}

/**
* After <article> single page content
*/
function attesa_after_single_page_content() {
	do_action( 'attesa_after_single_page_content' );
}

/**
* Show entry header
* DO NOT USE TO CUSTOMIZE
*/
function attesa_entry_header() {
	do_action( 'attesa_entry_header' );
}

/**
* Inside post meta (date, author, comments) start  
*/
function attesa_before_posted_on() {
	do_action( 'attesa_before_posted_on' );
}

/**
* Inside post meta (date, author, comments) end  
*/
function attesa_after_posted_on() {
	do_action( 'attesa_after_posted_on' );
}

/**
* Inside footer meta (categories, tags) start  
*/
function attesa_before_entry_footer() {
	do_action( 'attesa_before_entry_footer' );
}

/**
* Inside footer meta (categories, tags) end  
*/
function attesa_after_entry_footer() {
	do_action( 'attesa_after_entry_footer' );
}

/**
* Before post content (after <article> opening tag)
*/
function attesa_before_post_content() {
	do_action( 'attesa_before_post_content' );
}

/**
* After post content (before </article> closing tag)
*/
function attesa_after_post_content() {
	do_action( 'attesa_after_post_content' );
}

/**
* Before page content (after <article> opening tag)
*/
function attesa_before_page_content() {
	do_action( 'attesa_before_page_content' );
}

/**
* After page content (after </article> closing tag)
*/
function attesa_after_page_content() {
	do_action( 'attesa_after_page_content' );
}

/**
* Before footer section (after <footer> opening tag)
*/
function attesa_before_footer_section() {
	do_action( 'attesa_before_footer_section' );
}

/**
* Before footer widgets (after <attesaFooterWidget> opening tag)
*/
function attesa_before_footer_widgets() {
	do_action( 'attesa_before_footer_widgets' );
}

/**
* After footer widgets (before </attesaFooterWidget> closing tag)
*/
function attesa_after_footer_widgets() {
	do_action( 'attesa_after_footer_widgets' );
}

/**
* Show the footer credits
* DO NOT USE TO CUSTOMIZE
*/
function attesa_footer_credits() {
	do_action( 'attesa_footer_credits' );
}

/**
* After social widgets in the footer
*/
function attesa_after_social_footer() {
	do_action( 'attesa_after_social_footer' );
}

/**
* Show the footer widgets area
* DO NOT USE TO CUSTOMIZE
*/
function attesa_footer_widgets() {
	do_action( 'attesa_footer_widgets' );
}

/**
* Show the sub-footer area
* DO NOT USE TO CUSTOMIZE
*/
function attesa_sub_footer() {
	do_action( 'attesa_sub_footer' );
}

/**
* Before closing the entire footer area (before </footer-bottom-area> closing tag)
*/
function attesa_after_last_bottom_area() {
	do_action( 'attesa_after_last_bottom_area' );
}

/**
* 404 page before the paragraph
*/
function attesa_filter_before_text_404() {
	do_action( 'attesa_filter_before_text_404' );
}

/**
* 404 page after the paragraph
*/
function attesa_filter_after_text_404() {
	do_action( 'attesa_filter_after_text_404' );
}

/**
* Before archive header (before <header class="page-header"> opening tag)
*/
function attesa_before_archive_header() {
	do_action( 'attesa_before_archive_header' );
}

/**
* After archive header (after <header class="page-header"> closing tag)
*/
function attesa_after_archive_header() {
	do_action( 'attesa_after_archive_header' );
}

/**
* Inside archive header before archive title and description
*/
function attesa_before_archive_inside_header() {
	do_action( 'attesa_before_archive_inside_header' );
}

/**
* Inside archive header after archive title and description
*/
function attesa_after_archive_inside_header() {
	do_action( 'attesa_after_archive_inside_header' );
}

/**
* Before the first widget in the classic sidebar
*/
function attesa_before_classic_sidebar() {
	do_action( 'attesa_before_classic_sidebar' );
}

/**
* After the last widget in the classic sidebar
*/
function attesa_after_classic_sidebar() {
	do_action( 'attesa_after_classic_sidebar' );
}

/**
* Before the first widget in the push sidebar
*/
function attesa_before_push_sidebar() {
	do_action( 'attesa_before_push_sidebar' );
}

/**
* After the last widget in the push sidebar
*/
function attesa_after_push_sidebar() {
	do_action( 'attesa_after_push_sidebar' );
}

/**
* Before the WooCommerce mini cart
*/
function attesa_before_woo_mini_cart() {
	do_action( 'attesa_before_woo_mini_cart' );
}

/**
* After the WooCommerce mini cart
*/
function attesa_after_woo_mini_cart() {
	do_action( 'attesa_after_woo_mini_cart' );
}