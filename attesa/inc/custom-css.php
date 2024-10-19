<?php
/**
 * Attesa to print custom CSS
 *
 * @package Attesa
 */

/**
 * Add Custom CSS to Header 
 */
if ( ! function_exists( 'attesa_custom_css_styles' ) ) {
	function attesa_custom_css_styles() {
		$attesa_custom_css = '';
			/* Website Structure */
			$websiteStructure = apply_filters( 'attesa_website_structure', attesa_options('_website_structure', 'wide') );
			if ($websiteStructure == 'boxed') {
				$websiteBoxedWidth = apply_filters( 'attesa_max_width_structure', attesa_options('_max_width_structure', '1500') );
				$attesa_custom_css .= '
					.attesa-site-wrap,
					#masthead.withSticky,
					#masthead.withSticky .nav-middle.format_featuredtitle,
					#masthead.topbarscrollshow .nav-top.fixed {
						max-width: '.esc_html($websiteBoxedWidth).'px;
					}
					#masthead.withSticky,
					#masthead.withSticky .nav-middle.format_featuredtitle,
					#masthead.topbarscrollshow .nav-top.fixed {
						left: initial !important;
						right: initial !important;
						margin: 0 auto;
					}
				';
			}
			/* Choose the fonts */
			$disableGoogleFonts = attesa_options('_disable_google_fonts', '');
			if (empty($disableGoogleFonts)) {
				$FontHeading = attesa_options('_googlefont_heading', 'Quicksand : sans-serif');
				$FontText = attesa_options('_googlefont_text', 'Quicksand : sans-serif');
			} else {
				$FontHeading = attesa_options('_standardfont_heading', 'Arial : sans-serif');
				$FontText = attesa_options('_standardfont_text', 'Arial : sans-serif');
			}
			if (strpos($FontHeading, ' : ') !== false) {
				$piecesHead = explode(" : ", $FontHeading);
			} else {
				$piecesHead = explode(" : ", $FontHeading . ' : serif');
			}
			if (strpos($FontText, ' : ') !== false) {
				$piecesText = explode(" : ", $FontText);
			} else {
				$piecesText = explode(" : ", $FontText . ' : serif');
			}
			$attesa_custom_css .= '
				h1,
				h2,
				h3,
				h4,
				h5,
				h6,
				p.site-title,
				blockquote {
					font-family: '.esc_html($piecesHead[0]).', '.esc_html($piecesHead[1]).';
				}
				body,
				button,
				input,
				select,
				optgroup,
				textarea {
					font-family: '.esc_html($piecesText[0]).', '.esc_html($piecesText[1]).';
				}
			';
			/* Set custom max-width for content, side content and sidebar */
			$max_width = apply_filters( 'attesa_max_width_site_content', attesa_options('_max_width', '1240') );
			$width_content = apply_filters( 'attesa_width_site_content', attesa_options('_width_content', '67') );
			$width_content_nosidebar = apply_filters( 'attesa_width_site_content_no_sidebar', attesa_options('_width_content_nosidebar', '67') );
			if ($max_width != '1240') {
				$attesa_custom_css .= '
					.nav-top .container.boxed,
					.nav-middle .container.boxed,
					.nav-middle-top-title .container.boxed,
					#content.site-content,
					.attesaFooterWidget,
					.attesaFeatBox .attesaFeatBoxContainer,
					.mainFooter .site-copy-down,
					.second-navigation,
					.attesa-woocommerce-sticky-product .container,
					.attesapro-footer-callout-container {
						max-width: '.intval($max_width).'px;
					}
				';
			}
			if ($width_content != '67') {
				$width_sidebar = abs($width_content - 100);
				$attesa_custom_css .= '
					#primary.content-area {width:'.intval($width_content).'%;}
					#secondary {width:'.intval($width_sidebar).'%;}
				';
			}
			$attesa_custom_css .=  'body.no-sidebar #primary.content-area {width:'.intval($width_content_nosidebar).'%;}';
			/* Set border radius of elements */
			$borderRadius = apply_filters( 'attesa_elements_border_radius', attesa_options('_elements_border_radius', '5') );
			$attesa_custom_css .= '
			button,
			input[type]:not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
			textarea,
			select,
			.attesaMenuButton,
			.navigation.pagination .nav-links a,
			.page-links a,
			.navigation.pagination .nav-links span.current,
			.page-links .current,
			aside ul.menu .indicatorBar,
			aside ul.product-categories .indicatorBar,
			.widget_tag_cloud a,
			.widget.widget_search input[type="search"],
			.widget.widget_search input[type="submit"],
			#secondary .sidebar-container,
			header.page-header,
			.entry-footer .read-more a,
			.post-thumbnail img,
			#toTop,
			#comments article footer img,
			#comments .reply,
			.site-social-float a,
			body.attesa-blog-grid .hentry,
			body.attesa-blog-masonry .hentry,
			fieldset,
			.attesaPostWidget img,
			.site-social-widget .attesa-social,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a,
			.attesa-contact-info i,
			.attesa-post-slider-readmore p a,
			.attesa-breadcrumbs,
			.rank-math-breadcrumb,
			.awp-ajax-search.shortcode .awp-search-results ul li img,
			.bypostauthor>article {
				border-radius: '.intval($borderRadius).'px;
			}
			#wp-calendar>caption {
				border-top-left-radius: '.intval($borderRadius).'px;
				border-top-right-radius: '.intval($borderRadius).'px;
			}';
			/* Max height for the logo if the header format is Featured Title */
			$logoMaxHeight = attesa_options('_menu_logo_max_height', '100');
				$attesa_custom_css .= '
					.nav-middle-top-title .attesa-logo img {
						max-height: '.intval($logoMaxHeight).'px;
					}
				';
			/* Font Size */
			$general_font_size = attesa_options('_general_font_size', '16px');
			$sitetitle_font_size = attesa_options('_sitetitle_font_size', '18px');
			$mainmenu_font_size = attesa_options('_mainmenu_font_size', '14px');
			$smalltext_font_size = attesa_options('_smalltext_font_size', '13px');
			$headertitle_font_size = attesa_options('_headertitle_font_size', '48px');
			$widgettitle_font_size = attesa_options('_widgettitle_font_size', '19px');
			$widgettext_font_size = attesa_options('_widgettext_font_size', '14px');
			/* Line Height */
			$content_line_height = attesa_options('_content_line_height', '2');
			$widget_line_height = attesa_options('_widget_line_height', '2');
			$pagetitle_line_height = attesa_options('_pagetitle_line_height', '1.3');
			$widgettitle_line_height = attesa_options('_widgettitle_line_height', '1.5');
			/* Font Weight */
			$sitetitle_font_weight = attesa_options('_sitetitle_font_weight', 'bold');
			$headertitle_font_weight = attesa_options('_headertitle_font_weight', 'normal');
			$widgettitle_font_weight = attesa_options('_widgettitle_font_weight', 'bold');
			$attesa_custom_css .= '@media all and (min-width: 1024px) {';
			if ($general_font_size != '16px') {
				$attesa_custom_css .= '
				body,
				button,
				input,
				select,
				optgroup,
				textarea,
				aside ul.menu .indicatorBar,
				aside ul.product-categories .indicatorBar,
				.attesa_woocommerce_mini_cart .attesa_woo_cart_quantity_item .remove,
				form.attesa-pro-ajax-search-shortocode button i {
					font-size: '.esc_html($general_font_size).';
				}';
			}
			if ($smalltext_font_size != '13px') {
				$attesa_custom_css .= '
				.smallText,
				blockquote cite,
				.post-navigation span.meta-nav,
				.widget_tag_cloud a,
				#comments article .comment-metadata,
				#comments .reply,
				.comment-awaiting-moderation,
				.comment-notes,
				.attesaPostWidget .theText span.date,
				.attesaPostWidget .theText span.comm,
				ul.products li.product .tinvwl_add_to_wishlist_button,
				.site-social-widget .attesa-social,
				.wp-block-image figcaption {
					font-size: '.esc_html($smalltext_font_size).';
				}';
			}
			if ($sitetitle_font_size != '18px') {
				$attesa_custom_css .= '
				.site-branding .site-title {
					font-size: '.esc_html($sitetitle_font_size).';
				}';
			}
			if ($mainmenu_font_size != '14px') {
				$attesa_custom_css .= '
				.main-navigation li,
				.main-navigation-popup li,
				.site-social-header a,
				body .attesa-woo-icons-header a,
				ul.attesa-categories-list li,
				body .attesa_float_cart_icon.position_next_main_menu i {
					font-size: '.esc_html($mainmenu_font_size).';
				}';
			}
			if ($headertitle_font_size != '48px') {
				$attesa_custom_css .= '
				.hentry .entry-title,
				.attesaFeatBoxTitle .entry-title,
				.woocommerce h1.page-title {
					font-size: '.esc_html($headertitle_font_size).';
				}';
			}
			if ($widgettitle_font_size != '19px') {
				$attesa_custom_css .= '
				.widget .widget-title .widgets-heading {
					font-size: '.esc_html($widgettitle_font_size).';
				}';
			}
			if ($widgettext_font_size != '14px') {
				$attesa_custom_css .= '
				#secondary,
				#tertiary,
				.attesaFooterWidget {
					font-size: '.esc_html($widgettext_font_size).';
				}';
			}
			if ($content_line_height != '2') {
				$attesa_custom_css .= '
				.page-content,
				.entry-content,
				.entry-summary {
					line-height: '.esc_html($content_line_height).';
				}';
			}
			if ($widget_line_height != '2') {
				$attesa_custom_css .= '
				#secondary,
				#tertiary,
				.attesaFooterWidget {
					line-height: '.esc_html($widget_line_height).';
				}';
			}
			if ($pagetitle_line_height != '1.3') {
				$attesa_custom_css .= '
				.hentry .entry-title,
				.attesaFeatBoxTitle .entry-title {
					line-height: '.esc_html($pagetitle_line_height).';
				}
				body.attesa-blog-nogrid .sticky .entry-header .entry-title:before {
					line-height: '.esc_html($pagetitle_line_height + '0.2').';
				}';
			}
			if ($widgettitle_line_height != '1.5') {
				$attesa_custom_css .= '
				.widget .widget-title .widgets-heading {
					line-height: '.esc_html($widgettitle_line_height).';
				}';
			}
			if ($sitetitle_font_weight != 'bold') {
				$attesa_custom_css .= '
				.site-branding .site-title {
					font-weight: '.esc_html($sitetitle_font_weight).';
				}';
			}
			if ($headertitle_font_weight != 'normal') {
				$attesa_custom_css .= '
				.hentry .entry-title,
				.attesaFeatBoxTitle .entry-title,
				.woocommerce h1.page-title {
					font-weight: '.esc_html($headertitle_font_weight).';
				}';
			}
			if ($widgettitle_font_weight != 'bold') {
				$attesa_custom_css .= '
				.widget .widget-title .widgets-heading {
					font-weight: '.esc_html($widgettitle_font_weight).';
				}';
			}
			$attesa_custom_css .= '}';
			/* Main menu style */
			$menuFontWeight = attesa_options('_menu_font_weight', 'bold');
			$menuTextTransform = attesa_options('_menu_text_transform', 'none');
			if (attesa_options('_header_format', 'compat') != 'custom') {
				$attesa_custom_css .='
					.main-navigation li,
					.main-navigation-popup li {
						font-weight: '.esc_html($menuFontWeight).';
						text-transform: '.esc_html($menuTextTransform).';
					}
				';
			}
			/* Main Menu position */
			$menuPosition = attesa_options('_menu_position', 'right');
			$attesa_custom_css .='
				.nav-middle:not(.format_featuredtitle) .container .mainHead {
					float: '.esc_html($menuPosition).';
				}
			';
			/* Featured Image posts opacity color */
			if (is_singular( 'post' ) && '' != get_the_post_thumbnail()) {
				$featImagePostsOpacity = attesa_options('_featimage_style_posts_opacity', '#f5f5f5');
				list($r, $g, $b) = sscanf($featImagePostsOpacity, '#%02x%02x%02x');
				$featImagePostsOpacityPrint = '.attesaFeatBox .attesaFeatBoxOpacityPost {background-color: rgba('.esc_html($r).', '.esc_html($g).', '.esc_html($b).',0.3)}';
				$attesa_custom_css .= apply_filters( 'attesa_opacity_featured_image_style', $featImagePostsOpacityPrint );
			}
			/* Featured Image pages opacity color */
			if (is_page() && '' != get_the_post_thumbnail()) {
				$featImagePagesOpacity = attesa_options('_featimage_style_pages_opacity', '#f5f5f5');
				list($r, $g, $b) = sscanf($featImagePagesOpacity, '#%02x%02x%02x');
				$featImagePagesOpacityPrint = '.attesaFeatBox .attesaFeatBoxOpacityPage {background-color: rgba('.esc_html($r).', '.esc_html($g).', '.esc_html($b).',0.3)}';
				$attesa_custom_css .= apply_filters( 'attesa_opacity_featured_image_style_page', $featImagePagesOpacityPrint );
			}
			/* Social Network float position */
			if (attesa_options('_social_float', '') == '1') {
				$socialFloatPosition = attesa_options('_socialfloat_position', 'left');
				$attesa_custom_css .= '
					.site-social-float {
						'.esc_html($socialFloatPosition).': 10px;
					}
				';
			}
			/* Scroll To Top position */
			if (attesa_options('_show_scrolltotop', '1') == '1') {
				$scrolltotopPosition = attesa_options('_scrolltotop_position', 'right');
				$attesa_custom_css .= '
					#toTop {
						'.esc_html($scrolltotopPosition).': 20px;
					}
				';
			}
			/* Choose classic sidebar position */
			if (is_active_sidebar( attesa_get_classic_sidebar() ) && attesa_check_bar('classic')) {
				$classicsidebarPosition = attesa_options('_classicsidebar_position','right');
				if ($classicsidebarPosition == 'right') {
					$classicSidebarPositionCode = '#primary.content-area {float: left;}';
				} else {
					$classicSidebarPositionCode = '#primary.content-area {float: right;}';
				}
				$attesa_custom_css .= apply_filters( 'attesa_classic_sidebar_position', $classicSidebarPositionCode );
			}
			/* Choose push sidebar position */
			if (is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push')) {
				$pushsidebarPosition = attesa_options('_pushsidebar_position','right');
				if ($pushsidebarPosition == 'right') {
					$pushSidebarPositionCode = '
					@media all and (min-width: 1025px) {
						body {
							overflow-x: hidden;
						}
						.attesa-site-wrap {
							left: 0;
							transition: left .25s ease-in-out;
						}
						body.yesOpen .attesa-site-wrap,
						body.yesOpen:not(.format_featuredtitle) #masthead {
							left: -150px;
						}
					}
					body.yesOpen #masthead.noSticky,
					body.yesOpen #masthead.relative,
					#masthead {
						left: 0;
					}
					#tertiary {
						border-left-width: 3px;
						border-left-style: solid;
						right: -390px;
						transition-property: right;
					}
					#tertiary.yesOpen {
						right: 0;
					}
					@media all and (max-width: 600px) {
						#tertiary {
							right: -100%
						}
					}';
				} else {
					$pushSidebarPositionCode = '
					@media all and (min-width: 1025px) {
						body {
							overflow-x: hidden;
						}
						.attesa-site-wrap {
							right: 0;
							transition: right .25s ease-in-out;
						}
						body.yesOpen .attesa-site-wrap,
						body.yesOpen:not(.format_featuredtitle) #masthead {
							right: -150px;
						}
					}
					body.yesOpen #masthead.noSticky,
					body.yesOpen #masthead.relative,
					#masthead {
						right: 0;
					}
					#tertiary {
						border-right-width: 3px;
						border-right-style: solid;
						left: -390px;
						transition-property: left;
					}
					#tertiary.yesOpen {
						left: 0;
					}
					@media all and (max-width: 600px) {
						#tertiary{
							left: -100%
						}
					}';
				}
				$attesa_custom_css .= apply_filters( 'attesa_push_sidebar_position', $pushSidebarPositionCode );
			}
			/* Choose outer background color */
			if ($websiteStructure == 'boxed') {
				$outerBackgroundColor = apply_filters( 'attesa_outer_background_color', attesa_options('_outer_background_color', '#cccccc') );
				$attesa_custom_css .='
					body {
						background-color: '.esc_html($outerBackgroundColor).';
					}
				';
			}
			/* Choose general link color */
			$generalLinkColor = apply_filters( 'attesa_general_link_color', attesa_options('_general_link_color', '#f06292') );
			$attesa_custom_css .='
			blockquote::before,
			a,
			a:visited,
			.menustyle_default>div>ul> li:hover>a,
			.menustyle_default>div>ul> li:focus>a,
			.menustyle_default>div>ul> .current_page_item>a,
			.menustyle_default>div>ul> .current-menu-item>a,
			.menustyle_default>div>ul> .current_page_ancestor>a,
			.menustyle_default>div>ul> .current-menu-ancestor>a,
			.menustyle_default>div>ul> .current_page_parent>a,
			.entry-meta i,
			.entry-footer span i,
			.site-social-header a:hover,
			.site-social-header a:focus,
			.site-social-header a:active {
				color: '.esc_html($generalLinkColor).';
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.main-navigation>div>ul>li>a::before,
			.main-navigation-popup>div ul li a::before,
			.attesaMenuButton,
			.navigation.pagination .nav-links a,
			.page-links a,
			.widget_tag_cloud a,
			.entry-footer .read-more a,
			#toTop,
			ul.products li.product .tinvwl_add_to_wishlist_button,
			.attesa-pro-sharing-box-container.style_astheme a:hover,
			.attesa-pro-sharing-box-container.style_astheme a:focus,
			.attesa-pro-sharing-box-container.style_astheme a:active,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a,
			.attesa-infinite-button-container .attesa-infinite-scroll-more-button,
			.bypostauthor>article::after,
			.attesa-menu-badge {
				background-color: '.esc_html($generalLinkColor).';
			}
			input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
			textarea:focus,
			.navigation.pagination .nav-links span.current,
			.page-links .current,
			.footerArea,
			body.attesa-blog-grid .sticky,
			body.attesa-blog-masonry .sticky,
			.prev_next_buttons a:hover,
			.prev_next_buttons a:focus,
			.prev_next_buttons a:active,
			.site-social-float a:hover,
			.site-social-float a:focus,
			.site-social-float a:active,
			.attesa-pro-sharing-box-container.style_astheme a,
			.awp-ajax-search.shortcode .awp-search-results.filled {
				border-color: '.esc_html($generalLinkColor).';
			}';
			/* Choose general text color */
			$generalTextColor = apply_filters( 'attesa_general_text_color', attesa_options('_general_text_color', '#404040') );
			$attesa_custom_css .='
			body,
			button,
			input,
			select,
			optgroup,
			textarea,
			input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
			textarea:focus,
			a:hover, a:focus, a:active, .entry-title a, .post-navigation span.meta-nav, #comments .reply a,
			.main-navigation>div>ul>li>a,
			.attesaFeatBoxTitle .entry-title,
			.site-social-header a,
			.site-social-float a,
			.prev_next_buttons a,
			.attesa-main-menu-container.open_pushmenu .attesa-close-pushmenu,
			form.attesa-pro-ajax-search-shortocode button i {
				color: '. esc_html($generalTextColor).';
			}
			button:hover,
			input[type="button"]:hover,
			input[type="reset"]:hover,
			input[type="submit"]:hover,
			button:active, button:focus,
			input[type="button"]:active,
			input[type="button"]:focus,
			input[type="reset"]:active,
			input[type="reset"]:focus,
			input[type="submit"]:active,
			input[type="submit"]:focus,
			.main-navigation ul ul a,
			.navigation.pagination .nav-links a:hover,
			.navigation.pagination .nav-links a:focus,
			.page-links a:hover,
			.page-links a:focus,
			.widget_tag_cloud a:hover,
			.widget_tag_cloud a:focus,
			.widget_tag_cloud a:active, 
			.hamburger-menu .menu__line,
			.hamburger-menu .menu__plus,
			.entry-footer .read-more a:hover,
			.entry-footer .read-more a:focus,
			.entry-footer .read-more a:active,
			.aLoader2,	
			.attesaFeatBoxContainer .attesaproFeatBoxButton a:hover,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a:focus,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a:active,
			.square-full-screen,
			.attesa-infinite-button-container .attesa-infinite-scroll-more-button:hover,
			.attesa-infinite-button-container .attesa-infinite-scroll-more-button:focus,
			.attesa-infinite-button-container .attesa-infinite-scroll-more-button:active {
				background-color: '.esc_html($generalTextColor).';
			}
			.hamburger-menu .menu__circle {
				border-color: '.esc_html($generalTextColor).';
			}
			.aLoader1 {
				border-top-color: '.esc_html($generalTextColor).';
			}
			@media all and (max-width: 1025px) {
				.main-navigation ul ul a,
				.main-navigation ul li .indicator:before {
					color: '.esc_html($generalTextColor).' !important;
				}
			}';
			/* Choose general background color */
			$generalBackgroundColor = apply_filters( 'attesa_general_background_color', attesa_options('_general_background_color', '#ffffff') );
			$attesa_custom_css .='
			.attesaLoader,
			.attesa-site-wrap,
			#masthead.menuMinor,
			body:not(.withOverlayMenu) #masthead,
			#masthead .nav-middle.fixed,
			.awp-ajax-search.shortcode .awp-search-results {
				background-color: '.esc_html($generalBackgroundColor).';
			}
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.main-navigation>div>ul>li.attesaMenuButton>a,
			.main-navigation>div>ul>li.attesaMenuButton>a:hover,
			.main-navigation>div>ul>li.attesaMenuButton>a:focus,
			.main-navigation>div>ul>li.attesaMenuButton>a:active,
			#toTop,
			.main-navigation ul ul a,
			.navigation.pagination .nav-links a,
			.page-links a,
			.navigation.pagination .nav-links a:hover,
			.navigation.pagination .nav-links a:focus,
			.page-links a:hover,
			.page-links a:focus,
			ul.products li.product .tinvwl_add_to_wishlist_button,
			.attesaFeatBoxContainer .attesaproFeatBoxButton a,
			.attesa-menu-badge {
				color: '.esc_html($generalBackgroundColor).';
			}
			.main-navigation ul li.attesaMenuButton .indicator:before {
				color: '.esc_html($generalBackgroundColor).' !important;
			}
			@media all and (max-width: 1025px) {
				.attesa-main-menu-container {
					background-color: '.esc_html($generalBackgroundColor).';
				}
				.main-navigation>div ul li.attesaMenuButton a,
				.main-navigation>div ul li.attesaMenuButton a:hover,
				.main-navigation>div ul li.attesaMenuButton a:focus,
				.main-navigation>div ul li.attesaMenuButton a:active {
					color: '.esc_html($generalBackgroundColor).' !important;
				}
			}';
			/* Choose alternative background color */
			$alternativeBackgroundColor = apply_filters( 'attesa_alternative_background_color', attesa_options('_alternative_background_color', '#fbfbfb') );
			$attesa_custom_css .='
			input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
			textarea,
			select,
			header.page-header,
			.site-social-float a,	
			#comments .reply,
			.prev_next_buttons a,
			.attesa-pro-sharing-box-container,
			.attesa-breadcrumbs,
			.rank-math-breadcrumb,
			.attesa-main-menu-container.open_pushmenu .attesa-close-pushmenu,
			.wp-block-image,
			.bypostauthor>article,
			.attesa-related-list {
				background-color: '.esc_html($alternativeBackgroundColor).';
			}
			.widget_tag_cloud a,
			.entry-footer .read-more a,
			.attesa-pro-sharing-box-container.style_astheme a:hover,
			.attesa-pro-sharing-box-container.style_astheme a:focus,
			.attesa-pro-sharing-box-container.style_astheme a:active,
			.attesa-infinite-button-container .attesa-infinite-scroll-more-button {
				color: '.esc_html($alternativeBackgroundColor).';
			}';
			/* Choose content text color */
			$contentTextColor = apply_filters( 'attesa_content_text_color', attesa_options('_content_text_color', '#828282') );
			$attesa_custom_css .='
				.entry-content,
				.entry-summary,
				.entry-meta,
				.entry-meta a,
				.entry-footer span a,
				.attesa-pro-sharing-box a {
					color: '.esc_html($contentTextColor).';
				}
			';
			/* Choose general border color */
			$generalBorderColor = apply_filters( 'attesa_general_border_color', attesa_options('_general_border_color', '#ececec') );
			$attesa_custom_css .='
			hr,
			.site-social-widget .attesa-social {
				background-color: '.esc_html($generalBorderColor).';
			}
			input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
			textarea,
			select,
			.site-main .comment-navigation,
			.site-main .posts-navigation,
			.site-main .post-navigation,
			.site-main .navigation.pagination,
			.authorAbout,
			.relatedBox,
			header.page-header,	
			.site-social-float a,
			.hentry,
			#comments ol .pingback,
			#comments ol article,
			#comments .reply,
			#payment .payment_methods li,
			fieldset,
			.attesa-pro-sharing-box-container,
			.attesa-breadcrumbs,
			.rank-math-breadcrumb,
			.attesa-main-menu-container.open_pushmenu .attesa-close-pushmenu,
			.wp-block-image,
			.awp-ajax-search.shortcode .awp-search-results ul li,
			.relatedBox.list .theImgRelated {
				border-color: '.esc_html($generalBorderColor).';
			}
			@media all and (max-width: 1025px) {
				.main-navigation li,
				.main-navigation ul li .indicator,
				.main-navigation>div>ul>li>ul.sub-menu,
				.attesa-main-menu-container {
					border-color: '.esc_html($generalBorderColor).';
				}
			}';
			/* Choose top bar colors */
			if (apply_filters( 'attesa_show_top_bar', attesa_options('_show_topbar', '1'))) {
				$topbarBackgroundColor = apply_filters( 'attesa_topbar_background_color', attesa_options('_topbar_background_color', '#fbfbfb') );
				$topbarTextColor = apply_filters( 'attesa_topbar_text_color', attesa_options('_topbar_text_color', '#828282') );
				$topbarBorderColor = apply_filters( 'attesa_topbar_border_color', attesa_options('_topbar_border_color', '#ececec') );
				$attesa_custom_css .='
				.nav-top,
				.search-icon .circle,
				.search-container {
					background-color: '.esc_html($topbarBackgroundColor).';
				}
				.third-navigation li.attesaMenuButton a,
				.nav-top .attesa-menu-badge{
					color: '.esc_html($topbarBackgroundColor).';
				}
				.nav-top {
					border-color: '.esc_html($topbarBorderColor).';
				}
				.nav-top,
				.top-block-left a,
				.top-block-left a:hover,
				.top-block-left a:focus,
				.top-block-left a:active,
				.third-navigation li a,
				.search-icon .circle,
				.search-container input[type="search"],
				.search-container input[type="search"]:focus,
				.top-block-left .site-social-top a {
					color: '.esc_html($topbarTextColor).';
				}
				.search-container input[type="search"]::placeholder {
					color: '.esc_html($topbarTextColor).';
				}
				.search-container input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($topbarTextColor).';
				}
				.search-container input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($topbarTextColor).';
				}
				.search-icon .handle,
				.search-icon .handle:after {
					background-color: '.esc_html($topbarTextColor).';
				}';
			}
			if ( is_active_sidebar( attesa_get_classic_sidebar() ) && attesa_check_bar('classic') ) {
				/* Choose classic sidebar link color */
				$classicSidebarLinkColor = apply_filters( 'attesa_classicsidebar_link_color', attesa_options('_classicsidebar_link_color', '#f06292') );
				$attesa_custom_css .='
				#secondary .sidebar-container a,
				#secondary .attesa-contact-info i {
					color: '.esc_html($classicSidebarLinkColor).';
				}
				#secondary .widget_tag_cloud a,
				#secondary button,
				#secondary input[type="button"],
				#secondary input[type="reset"],
				#secondary input[type="submit"],
				#secondary #wp-calendar>caption,
				#secondary .attesaMenuButton {
					background-color: '.esc_html($classicSidebarLinkColor).';
				}
				#secondary input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#secondary textarea:focus,
				#secondary #wp-calendar tbody td#today,
				#secondary .awp-ajax-search.shortcode .awp-search-results.filled {
					border-color: '.esc_html($classicSidebarLinkColor).';
				}';
				/* Choose classic sidebar text color */
				$classicSidebarTextColor = apply_filters( 'attesa_classicsidebar_text_color', attesa_options('_classicsidebar_text_color', '#404040') );
				$attesa_custom_css .='
				#secondary .sidebar-container,
				#secondary .sidebar-container a:hover,
				#secondary .sidebar-container a:focus,
				#secondary .sidebar-container a:active,
				#secondary ul.product-categories li a:before,
				#secondary input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#secondary textarea,
				#secondary input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#secondary textarea:focus,
				#secondary .attesa-contact-info a,
				#secondary form.attesa-pro-ajax-search-shortocode button i {
					color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary .widget_tag_cloud a:hover,
				#secondary .widget_tag_cloud a:focus,
				#secondary .widget_tag_cloud a:active,
				#secondary button:hover,
				#secondary input[type="button"]:hover,
				#secondary input[type="reset"]:hover,
				#secondary input[type="submit"]:hover,
				#secondary button:active,
				#secondary button:focus,
				#secondary input[type="button"]:active,
				#secondary input[type="button"]:focus,
				#secondary input[type="reset"]:active,
				#secondary input[type="reset"]:focus,
				#secondary input[type="submit"]:active,
				#secondary input[type="submit"]:focus,
				#secondary .attesa-menu-badge {
					background-color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary input[type="search"]::placeholder {
					color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($classicSidebarTextColor).';
				}
				#secondary input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($classicSidebarTextColor).';
				}';
				/* Choose classic sidebar background color */
				$classicSidebarBackgroundColor = apply_filters( 'attesa_classicsidebar_background_color', attesa_options('_classicsidebar_background_color', '#fbfbfb') );
				$attesa_custom_css .='
				#secondary .sidebar-container,
				#secondary input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#secondary textarea,
				#secondary .awp-ajax-search.shortcode .awp-search-results {
					background-color: '.esc_html($classicSidebarBackgroundColor).';
				}
				#secondary button,
				#secondary input[type="button"],
				#secondary input[type="reset"],
				#secondary input[type="submit"],
				#secondary #wp-calendar>caption,
				#secondary .widget_tag_cloud a,
				#secondary .widget_tag_cloud a:hover,
				#secondary .widget_tag_cloud a:focus,
				#secondary .widget_tag_cloud a:active,
				#secondary .attesaMenuButton a,
				#secondary .attesaMenuButton a:hover,
				#secondary .attesaMenuButton a:focus,
				#secondary .attesaMenuButton a:active,
				#secondary .attesa-menu-badge {
					color: '.esc_html($classicSidebarBackgroundColor).';
				}';
				/* Choose classic sidebar border color */
				$classicSidebarBorderColor = apply_filters( 'attesa_classicsidebar_border_color', attesa_options('_classicsidebar_border_color', '#ececec') );
				$attesa_custom_css .='
				#secondary .sidebar-container,
				#secondary .widget .widget-title .widgets-heading,
				#secondary input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#secondary textarea,
				#secondary #wp-calendar tbody td,
				#secondary fieldset,
				#secondary .awp-ajax-search.shortcode .awp-search-results ul li {
					border-color: '.esc_html($classicSidebarBorderColor).';
				}
				#secondary ul.menu .indicatorBar,
				#secondary ul.product-categories .indicatorBar,
				#secondary .site-social-widget .attesa-social,
				#secondary .attesa-contact-info i {
					background-color: '.esc_html($classicSidebarBorderColor).';
				}';
			}
			if ( is_active_sidebar( attesa_get_push_sidebar() ) && attesa_check_bar('push') ) {
				/* Choose push sidebar link color */
				$pushSidebarLinkColor = apply_filters( 'attesa_pushsidebar_link_color', attesa_options('_pushsidebar_link_color', '#f06292') );
				$attesa_custom_css .='
				#tertiary a,
				#tertiary .attesa-contact-info i {
					color: '.esc_html($pushSidebarLinkColor).';
				}
				#tertiary .widget_tag_cloud a,
				#tertiary button,
				#tertiary input[type="button"],
				#tertiary input[type="reset"],
				#tertiary input[type="submit"],
				#tertiary #wp-calendar>caption,
				#tertiary .attesaMenuButton {
					background-color: '.esc_html($pushSidebarLinkColor).';
				}
				#tertiary input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#tertiary textarea:focus,
				#tertiary #wp-calendar tbody td#today,
				#tertiary .awp-ajax-search.shortcode .awp-search-results.filled {
					border-color: '.esc_html($pushSidebarLinkColor).';
				}';
				/* Choose push sidebar text color */
				$pushSidebarTextColor = apply_filters( 'attesa_pushsidebar_text_color', attesa_options('_pushsidebar_text_color', '#909090') );
				list($rp, $gp, $bp) = sscanf($pushSidebarTextColor, '#%02x%02x%02x');
				$attesa_custom_css .='
				#tertiary,
				#tertiary a:hover,
				#tertiary a:focus,
				#tertiary a:active,
				#tertiary ul.product-categories li a:before,
				#tertiary input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#tertiary textarea,
				#tertiary input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#tertiary textarea:focus,
				#tertiary .close-hamburger,
				#tertiary .attesa-contact-info a,
				#tertiary form.attesa-pro-ajax-search-shortocode button i {
					color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary .widget_tag_cloud a:hover,
				#tertiary .widget_tag_cloud a:focus,
				#tertiary .widget_tag_cloud a:active,
				#tertiary button:hover,
				#tertiary input[type="button"]:hover,
				#tertiary input[type="reset"]:hover,
				#tertiary input[type="submit"]:hover,
				#tertiary button:active,
				#tertiary button:focus,
				#tertiary input[type="button"]:active,
				#tertiary input[type="button"]:focus,
				#tertiary input[type="reset"]:active,
				#tertiary input[type="reset"]:focus,
				#tertiary input[type="submit"]:active,
				#tertiary input[type="submit"]:focus,
				#tertiary .close-ham-inner:before,
				#tertiary .close-ham-inner:after,
				#tertiary .attesa-menu-badge {
					background-color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary input[type="search"]::placeholder {
					color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($pushSidebarTextColor).';
				}
				#tertiary input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($pushSidebarTextColor).';
				}';
				/* Choose push sidebar background color */
				$pushSidebarBackgroundColor = apply_filters( 'attesa_pushsidebar_background_color', attesa_options('_pushsidebar_background_color', '#fbfbfb') );
				$attesa_custom_css .='
				#tertiary,
				#tertiary input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#tertiary textarea,
				#tertiary .awp-ajax-search.shortcode .awp-search-results {
					background-color: '.esc_html($pushSidebarBackgroundColor).';
				}
				#tertiary button,
				#tertiary input[type="button"],
				#tertiary input[type="reset"],
				#tertiary input[type="submit"],
				#tertiary #wp-calendar>caption,
				#tertiary .widget_tag_cloud a,
				#tertiary .widget_tag_cloud a:hover,
				#tertiary .widget_tag_cloud a:focus,
				#tertiary .widget_tag_cloud a:active,
				#tertiary .attesaMenuButton a,
				#tertiary .attesaMenuButton a:hover,
				#tertiary .attesaMenuButton a:focus,
				#tertiary .attesaMenuButton a:active,
				#tertiary .attesa-menu-badge {
					color: '.esc_html($pushSidebarBackgroundColor).';
				}';
				/* Choose push sidebar border color */
				$pushSidebarBorderColor = apply_filters( 'attesa_pushsidebar_border_color', attesa_options('_pushsidebar_border_color', '#ececec') );
				$attesa_custom_css .='
				#tertiary,
				#tertiary .widget .widget-title .widgets-heading,
				#tertiary input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				#tertiary textarea,
				#tertiary #wp-calendar tbody td,
				#tertiary,
				#tertiary fieldset,
				#tertiary .awp-ajax-search.shortcode .awp-search-results ul li {
					border-color: '.esc_html($pushSidebarBorderColor).';
				}
				#tertiary ul.menu .indicatorBar,
				#tertiary ul.product-categories .indicatorBar,
				#tertiary .site-social-widget .attesa-social,
				#tertiary .attesa-contact-info i {
					background-color: '.esc_html($pushSidebarBorderColor).';
				}';
				/* Scrollbar color */
				$attesa_custom_css .='
					#tertiary .nano-content {
						scrollbar-color: '.esc_html($pushSidebarTextColor).' '.esc_html($pushSidebarBorderColor).';
					}
					#tertiary .nano-content::-webkit-scrollbar-track {
						background: '.esc_html($pushSidebarBorderColor).';
					}
					#tertiary .nano-content::-webkit-scrollbar-thumb {
						background-color: '.esc_html($pushSidebarTextColor).';
					}
				';
			}
			if ( attesa_check_bar('footer') ) {
				/* Choose footer link color */
				$footerLinkColor = apply_filters( 'attesa_footer_link_color', attesa_options('_footer_link_color', '#aeaeae') );
				$attesa_custom_css .='
				.footerArea a,
				.footerArea .attesa-contact-info i {
					color: '.esc_html($footerLinkColor).';
				}
				.footerArea .widget_tag_cloud a,
				.footerArea button,
				.footerArea input[type="button"],
				.footerArea input[type="reset"],
				.footerArea input[type="submit"],
				.footerArea #wp-calendar>caption,
				.footerArea .attesaMenuButton {
					background-color: '.esc_html($footerLinkColor).';
				}
				.footerArea input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				.footerArea textarea:focus,
				.footerArea #wp-calendar tbody td#today,
				.footerArea .awp-ajax-search.shortcode .awp-search-results.filled {
					border-color: '.esc_html($footerLinkColor).';
				}';
				/* Choose footer text color */
				$footerTextColor = apply_filters( 'attesa_footer_text_color', attesa_options('_footer_text_color', '#f0f0f0') );
				$attesa_custom_css .='
				.footerArea,
				.footerArea a:hover,
				.footerArea a:focus,
				.footerArea a:active,
				.footerArea ul.product-categories li a:before,
				.footerArea input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				.footerArea textarea,
				.footerArea input[type]:focus:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				.footerArea textarea:focus,
				.footerArea .attesa-contact-info a,
				.footerArea form.attesa-pro-ajax-search-shortocode button i {
					color: '.esc_html($footerTextColor).';
				}
				.footerArea .widget_tag_cloud a:hover,
				.footerArea .widget_tag_cloud a:focus,
				.footerArea .widget_tag_cloud a:active,
				.footerArea button:hover,
				.footerArea input[type="button"]:hover,
				.footerArea input[type="reset"]:hover,
				.footerArea input[type="submit"]:hover,
				.footerArea button:active,
				.footerArea button:focus,
				.footerArea input[type="button"]:active,
				.footerArea input[type="button"]:focus,
				.footerArea input[type="reset"]:active,
				.footerArea input[type="reset"]:focus,
				.footerArea input[type="submit"]:active,
				.footerArea input[type="submit"]:focus,
				.footerArea .attesa-menu-badge {
					background-color: '.esc_html($footerTextColor).';
				}
				.footerArea input[type="search"]::placeholder {
					color: '.esc_html($footerTextColor).';
				}
				.footerArea input[type="search"]:-ms-input-placeholder {
					color: '.esc_html($footerTextColor).';
				}
				.footerArea input[type="search"]::-ms-input-placeholder {
					color: '.esc_html($footerTextColor).';
				}';
				/* Choose footer background color */
				$footerBackgroundColor = apply_filters( 'attesa_footer_background_color', attesa_options('_footer_background_color', '#3f3f3f') );
				$attesa_custom_css .='
				.footerArea,
				.footerArea input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				.footerArea textarea,
				.footerArea .awp-ajax-search.shortcode .awp-search-results {
					background-color: '.esc_html($footerBackgroundColor).';
				}
				.footerArea button,
				.footerArea input[type="button"],
				.footerArea input[type="reset"],
				.footerArea input[type="submit"],
				.footerArea #wp-calendar>caption,
				.footerArea .widget_tag_cloud a,
				.footerArea .widget_tag_cloud a:hover,
				.footerArea .widget_tag_cloud a:focus,
				.footerArea .widget_tag_cloud a:active,
				.footerArea .attesaMenuButton a,
				.footerArea .attesaMenuButton a:hover,
				.footerArea .attesaMenuButton a:focus,
				.footerArea .attesaMenuButton a:active,
				.footerArea .attesa-menu-badge {
					color: '.esc_html($footerBackgroundColor).';
				}';
				/* Choose footer border color */
				$footerBorderColor = apply_filters( 'attesa_footer_border_color', attesa_options('_footer_border_color', '#bcbcbc') );
				$attesa_custom_css .='
				.footerArea .widget .widget-title .widgets-heading,
				.footerArea input[type]:not([type="button"]):not([type="reset"]):not([type="submit"]):not([type="file"]):not([type="hidden"]):not([type="image"]):not([type="checkbox"]),
				.footerArea textarea,
				.footerArea #wp-calendar tbody td,
				.footerArea fieldset,
				.footerArea .awp-ajax-search.shortcode .awp-search-results ul li {
					border-color: '.esc_html($footerBorderColor).';
				}
				.footerArea ul.menu .indicatorBar,
				.footerArea ul.product-categories .indicatorBar,
				.footerArea .site-social-widget .attesa-social,
				.footerArea .attesa-contact-info i {
					background-color: '.esc_html($footerBorderColor).';
				}';
			}
			if (attesa_options('_show_subfooter', '1')) {
				/* Choose sub-footer link color */
				$subfooterLinkColor = apply_filters( 'attesa_subfooter_link_color', attesa_options('_subfooter_link_color', '#9a9a9a') );
				$attesa_custom_css .='
				.footer-bottom-area a {
					color: '.esc_html($subfooterLinkColor).';
				}
				.footer-bottom-area .attesaMenuButton,
				.footer-bottom-area .attesa-menu-badge {
					background-color: '.esc_html($subfooterLinkColor).';
				}';
				/* Choose sub-footer text color */
				$subfooterTextColor = apply_filters( 'attesa_subfooter_text_color', attesa_options('_subfooter_text_color', '#ffffff') );
				$attesa_custom_css .='
				.footer-bottom-area,
				.footer-bottom-area a:hover,
				.footer-bottom-area a:focus,
				.footer-bottom-area a:active,
				.footer-bottom-area .attesa-menu-badge {
					color: '.esc_html($subfooterTextColor).';
				}';
				/* Choose sub-footer background color */
				$subfooterBackgroundColor = apply_filters( 'attesa_subfooter_background_color', attesa_options('_subfooter_background_color', '#181818') );
				$attesa_custom_css .='
				.footer-bottom-area {
					background-color: '.esc_html($subfooterBackgroundColor).';
				}
				.second-navigation li.attesaMenuButton a {
					color: '.esc_html($subfooterBackgroundColor).';
				}';
			}
			if (apply_filters( 'attesa_filter_use_header_colors', attesa_options('_activate_header_custom_colors', ''))) {
				/* Choose header background color */
				$headerBackgroundColor = apply_filters( 'attesa_header_background_color', attesa_options('_header_background_color', '#ffffff') );
				$attesa_custom_css .='
					body:not(.withOverlayMenu) #masthead,
					#masthead.menuMinor,
					#masthead .nav-middle.fixed {
						background-color: '.esc_html($headerBackgroundColor).';
					}
					.main-navigation>div>ul>li.attesaMenuButton>a,
					.main-navigation>div>ul>li.attesaMenuButton>a:hover,
					.main-navigation>div>ul>li.attesaMenuButton>a:focus,
					.main-navigation>div>ul>li.attesaMenuButton>a:active,
					button.menu-toggle,
					.attesa-search-button-mobile input[type="submit"],
					.attesa-menu-badge {
						color: '.esc_html($headerBackgroundColor).';
					}
					.main-navigation ul li.attesaMenuButton .indicator:before {
						color: '.esc_html($headerBackgroundColor).' !important;
					}
					@media all and (max-width: 1025px) {
						.attesa-main-menu-container {
							background-color: '.esc_html($headerBackgroundColor).';
						}
						.main-navigation>div ul li.attesaMenuButton a,
						.main-navigation>div ul li.attesaMenuButton a:hover,
						.main-navigation>div ul li.attesaMenuButton a:focus,
						.main-navigation>div ul li.attesaMenuButton a:active {
							color: '.esc_html($headerBackgroundColor).' !important;
						}
					}
				';
				/* Choose header link color */
				$headerLinkColor = apply_filters( 'attesa_header_link_color', attesa_options('_header_link_color', '#f06292') );
				$attesa_custom_css .='
					.site-branding .site-title a,
					.menustyle_default>div>ul>li:hover>a,
					.menustyle_default>div>ul>li:focus>a,
					.menustyle_default>div>ul>.current_page_item>a,
					.menustyle_default>div>ul>.current-menu-item>a,
					.menustyle_default>div>ul>.current_page_ancestor>a,
					.menustyle_default>div>ul>.current-menu-ancestor>a,
					.menustyle_default>div>ul>.current_page_parent>a,
					.site-social-header a:hover,
					.site-social-header a:focus,
					.site-social-header a:active {
						color: '.esc_html($headerLinkColor).';
					}
					.main-navigation>div>ul>li>a::before,
					.main-navigation-popup>div ul li a::before,
					.main-navigation .attesaMenuButton,
					button.menu-toggle,
					.attesa-search-button-mobile input[type="submit"],
					.attesa-menu-badge {
						background-color: '.esc_html($headerLinkColor).';
					}
					.attesa-search-button-mobile input[type="search"]:focus,
					.attesa-search-button-popup input[type="search"]:focus {
						border-color: '.esc_html($headerLinkColor).';
					}
				';
				/* Choose header text color */
				$headerTextColor = apply_filters( 'attesa_header_text_color', attesa_options('_header_text_color', '#404040') );
				$attesa_custom_css .='
					.main-navigation>div>ul>li>a,
					.site-social-header a,
					.site-branding .site-title a:hover,
					.site-branding .site-title a:focus,
					.site-branding .site-title a:active,
					.site-branding .site-description,
					.attesa-search-button-mobile input[type="search"] {
						color: '.esc_html($headerTextColor).';
					}
					.hamburger-menu .menu__line,
					.hamburger-menu .menu__plus,
					.square-full-screen {
						background-color: '.esc_html($headerTextColor).';
					}
					.hamburger-menu .menu__circle {
						border-color: '.esc_html($headerTextColor).';
					}
					@media all and (max-width: 1025px) {
						.main-navigation ul ul a,
						.main-navigation ul li .indicator:before {
							color: '.esc_html($headerTextColor).' !important;
						}
						.main-navigation li,
						.main-navigation ul li .indicator,
						.main-navigation>div>ul>li>ul.sub-menu,
						.attesa-search-button-mobile input[type="search"] {
							border-color: '.esc_html($headerTextColor).';
						}
					}
				';
			}
		$attesa_css_output = attesa_minify_css(apply_filters( 'attesa_custom_css_style_filter', $attesa_custom_css ));
		wp_add_inline_style( 'attesa-style', $attesa_css_output );
	}
	add_action('wp_enqueue_scripts', 'attesa_custom_css_styles');
}