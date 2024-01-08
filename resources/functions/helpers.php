<?php

/**
 * Check sidebar exists
 */
if (!function_exists('lemon_check_sidebars_widgets_exists')) {
	function lemon_check_sidebars_widgets_exists( $name = '' ){

		$sidebars_widgets = wp_get_sidebars_widgets();
	
		if( isset( $sidebars_widgets[$name] ) && !empty( $sidebars_widgets[$name] ) ){
			return true;
		}

		return false;
	}
}
