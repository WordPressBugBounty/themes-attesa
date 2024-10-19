<?php
/**
 * Attesa support for Easy Digital Downloads
 *
 * @package AttesaWP
 */
if ( ! class_exists( 'Attesa_EDD' ) ) {
	
	class Attesa_EDD {
		/**
		 * Main Class Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			add_action( 'attesa_custom_css_style_filter', array($this, 'attesa_edd_additional_css_code') , 999);
		}
		
		/* Additional custom CSS for Easy Digital Downloads */
		public static function attesa_edd_additional_css_code($attesa_custom_css) {
			$borderRadius = apply_filters( 'attesa_elements_border_radius', attesa_options('_elements_border_radius', '5') );
			$attesa_custom_css .= '
				.edd_purchase_submit_wrapper a,
				.edd_downloads_list .edd_download,
				body.edd-page legend {
					border-radius: '.intval($borderRadius).'px;
				}
			';
			$smalltext_font_size = attesa_options('_smalltext_font_size', '13px');
			if ($smalltext_font_size != '13px') {
				$attesa_custom_css .= '
					#edd_checkout_form_wrap span.edd-description,
					#edd_purchase_submit #edd_terms_agreement #edd_terms,
					#edd_purchase_submit #edd_mailchimp #edd_terms,
					#edd_purchase_submit #edd_terms_agreement>[id*="-terms-wrap"]>[id*="_terms"]>p,
					#edd_purchase_submit #edd_mailchimp>[id*="-terms-wrap"]>[id*="_terms"]>p,
					.edd-cart-item-notice,
					.edd-cart-added-alert,
					.edd_purchase_submit_wrapper,
					.edd_downloads_list .edd_download .edd_download_inner .edd_download_excerpt,
					.edd_cart_remove_item_btn,
					.edd_purchase_receipt_product_notes,
					.edd_sl_license_key_expired {
						font-size: '.esc_html($smalltext_font_size).';
					}
				';
			}
			$generalLinkColor = apply_filters( 'attesa_general_link_color', attesa_options('_general_link_color', '#f06292') );
			$attesa_custom_css .='
				.cartedd-button-mobile a:hover,
				.cartedd-button-mobile a:focus,
				.cartedd-button-mobile a:active,
				#edd_purchase_submit #edd_final_total_wrap span {
					color: '.esc_html($generalLinkColor).';
				}
				.edd_purchase_submit_wrapper a {
					background-color: '.esc_html($generalLinkColor).';
				}
				.edd_downloads_list .edd_download:hover,
				.edd_downloads_list .edd_download:focus,
				.edd_downloads_list .edd_download:active {
					border-color: '.esc_html($generalLinkColor).';
				}
			';
			$generalTextColor = apply_filters( 'attesa_general_text_color', attesa_options('_general_text_color', '#404040') );
			$attesa_custom_css .='
				.cartedd-button-mobile a,
				#edd_checkout_form_wrap label,
				.edd_purchase_receipt_product_name {
					color: '. esc_html($generalTextColor).';
				}
				.edd_purchase_submit_wrapper a:hover,
				.edd_purchase_submit_wrapper a:focus,
				.edd_purchase_submit_wrapper a:active {
					background-color: '.esc_html($generalTextColor).';
				}
			';
			$generalBackgroundColor = apply_filters( 'attesa_general_background_color', attesa_options('_general_background_color', '#ffffff') );
			$attesa_custom_css .='
				.edd_purchase_submit_wrapper a {
					color: '.esc_html($generalBackgroundColor).';
				}
			';
			$generalBorderColor = apply_filters( 'attesa_general_border_color', attesa_options('_general_border_color', '#ececec') );
			$attesa_custom_css .='
				#edd_purchase_submit #edd_terms_agreement #edd_terms,
				#edd_purchase_submit #edd_mailchimp #edd_terms,
				#edd_purchase_submit #edd_terms_agreement>[id*="-terms-wrap"]>[id*="_terms"]>p,
				#edd_purchase_submit #edd_mailchimp>[id*="-terms-wrap"]>[id*="_terms"]>p,
				#edd_checkout_cart .edd_cart_header_row th,
				#edd_user_history thead .edd_purchase_row th,
				#edd_sl_license_keys thead .edd_sl_license_row th,
				#edd_purchase_receipt thead th,
				#edd_purchase_receipt_products thead th,
				#edd_sl_license_sites thead th,
				body.edd-page legend {
					background-color: '.esc_html($generalBorderColor).';
				}
				#edd_purchase_submit #edd_terms_agreement #edd_terms,
				#edd_purchase_submit #edd_mailchimp #edd_terms,
				#edd_purchase_submit #edd_terms_agreement>[id*="-terms-wrap"]>[id*="_terms"]>p,
				#edd_purchase_submit #edd_mailchimp>[id*="-terms-wrap"]>[id*="_terms"]>p,
				#edd_checkout_cart td,
				#edd_checkout_cart th,
				#edd_user_history td,
				#edd_user_history th,
				#edd_sl_license_keys td,
				#edd_sl_license_keys th,
				#edd_purchase_receipt td,
				#edd_purchase_receipt th,
				#edd_purchase_receipt_products td,
				#edd_purchase_receipt_products th,
				#edd_sl_license_sites td,
				#edd_sl_license_sites th,
				.edd_downloads_list .edd_download {
					border-color: '.esc_html($generalBorderColor).';
				}
			';
			if (apply_filters( 'attesa_show_top_bar', attesa_options('_show_topbar', '1'))) {
				$topbarTextColor = apply_filters( 'attesa_topbar_text_color', attesa_options('_topbar_text_color', '#828282') );
				$attesa_custom_css .= '
					.cartedd-button .edd-cart {
						color: '.esc_html($topbarTextColor).';
					}
				';
			}
			if ( is_active_sidebar( attesa_get_classic_sidebar() ) && attesa_check_bar('classic') ) {
				$classicSidebarLinkColor = apply_filters( 'attesa_classicsidebar_link_color', attesa_options('_classicsidebar_link_color', '#f06292') );
				$classicSidebarTextColor = apply_filters( 'attesa_classicsidebar_text_color', attesa_options('_classicsidebar_text_color', '#404040') );
				$classicSidebarBackgroundColor = apply_filters( 'attesa_classicsidebar_background_color', attesa_options('_classicsidebar_background_color', '#fbfbfb') );
				$attesa_custom_css .= '
					#secondary .edd_purchase_submit_wrapper a {
						background-color: '.esc_html($classicSidebarLinkColor).';
					}
					#secondary .edd_purchase_submit_wrapper a:hover,
					#secondary .edd_purchase_submit_wrapper a:focus,
					#secondary .edd_purchase_submit_wrapper a:active {
						background-color: '.esc_html($classicSidebarTextColor).';
					}
					#secondary .edd_purchase_submit_wrapper a,
					#secondary .edd_purchase_submit_wrapper a:hover,
					#secondary .edd_purchase_submit_wrapper a:focus,
					#secondary .edd_purchase_submit_wrapper a:active {
						color: '.esc_html($classicSidebarBackgroundColor).';
					}
				';
			}
			if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) {
				$pushSidebarLinkColor = apply_filters( 'attesa_pushsidebar_link_color', attesa_options('_pushsidebar_link_color', '#f06292') );
				$pushSidebarTextColor = apply_filters( 'attesa_pushsidebar_text_color', attesa_options('_pushsidebar_text_color', '#909090') );
				$pushSidebarBackgroundColor = apply_filters( 'attesa_pushsidebar_background_color', attesa_options('_pushsidebar_background_color', '#fbfbfb') );
				$attesa_custom_css .= '
					#tertiary .edd_purchase_submit_wrapper a {
						background-color: '.esc_html($pushSidebarLinkColor).';
					}
					#tertiary .edd_purchase_submit_wrapper a:hover,
					#tertiary .edd_purchase_submit_wrapper a:focus,
					#tertiary .edd_purchase_submit_wrapper a:active {
						background-color: '.esc_html($pushSidebarTextColor).';
					}
					#tertiary .edd_purchase_submit_wrapper a,
					#tertiary .edd_purchase_submit_wrapper a:hover,
					#tertiary .edd_purchase_submit_wrapper a:focus,
					#tertiary .edd_purchase_submit_wrapper a:active {
						color: '.esc_html($pushSidebarBackgroundColor).';
					}
				';
			}
			if ( attesa_check_bar('footer') ) {
				$footerLinkColor = apply_filters( 'attesa_footer_link_color', attesa_options('_footer_link_color', '#aeaeae') );
				$footerTextColor = apply_filters( 'attesa_footer_text_color', attesa_options('_footer_text_color', '#f0f0f0') );
				$footerBackgroundColor = apply_filters( 'attesa_footer_background_color', attesa_options('_footer_background_color', '#3f3f3f') );
				$attesa_custom_css .= '
					.footerArea .edd_purchase_submit_wrapper a {
						background-color: '.esc_html($footerLinkColor).';
					}
					.footerArea .edd_purchase_submit_wrapper a:hover,
					.footerArea .edd_purchase_submit_wrapper a:focus,
					.footerArea .edd_purchase_submit_wrapper a:active {
						background-color: '.esc_html($footerTextColor).';
					}
					.footerArea .edd_purchase_submit_wrapper a,
					.footerArea .edd_purchase_submit_wrapper a:hover,
					.footerArea .edd_purchase_submit_wrapper a:focus,
					.footerArea .edd_purchase_submit_wrapper a:active {
						color: '.esc_html($footerBackgroundColor).';
					}
				';
			}
			return $attesa_custom_css;
		}
	}
}
new Attesa_EDD();