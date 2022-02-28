<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.linkedin.com/in/miguel-mariano-developer/
 * @since      1.0.0
 *
 * @package    Draketech_Product_Carousel
 * @subpackage Draketech_Product_Carousel/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Draketech_Product_Carousel
 * @subpackage Draketech_Product_Carousel/includes
 * @author     Miguel Eduardo Mariano Lopez <miguel@blogscol.com>
 */
class Draketech_Product_Carousel_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'draketech-product-carousel',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
