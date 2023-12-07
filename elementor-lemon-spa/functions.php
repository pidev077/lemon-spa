<?php

add_action( 'wp_enqueue_scripts', 'lemon_wp_enqueue_scripts');

if( ! function_exists( 'lemon_wp_enqueue_scripts' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
    function lemon_wp_enqueue_scripts() {

        $min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style( 'elementor-lemon-button', get_stylesheet_directory_uri() . '/elementor-lemon-spa/assets/css/button' . $min_suffix . '.css', array(), LEMON_ELEMENTOR_VERSION );

    }
}