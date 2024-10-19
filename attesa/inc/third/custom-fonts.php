<?php
/**
 * Attesa support for Custom Fonts plugin https://wordpress.org/plugins/custom-fonts/
 *
 * Show in the Attesa customizer all the fonts uploaded on the plugin
 *
 * @package AttesaWP
 */
if ( ! class_exists( 'Attesa_CustomFonts' ) ) {
	
	class Attesa_CustomFonts {
		/**
		 * Main Class Constructor
		 *
		 * @since 1.2.6
		 */
		public function __construct() {
			add_filter( 'attesa_custom_fonts_register', array( $this, 'add_attesa_font') );
		}
	
		/* Fires all custom fonts uploaded in the plugin and set them in Attesa Customizer */
		public function add_attesa_font( $attesa_fonts ) {

			$fonts = Bsf_Custom_Fonts_Taxonomy::get_fonts();
			
			if ( ! empty( $fonts ) ) {
				
				foreach ( $fonts as $font_family_name => $fonts_url ) {
					$attesa_fonts[$font_family_name] = $font_family_name;
				}
				
			}
			return $attesa_fonts;
		}
	}
}
new Attesa_CustomFonts();