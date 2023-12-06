<?php
/**
 * Import pack data package demo
 *
 * @package Import Pack
 * @author BePlus
 */
$plugin_includes = array(
  array(
    'name'     => 'Elementor Website Builder',
    'slug'     => 'elementor',
  ),
  array(
    'name'     => 'Elementor Pro',
    'slug'     => 'elementor-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'elementor-pro.zip',
  ),
  array(
    'name'     => 'Lemon Addons', 
    'slug'     => 'lemon-addons', 
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'lemon-addons.zip',
  ),
  array(
    'name'     => 'Yoast SEO',
    'slug'     => 'wordpress-seo',
  ),
  array(
    'name'      => 'Prime Slider',
    'slug'      => 'bdthemes-prime-slider-lite', 
  ),
  array(
    'name'      => 'Woocommerce',
    'slug'      => 'woocommerce', 
  ),

);

return apply_filters( 'beplus/import_pack/package_demo', [
    [
        'package_name' => 'lemon-main',
        'preview' => IMPORT_URI . '/images/lemon-main-preview.png', // image size 680x475
        'url_demo' => 'https://lemonshop.beplusthemes.com/',
        'title' => __( 'Lemon Main', 'beplus' ),
        'description' => __( 'Lemon main demo, include home demos & full inner page (Contact, About, Company, blog, etc.).' ),
        'plugins' => $plugin_includes,
    ],
] );
