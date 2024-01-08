<?php

/**
 * Load widgets
 */
require( __DIR__ . '/widget/loaded.php' );

/**
 * Register sidebars
 */
add_action( 'widgets_init', 'lemon_widgets_init' );
function lemon_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'lemon' ),
		'id'            => 'blog-sidebar',
		'before_widget' => '<div class="wg-wrap">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="wg-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'lemon' ),
		'id'            => 'shop-sidebar',
		'description'   => '',
		'before_widget' => '<div class="wg-wrap">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="wg-title">',
		'after_title'   => '</h2>',
	) );
}