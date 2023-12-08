<?php

add_action( 'after_setup_theme', function () {
	register_nav_menus( [
		'main-menu'   => esc_html__( 'Primary', 'lemon' ),
		'quicklinks-menu' => esc_html__( 'Quick Links', 'lemon' ),
		'privacy-menu' => esc_html__( 'Privacy Policy', 'lemon' ),
		'mobile-menu' => esc_html__( 'Mobile Menu', 'lemon' )
	] );
} );
