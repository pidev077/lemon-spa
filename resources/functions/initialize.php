<?php
/**
 * Use this file for initialization of the theme.
 */
add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'fincorp', get_template_directory() . '/languages' ); 
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );

	add_theme_support( 'custom-logo');

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'build/editor.css' );

	add_theme_support('editor-color-palette', array(
		array(
			'name'  => 'General Colour',
			'slug'  => 'general',
			'color' => '#d41b65',
		),
		array(
			'name'  => 'Ngo Colour',
			'slug'  => 'ngo',
			'color' => '#ed9913',
		),
		array(
			'name'  => 'Dream Colour',
			'slug'  => 'dream',
			'color' => '#2c9cf2',
		),
		array(
			'name'  => 'Water Colour',
			'slug'  => 'water',
			'color' => '#833dcc',
		),
		array(
			'name'  => 'Charity Colour',
			'slug'  => 'charity',
			'color' => '#4ca5ab',
		),
		array(
			'name'  => 'Organization Colour',
			'slug'  => 'organization',
			'color' => '#ec5e87',
		),
		array(
			'name'  => 'Charity Green Colour',
			'slug'  => 'charity-green',
			'color' => '#71b61b',
		),
		array(
			'name'  => 'Ngo Dark Colour',
			'slug'  => 'ngo-dark',
			'color' => '#d94532',
		),
		array(
			'name'  => 'Water Charity Colour',
			'slug'  => 'water-charity',
			'color' => '#18b7d0',
		),
		array(
			'name'  => 'White Colour',
			'slug'  => 'white',
			'color' => '#FFF',
		),
		array(
			'name'  => 'Black Colour',
			'slug'  => 'black',
			'color' => '#000',
		)
	));

	// woocommerce
	add_theme_support('woocommerce');
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

} );
