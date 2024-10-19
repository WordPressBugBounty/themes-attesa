<?php
/**
 * Attesa support for WooCommerce
 *
 * @package AttesaWP
 */
if ( ! class_exists( 'Attesa_WooCommerce' ) ) {

	class Attesa_WooCommerce {
		/**
		 * Main Class Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array($this, 'attesa_woocommerce_scripts') );
			add_action( 'attesa_custom_css_style_filter', array($this, 'attesa_woo_additional_css_code') , 999);
			add_action( 'after_setup_theme', array($this, 'attesa_woocommerce_support') );
			add_filter( 'woocommerce_add_to_cart_fragments', array($this, 'attesa_cart_count_fragments'), 10, 1 );
			add_filter( 'woocommerce_output_related_products_args', array($this, 'attesa_related_products_args') );
			add_action( 'woocommerce_single_product_summary', array($this, 'attesa_prev_next_product'), 6 );
			add_action( 'wp_footer', array($this, 'attesa_woocommerce_sticky_bar') );
			add_action( 'init', array($this, 'attesa_woocommerce_related_products') );
		}
		
		/* Dequeue default WooCommerce Layout */
		public static function attesa_woocommerce_scripts() {
			wp_dequeue_style ( 'woocommerce-layout' );
			wp_dequeue_style ( 'woocommerce-smallscreen' );
			wp_dequeue_style ( 'woocommerce-general' );
		}
		
		/* Additional custom CSS for WooCommerce */
		public static function attesa_woo_additional_css_code($attesa_custom_css) {
			$smalltext_font_size = attesa_options('_smalltext_font_size', '13px');
			if ($smalltext_font_size != '13px') {
				$attesa_custom_css .= '
					.woocommerce-error li a,
					.woocommerce-message a,
					.woocommerce ul.products>li .price del,
					.woocommerce div.product .summary .price del,
					.woocommerce #content .quantity,
					#payment .payment_methods li .payment_box p,
					.woocommerce .wooImage .button,
					.woocommerce .wooImage .added_to_cart,
					.woocommerce form .added_to_cart,
					.woocommerce-store-notice,
					.woocommerce ul.products li.product a.compare {
						font-size: '.esc_html($smalltext_font_size).';
					}
				';
			}
			$wooheadings_font_size = attesa_options('_wooheadings_font_size', '32px');
			if ($wooheadings_font_size != '32px') {
				$attesa_custom_css .= '
				.woocommerce .content-area .summary h1.entry-title,
				.woocommerce .related h2,
				.woocommerce .woocommerce-tabs .panel>h2,
				.woocommerce .woocommerce-tabs .panel .woocommerce-Reviews-title {
					font-size: '.esc_html($wooheadings_font_size).';
				}';
			}
			$borderRadius = apply_filters( 'attesa_elements_border_radius', attesa_options('_elements_border_radius', '5') );
			$attesa_custom_css .= '
				.woocommerce-pagination>ul.page-numbers li a,
				.woocommerce-pagination>ul.page-numbers li span,
				.widget.woocommerce.widget_product_search input[type="search"],
				.woocommerce #content form.cart .quantity input[type="number"],
				.widget.woocommerce.widget_product_search button,
				.woocommerce #content form.cart .button,
				.attesa_woocommerce_mini_cart ul.product_list_widget li img,
				.attesa_woo_cart_quantity_item .remove,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a,
				.woocommerce div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
				.woocommerce .wooImage .button,
				.woocommerce .wooImage .added_to_cart,
				.woocommerce form .added_to_cart,
				.woocommerce-error li a,
				.woocommerce-message a,
				.return-to-shop a,
				.wc-proceed-to-checkout .button.checkout-button,
				.widget_shopping_cart p.buttons a,
				.woocommerce .wishlist_table td.product-add-to-cart a,
				.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
				.woocommerce .content-area .woocommerce-tabs .tabs li a,
				.woocommerce-page table.cart .product-thumbnail img,
				.woocommerce-info,
				.woocommerce-error,
				.woocommerce-message,
				.woocommerce #reviews .commentlist li .avatar,
				.woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single,
				.woocommerce-checkout form.checkout_coupon,
				.woocommerce-checkout form.woocommerce-form-login,
				.product_list_widget li img,
				.woocommerce ul.products>li,
				#payment .payment_methods li,
				.woocommerce .woocommerce-tabs,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-first .attesa-sticky-image img,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button,
				ul.woocommerce-thankyou-order-details li,
				.woocommerce-MyAccount-navigation ul li,
				.site-main .woocommerce-pagination,
				.prev_next_buttons a,
				.attesa-prevnext-img img,
				ul.products li.product .tinvwl_add_to_wishlist_button {
					border-radius: '.intval($borderRadius).'px;
				}
				.woocommerce .wooImage .entry-wooImage img {
					border-top-left-radius: '.intval($borderRadius).'px;
					border-top-right-radius: '.intval($borderRadius).'px;
				}
				.attesa_woocommerce_mini_cart .widget_shopping_cart_content {
					border-bottom-left-radius: '.intval($borderRadius).'px;
					border-bottom-right-radius: '.intval($borderRadius).'px;
				}
			';
			$generalLinkColor = apply_filters( 'attesa_general_link_color', attesa_options('_general_link_color', '#f06292') );
			$attesa_custom_css .='
				.cartwoo-button-mobile a:hover,
				.cartwoo-button-mobile a:focus,
				.cartwoo-button-mobile a:active,
				.woocommerce ul.products>li .price,
				.woocommerce div.product .summary .price,
				.attesa-woo-icons-header a:hover,
				.attesa-woo-icons-header a:focus,
				.attesa-woo-icons-header a:active,
				.attesa_woo_float_cart_button.add_to_cart_trigger {
					color: '.esc_html($generalLinkColor).';
				}
				.woocommerce-pagination>ul.page-numbers li a,
				.woocommerce span.onsale,
				.woocommerce .wooImage .button,
				.woocommerce .wooImage .added_to_cart,
				.woocommerce form .added_to_cart,
				.woocommerce-error li a,
				.woocommerce-message a,
				.return-to-shop a,
				.wc-proceed-to-checkout .button.checkout-button,
				.widget_shopping_cart p.buttons a,
				.woocommerce .wishlist_table td.product-add-to-cart a,
				.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout,
				.woocommerce-store-notice,
				.woocommerce ul.products li.product a.compare,
				.woocommerce ul.products>li:hover .wooImage a.compare.button {
					background-color: '.esc_html($generalLinkColor).';
				}
				.woocommerce-pagination>ul.page-numbers li span,
				.woocommerce ul.products>li:hover,
				.woocommerce ul.products>li:focus,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a:hover,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a:focus,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a:active {
					border-color: '.esc_html($generalLinkColor).';
				}
			';
			$generalTextColor = apply_filters( 'attesa_general_text_color', attesa_options('_general_text_color', '#404040') );
			$attesa_custom_css .='
				.cartwoo-button-mobile a,
				.woocommerce div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
				.attesa-woo-icons-header a,
				.attesa_woo_float_cart_button.add_to_cart_trigger {
					color: '. esc_html($generalTextColor).';
				}
				.woocommerce ul.products>li .price {
					color: '.esc_html($generalTextColor).' !important;
				}
				.woocommerce-pagination>ul.page-numbers li a:hover,
				.woocommerce-pagination>ul.page-numbers li a:focus,
				.woocommerce ul.products>li:hover .wooImage .button,
				.woocommerce ul.products>li:hover .wooImage .added_to_cart,
				.woocommerce form .added_to_cart:hover,
				.woocommerce-error li a:hover,
				.woocommerce-message a:hover,
				.return-to-shop a:hover,
				.wc-proceed-to-checkout .button.checkout-button:hover,
				.widget_shopping_cart p.buttons a:hover,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button:hover,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button:focus,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button:active,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout:hover,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout:focus,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout:active {
					background-color: '.esc_html($generalTextColor).';
				}
			';
			$generalBackgroundColor = apply_filters( 'attesa_general_background_color', attesa_options('_general_background_color', '#ffffff') );
			$attesa_custom_css .='
				.woocommerce span.onsale,
				.woocommerce-pagination>ul.page-numbers li a,
				.woocommerce-pagination>ul.page-numbers li a:hover,
				.woocommerce-pagination>ul.page-numbers li a:focus,
				.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a.checkout,
				.woocommerce .wooImage .button,
				.woocommerce .wooImage .added_to_cart,
				.woocommerce form .added_to_cart,
				.woocommerce-error li a,
				.woocommerce-message a,
				.return-to-shop a,
				.wc-proceed-to-checkout .button.checkout-button,
				.widget_shopping_cart p.buttons a,
				.woocommerce .wishlist_table td.product-add-to-cart a,
				.woocommerce .content-area .woocommerce-tabs .tabs li.active a,
				.attesa-woocommerce-sticky-product .container .attesa-sticky-second .attesa-sticky-button,
				.woocommerce-store-notice,
				.woocommerce-store-notice a,
				.woocommerce-store-notice a:hover,
				.woocommerce-store-notice a:focus,
				.woocommerce-store-notice a:active,
				.woocommerce ul.products li.product a.compare {
					color: '.esc_html($generalBackgroundColor).';
				}
			';
			$alternativeBackgroundColor = apply_filters( 'attesa_alternative_background_color', attesa_options('_alternative_background_color', '#fbfbfb') );
			$attesa_custom_css .='
				.woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single,
				.woocommerce div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger,
				.woocommerce-message,	
				.woocommerce-info,
				.woocommerce-error,
				.woocommerce-checkout form.checkout_coupon,
				.woocommerce-checkout form.woocommerce-form-login,
				.woocommerce .woocommerce-tabs,
				.woocommerce table.shop_attributes tr th,
				.woocommerce-page .entry-content table thead th,
				.woocommerce-page .entry-content table tr:nth-child(even),
				#payment .payment_methods li {
					background-color: '.esc_html($alternativeBackgroundColor).';
				}
			';
			$generalBorderColor = apply_filters( 'attesa_general_border_color', attesa_options('_general_border_color', '#ececec') );
			$attesa_custom_css .='
				.woocommerce-MyAccount-navigation ul li.is-active {
					background-color: '.esc_html($generalBorderColor).';
				}
				.woocommerce .woocommerce-checkout .select2-container--default .select2-selection--single,
				.woocommerce ul.products>li,
				.prev_next_buttons a,
				.woocommerce-checkout form.checkout_coupon,
				.woocommerce-checkout form.woocommerce-form-login,
				body.woocommerce form.cart,
				.woocommerce .single_variation,
				.woocommerce .woocommerce-tabs,
				.woocommerce #reviews #comments ol.commentlist li .comment-text,
				.single-product div.product .woocommerce-product-rating,
				.woocommerce-page .entry-content table,
				.woocommerce-page .entry-content table thead th,
				.woocommerce-page .entry-content table td, .woocommerce-page .entry-content table th,
				ul.woocommerce-thankyou-order-details li,
				.woocommerce-MyAccount-navigation ul li,
				ul.woocommerce-thankyou-order-details li,
				.woocommerce-MyAccount-navigation ul li {
					border-color: '.esc_html($generalBorderColor).';
				}
				.star-rating:before {
					color: '.esc_html($generalBorderColor).';
				}
			';
			if (apply_filters( 'attesa_show_top_bar', attesa_options('_show_topbar', '1'))) {
				$topbarBackgroundColor = apply_filters( 'attesa_topbar_background_color', attesa_options('_topbar_background_color', '#fbfbfb') );
				$topbarTextColor = apply_filters( 'attesa_topbar_text_color', attesa_options('_topbar_text_color', '#828282') );
				$topbarBorderColor = apply_filters( 'attesa_topbar_border_color', attesa_options('_topbar_border_color', '#ececec') );
				$attesa_custom_css .='
					.attesa_woocommerce_mini_cart .widget_shopping_cart_content {
						background-color: '.esc_html($topbarBackgroundColor).';
					}
					.attesa_woocommerce_mini_cart ul.product_list_widget li,
					.attesa_woo_cart_quantity_item .remove,
					.attesa_woocommerce_mini_cart .widget_shopping_cart_content,
					.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a {
						border-color: '.esc_html($topbarBorderColor).';
					}
					.attesa_woocommerce_mini_cart .woocommerce-mini-cart__total {
						background-color: '.esc_html($topbarBorderColor).';
					}
					.cartwoo-button .woo-cart,
					.attesa_woocommerce_mini_cart,
					.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item h3 a,
					.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove,
					.attesa_woocommerce_mini_cart .woocommerce-mini-cart__buttons a {
						color: '.esc_html($topbarTextColor).';
					}
					.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove:hover,
					.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove:focus,
					.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove:active {
						border-color: '.esc_html($topbarTextColor).';
					}
				';
			}
			if ( is_active_sidebar( attesa_get_classic_sidebar() ) && attesa_check_bar('classic') ) {
				$classicSidebarLinkColor = apply_filters( 'attesa_classicsidebar_link_color', attesa_options('_classicsidebar_link_color', '#f06292') );
				$classicSidebarTextColor = apply_filters( 'attesa_classicsidebar_text_color', attesa_options('_classicsidebar_text_color', '#404040') );
				$classicSidebarBackgroundColor = apply_filters( 'attesa_classicsidebar_background_color', attesa_options('_classicsidebar_background_color', '#fbfbfb') );
				$classicSidebarBorderColor = apply_filters( 'attesa_classicsidebar_border_color', attesa_options('_classicsidebar_border_color', '#ececec') );
				$attesa_custom_css .= '
					#secondary .widget_price_filter .ui-slider .ui-slider-handle,
					#secondary .widget_price_filter .ui-slider .ui-slider-range,
					#secondary .widget_shopping_cart p.buttons a {
						background-color: '.esc_html($classicSidebarLinkColor).';
					}
					#secondary .widget_shopping_cart p.buttons a:hover,
					#secondary .widget_shopping_cart p.buttons a:focus,
					#secondary .widget_shopping_cart p.buttons a:active {
						background-color: '.esc_html($classicSidebarTextColor).';
					}
					#secondary .widget_shopping_cart p.buttons a {
						color: '.esc_html($classicSidebarBackgroundColor).';
					}
					#secondary .widget_price_filter .price_slider_wrapper .ui-widget-content {
						background-color: '.esc_html($classicSidebarBorderColor).';
					}
				';
			}
			if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) {
				$pushSidebarLinkColor = apply_filters( 'attesa_pushsidebar_link_color', attesa_options('_pushsidebar_link_color', '#f06292') );
				$pushSidebarTextColor = apply_filters( 'attesa_pushsidebar_text_color', attesa_options('_pushsidebar_text_color', '#909090') );
				$pushSidebarBackgroundColor = apply_filters( 'attesa_pushsidebar_background_color', attesa_options('_pushsidebar_background_color', '#fbfbfb') );
				$pushSidebarBorderColor = apply_filters( 'attesa_pushsidebar_border_color', attesa_options('_pushsidebar_border_color', '#ececec') );
				$attesa_custom_css .= '
					#tertiary .widget_price_filter .ui-slider .ui-slider-handle,
					#tertiary .widget_price_filter .ui-slider .ui-slider-range,
					#tertiary .widget_shopping_cart p.buttons a {
						background-color: '.esc_html($pushSidebarLinkColor).';
					}
					#tertiary .widget_shopping_cart p.buttons a:hover,
					#tertiary .widget_shopping_cart p.buttons a:focus,
					#tertiary .widget_shopping_cart p.buttons a:active {
						background-color: '.esc_html($pushSidebarTextColor).';
					}
					#tertiary .widget_shopping_cart p.buttons a {
						color: '.esc_html($pushSidebarBackgroundColor).';
					}
					#tertiary .widget_price_filter .price_slider_wrapper .ui-widget-content {
						background-color: '.esc_html($pushSidebarBorderColor).';
					}
				';
			}
			if ( attesa_check_bar('footer') ) {
				$footerLinkColor = apply_filters( 'attesa_footer_link_color', attesa_options('_footer_link_color', '#aeaeae') );
				$footerTextColor = apply_filters( 'attesa_footer_text_color', attesa_options('_footer_text_color', '#f0f0f0') );
				$footerBackgroundColor = apply_filters( 'attesa_footer_background_color', attesa_options('_footer_background_color', '#3f3f3f') );
				$footerBorderColor = apply_filters( 'attesa_footer_border_color', attesa_options('_footer_border_color', '#bcbcbc') );
				$attesa_custom_css .= '
					.footerArea .widget_price_filter .ui-slider .ui-slider-handle,
					.footerArea .widget_price_filter .ui-slider .ui-slider-range,
					.footerArea .widget_shopping_cart p.buttons a {
						background-color: '.esc_html($footerLinkColor).';
					}
					.footerArea .widget_shopping_cart p.buttons a:hover,
					.footerArea .widget_shopping_cart p.buttons a:focus,
					.footerArea .widget_shopping_cart p.buttons a:active {
						background-color: '.esc_html($footerTextColor).';
					}
					.footerArea .widget_shopping_cart p.buttons a {
						color: '.esc_html($footerBackgroundColor).';
					}
					.footerArea .widget_price_filter .price_slider_wrapper .ui-widget-content {
						background-color: '.esc_html($footerBorderColor).';
					}
				';
			}
			if (is_product() && attesa_options('_woocommerce_stickybar', '1')) {
				$stickyBarBackColor = attesa_options('_woocommerce_stickybar_backcolor', '#fbfbfb');
				$stickyBarTextColor = attesa_options('_woocommerce_stickybar_textcolor', '#404040');
				$attesa_custom_css .= '
					.attesa-woocommerce-sticky-product {
						background-color:'.esc_html($stickyBarBackColor).';
						color:'.esc_html($stickyBarTextColor).';}
				';
			}
			if (apply_filters( 'attesa_filter_use_header_colors', attesa_options('_activate_header_custom_colors', ''))) {
				$headerLinkColor = apply_filters( 'attesa_header_link_color', attesa_options('_header_link_color', '#f06292') );
				$headerTextColor = apply_filters( 'attesa_header_text_color', attesa_options('_header_text_color', '#404040') );
				$attesa_custom_css .= '
					.attesa-woo-icons-header a:hover,
					.attesa-woo-icons-header a:focus,
					.attesa-woo-icons-header a:active,
					.attesa_woo_float_cart_button.add_to_cart_trigger {
						color: '.esc_html($headerLinkColor).';
					}
					.attesa-woo-icons-header a,
					.attesa_woo_float_cart_button.add_to_cart_trigger,
					#masthead .cartwoo-button-mobile a,
					#masthead .cartedd-button-mobile a {
						color: '.esc_html($headerTextColor).';
					}
				';
			}
			return $attesa_custom_css;
		}
		
		/* Add WooCommerce Theme Support */
		public static function attesa_woocommerce_support() {
			$wooCommerceStyle = attesa_options('_woocommerce_gallery_style', 'defaultgallery');
			$wooCommerceLightbox = attesa_options('_woocommerce_default_lightbox', '1');
			if ($wooCommerceStyle == 'zoomgallery') {
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-slider' );
			} else {
				remove_theme_support( 'wc-product-gallery-zoom' );
				remove_theme_support( 'wc-product-gallery-slider' );
			}
			if ($wooCommerceLightbox) {
				add_theme_support( 'wc-product-gallery-lightbox' );
			} else {
				remove_theme_support( 'wc-product-gallery-lightbox' );
			}
		}
		
		/* Show or remove WooCommerce relaterd products */
		public static function attesa_woocommerce_related_products() {
			if (!attesa_options('_woocommerce_show_related', '1')) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
		}
		
		/* Add menu cart item to the Woo fragments so it updates with AJAX */
		public static function attesa_cart_count_fragments( $fragments ) {
			$fragments['span.shopping-count'] = '<span class="shopping-count">' . WC()->cart->get_cart_contents_count() . '</span>';
			return $fragments;
		}
		
		/* Manage the numbering of related products */
		public static function attesa_related_products_args( $args ) {
			$args['posts_per_page'] = wc_get_default_products_per_row();
			$args['columns'] = wc_get_default_products_per_row();
			return $args;
		}
		
		/* WooCommerce previous and next products */
		public static function attesa_prev_next_product(){
			if (attesa_options('_woocommerce_prevnext_product', '1')) {
				$prev_post = get_previous_post();
				$next_post = get_next_post();
				echo '<div class="prev_next_buttons">';
					if (!empty( $prev_post )): ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
							<span class="attesa-prevnext"><i class="fa fas fa-angle-left" aria-hidden="true"></i></span>
							<div class="attesa-prevnext-container">
								<?php if (has_post_thumbnail()) : ?>
									<span class="attesa-prevnext-img"><?php echo get_the_post_thumbnail( $prev_post->ID, 'thumbnail' ); ?></span>
								<?php endif; ?>
							</div>
						</a>
					<?php endif;
					if (!empty( $next_post )): ?>
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
							<span class="attesa-prevnext"><i class="fa fas fa-angle-right" aria-hidden="true"></i></span>
							<div class="attesa-prevnext-container">
								<?php if (has_post_thumbnail()) : ?>
									<span class="attesa-prevnext-img"><?php echo get_the_post_thumbnail( $next_post->ID, 'thumbnail' ); ?></span>
								<?php endif; ?>
							</div>
						</a>
					<?php endif;
				echo '</div>';
			}
		}
		
		/* Sticky bar for single products WooCommerce */
		public static function attesa_woocommerce_sticky_bar() {
			if (attesa_options('_woocommerce_stickybar', '1') && is_product()) {
				global $product;
				$StickyBarText = attesa_options('_woocommerce_stickybar_text', __( 'View Product', 'attesa' ));
				?>
				<div class="attesa-woocommerce-sticky-product">
					<div class="container">
						<div class="attesa-sticky-first">
							<?php if (has_post_thumbnail($product->get_id())) : ?>
								<div class="attesa-sticky-image"><?php echo get_the_post_thumbnail( $product->get_id(), 'woocommerce_thumbnail' ); ?></div>
							<?php endif; ?>
							<div class="attesa-sticky-details">
								<span class="attesa-sticky-title"><?php echo esc_html($product->get_name()); ?></span>
								<p class="attesa-sticky-price smallText"><?php echo wp_kses_post($product->get_price_html()); ?></p>
							</div>
						</div>
						<div class="attesa-sticky-second smallText">
							<?php if($StickyBarText || is_customize_preview()): ?>
								<div class="attesa-sticky-button"><?php echo esc_html($StickyBarText); ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php
			}
		}
	}
}
new Attesa_WooCommerce();