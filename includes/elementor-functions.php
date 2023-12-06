<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Site Settings Controls.
 */

add_action( 'elementor/init', 'lemon_elementor_settings_init' );

function lemon_elementor_settings_init() {
	if ( lemon_header_footer_experiment_active() ) {
		require 'settings/settings-header.php';
		require 'settings/settings-footer.php';

		add_action( 'elementor/kit/register_tabs', function( \Elementor\Core\Kits\Documents\Kit $kit ) {
			$kit->register_tab( 'lemon-settings-header', LemonElementor\Includes\Settings\Settings_Header::class );
			$kit->register_tab( 'lemon-settings-footer', LemonElementor\Includes\Settings\Settings_Footer::class );
		}, 1, 40 );
	}
}

/**
 * Helper function to return a setting.
 *
 * Saves 2 lines to get kit, then get setting. Also caches the kit and setting.
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function lemon_elementor_get_setting( $setting_id ) {
	global $lemon_elementor_settings;

	$return = '';

	if ( ! isset( $lemon_elementor_settings['kit_settings'] ) ) {
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();
		$lemon_elementor_settings['kit_settings'] = $kit->get_settings();
	}

	if ( isset( $lemon_elementor_settings['kit_settings'][ $setting_id ] ) ) {
		$return = $lemon_elementor_settings['kit_settings'][ $setting_id ];
	}

	return apply_filters( 'lemon_elementor_' . $setting_id, $return );
}

/**
 * Helper function to show/hide elements
 *
 * This works with switches, if the setting ID that has been passed is toggled on, we'll return show, otherwise we'll return hide
 *
 * @param  string $setting_id
 * @return string|array same as the Elementor internal function does.
 */
function lemon_show_or_hide( $setting_id ) {
	return ( 'yes' === lemon_elementor_get_setting( $setting_id ) ? 'show' : 'hide' );
}

/**
 * Helper function to translate the header layout setting into a class name.
 *
 * @return string
 */
function lemon_get_header_layout_class() {
	$layout_classes = [];

	$header_layout = lemon_elementor_get_setting( 'lemon_header_layout' );
	if ( 'inverted' === $header_layout ) {
		$layout_classes[] = 'header-inverted';
	} elseif ( 'stacked' === $header_layout ) {
		$layout_classes[] = 'header-stacked';
	}

	$header_width = lemon_elementor_get_setting( 'lemon_header_width' );
	if ( 'full-width' === $header_width ) {
		$layout_classes[] = 'header-full-width';
	}

	$header_menu_dropdown = lemon_elementor_get_setting( 'lemon_header_menu_dropdown' );
	if ( 'tablet' === $header_menu_dropdown ) {
		$layout_classes[] = 'menu-dropdown-tablet';
	} elseif ( 'mobile' === $header_menu_dropdown ) {
		$layout_classes[] = 'menu-dropdown-mobile';
	} elseif ( 'none' === $header_menu_dropdown ) {
		$layout_classes[] = 'menu-dropdown-none';
	}

	$lemon_header_menu_layout = lemon_elementor_get_setting( 'lemon_header_menu_layout' );
	if ( 'dropdown' === $lemon_header_menu_layout ) {
		$layout_classes[] = 'menu-layout-dropdown';
	}

	return implode( ' ', $layout_classes );
}

/**
 * Helper function to translate the footer layout setting into a class name.
 *
 * @return string
 */
function lemon_get_footer_layout_class() {
	$footer_layout = lemon_elementor_get_setting( 'lemon_footer_layout' );

	$layout_classes = [];

	if ( 'inverted' === $footer_layout ) {
		$layout_classes[] = 'footer-inverted';
	} elseif ( 'stacked' === $footer_layout ) {
		$layout_classes[] = 'footer-stacked';
	}

	$footer_width = lemon_elementor_get_setting( 'lemon_footer_width' );

	if ( 'full-width' === $footer_width ) {
		$layout_classes[] = 'footer-full-width';
	}

	if ( lemon_elementor_get_setting( 'lemon_footer_copyright_display' ) && '' !== lemon_elementor_get_setting( 'lemon_footer_copyright_text' ) ) {
		$layout_classes[] = 'footer-has-copyright';
	}

	return implode( ' ', $layout_classes );
}

add_action( 'elementor/editor/after_enqueue_scripts', function() {
	if ( lemon_header_footer_experiment_active() ) {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script(
			'lemon-theme-editor',
			get_template_directory_uri() . '/assets/js/lemon-editor' . $suffix . '.js',
			[ 'jquery', 'elementor-editor' ],
			LEMON_ELEMENTOR_VERSION,
			true
		);

		wp_enqueue_style(
			'lemon-editor',
			get_template_directory_uri() . '/editor' . $suffix . '.css',
			[],
			LEMON_ELEMENTOR_VERSION
		);
	}
} );

add_action( 'wp_enqueue_scripts', function() {
	if ( ! lemon_header_footer_experiment_active() ) {
		return;
	}

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script(
		'lemon-theme-frontend',
		get_template_directory_uri() . '/assets/js/lemon-frontend' . $suffix . '.js',
		[ 'jquery' ],
		'1.0.0',
		true
	);

	\Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
} );


/**
 * Helper function to decide whether to output the header template.
 *
 * @return bool
 */
function lemon_get_header_display() {
	$is_editor = isset( $_GET['elementor-preview'] );

	return (
		$is_editor
		|| lemon_elementor_get_setting( 'lemon_header_logo_display' )
		|| lemon_elementor_get_setting( 'lemon_header_tagline_display' )
		|| lemon_elementor_get_setting( 'lemon_header_menu_display' )
	);
}

/**
 * Helper function to decide whether to output the footer template.
 *
 * @return bool
 */
function lemon_get_footer_display() {
	$is_editor = isset( $_GET['elementor-preview'] );

	return (
		$is_editor
		|| lemon_elementor_get_setting( 'lemon_footer_logo_display' )
		|| lemon_elementor_get_setting( 'lemon_footer_tagline_display' )
		|| lemon_elementor_get_setting( 'lemon_footer_menu_display' )
		|| lemon_elementor_get_setting( 'lemon_footer_copyright_display' )
	);
}

/**
 * Add lemon Theme Header & Footer to Experiments.
 */
add_action( 'elementor/experiments/default-features-registered', function( \Elementor\Core\Experiments\Manager $experiments_manager ) {
	$experiments_manager->add_feature( [
		'name' => 'lemon-theme-header-footer',
		'title' => __( 'lemon Theme Header & Footer', 'lemon-main' ),
		'description' => sprintf( __( 'Use this experiment to design header and footer using Elementor Site Settings. <a href="%s" target="_blank">Learn More</a>', 'lemon-main' ), 'https://go.elementor.com/wp-dash-header-footer' ),
		'release_status' => $experiments_manager::RELEASE_STATUS_STABLE,
		'new_site' => [
			'minimum_installation_version' => '3.3.0',
			'default_active' => $experiments_manager::STATE_ACTIVE,
		],
	] );
} );

/**
 * Helper function to check if Header & Footer Experiment is Active/Inactive
 */
function lemon_header_footer_experiment_active() {
	// If Elementor is not active, return false
	if ( ! did_action( 'elementor/loaded' ) ) {
		return false;
	}
	// Backwards compat.
	if ( ! method_exists( \Elementor\Plugin::$instance->experiments, 'is_feature_active' ) ) {
		return false;
	}

	return (bool) ( \Elementor\Plugin::$instance->experiments->is_feature_active( 'lemon-theme-header-footer' ) );
}
