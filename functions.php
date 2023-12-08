<?php
/**
 * Theme functions and definitions
 *
 * @package LemonElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'LEMON_ELEMENTOR_VERSION', '2.6.1' );
define('THEME_VERSION', WP_DEBUG ? rand() : '1.0');
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());
define('THEME_URI_DIST', get_template_directory_uri() . '/dist');

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'lemon_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function lemon_elementor_setup() {
		if ( is_admin() ) {
			lemon_maybe_update_theme_version_in_db();
		}

		$hook_result = apply_filters_deprecated( 'elementor_lemon_theme_load_textdomain', [ true ], '2.0', 'lemon_elementor_load_textdomain' );
		if ( apply_filters( 'lemon_elementor_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'lemon-main', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'elementor_lemon_theme_register_menus', [ true ], '2.0', 'lemon_elementor_register_menus' );
		if ( apply_filters( 'lemon_elementor_register_menus', $hook_result ) ) {
			register_nav_menus( [ 'menu-1' => __( 'Header', 'lemon-main' ) ] );
			register_nav_menus( [ 'menu-2' => __( 'Footer', 'lemon-main' ) ] );
		}

		$hook_result = apply_filters_deprecated( 'elementor_lemon_theme_add_theme_support', [ true ], '2.0', 'lemon_elementor_add_theme_support' );
		if ( apply_filters( 'lemon_elementor_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			$hook_result = apply_filters_deprecated( 'elementor_lemon_theme_add_woocommerce_support', [ true ], '2.0', 'lemon_elementor_add_woocommerce_support' );
			if ( apply_filters( 'lemon_elementor_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'lemon_elementor_setup' );

function lemon_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'lemon_theme_version';
	// The theme version saved in the database.
	$lemon_theme_db_version = get_option( $theme_version_option_name );

	// If the 'lemon_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $lemon_theme_db_version || version_compare( $lemon_theme_db_version, LEMON_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, LEMON_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'lemon_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function lemon_elementor_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'elementor_lemon_theme_enqueue_style', [ true ], '2.0', 'lemon_elementor_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'lemon_elementor_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'lemon-main',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				LEMON_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'lemon_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'lemon-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				LEMON_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'lemon_elementor_scripts_styles' );

if ( ! function_exists( 'lemon_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function lemon_elementor_register_elementor_locations( $elementor_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'elementor_lemon_theme_register_elementor_locations', [ true ], '2.0', 'lemon_elementor_register_elementor_locations' );
		if ( apply_filters( 'lemon_elementor_register_elementor_locations', $hook_result ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'lemon_elementor_register_elementor_locations' );

if ( ! function_exists( 'lemon_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function lemon_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'lemon_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'lemon_elementor_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

/**
 * If Elementor is installed and active, we can load the Elementor-specific Settings & Features
*/

// Allow active/inactive via the Experiments
require get_template_directory() . '/includes/elementor-functions.php';

/**
 * Include customizer registration functions
*/
function lemon_register_customizer_functions() {
	if ( is_customize_preview() ) {
		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'lemon_register_customizer_functions' );

if ( ! function_exists( 'lemon_elementor_check_hide_title' ) ) {
	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function lemon_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'lemon_elementor_page_title', 'lemon_elementor_check_hide_title' );

/**
 * Wrapper function to deal with backwards compatibility.
 */
if ( ! function_exists( 'lemon_elementor_body_open' ) ) {
	function lemon_elementor_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}

/**
 * Theme install
 */
require get_template_directory() . '/install/plugin-required.php';
require  get_template_directory() . '/install/import-pack/functions.php';

/**
 * Validation form comment
 */
add_action('wp_footer', 'lemon_comment_validation_init');
function lemon_comment_validation_init(){
  if(comments_open() ) { ?>
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
      jQuery('#commentform').validate({
          rules: {
            author: {
              required: true,
              minlength: 2
            },
            email: {
              required: true,
              email: true
            },
            comment: {
              required: true,
              minlength: 20
            }
          },
          errorElement: "div",
          errorPlacement: function(error, element) {
            element.after(error);
          }
      });
    });
    </script>
    <?php
    }
}

require THEME_PATH . '/resources/functions/ajax.php';
require THEME_PATH . '/resources/functions/reset.php';
require THEME_PATH . '/resources/functions/initialize.php';
require THEME_PATH . '/resources/functions/assets.php';
require THEME_PATH . '/resources/functions/menus.php';
require THEME_PATH . '/resources/functions/widgets.php';
require THEME_PATH . '/resources/functions/post-types.php';
require THEME_PATH . '/resources/functions/meta.php';
require THEME_PATH . '/resources/functions/images.php';
require THEME_PATH . '/resources/functions/helpers.php';
require THEME_PATH . '/resources/functions/template-tags.php';
require THEME_PATH . '/resources/functions/hooks.php';
require THEME_PATH . '/resources/functions/template-func.php';