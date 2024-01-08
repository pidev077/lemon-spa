<?php

function lemon_get_assets($name, $extension)
{
	$manifest = lemon_get_manifest();
	$file = !empty($manifest['/' . $extension . '/' . $name . '.' . $extension]) ? $manifest['/' . $extension . '/' . $name . '.' . $extension] : false;
	if (!$file) {
		return false;
	}

	return THEME_URI_DIST . $file;
}

function lemon_get_manifest()
{

	$dir = THEME_PATH . '/dist/';

	if (file_exists($dir . 'mix-manifest.json')) {
		$manifest = json_decode(file_get_contents($dir . 'mix-manifest.json'), true);
	} else {
		$manifest = false;
	}

	return $manifest;
}

add_action('wp_enqueue_scripts', function () {

	$upload_dir = wp_upload_dir();

	// wp_enqueue_style('theme-font', THEME_URI . '/resources/assets/fonts/fonts.css', [], THEME_VERSION);
	//Global
	// wp_enqueue_style('lemon-theme-general-styles', $upload_dir['baseurl'] . '/styles_uploads/variable-css.css', [], THEME_VERSION);
	if (isset($_GET['home'])) {
		wp_enqueue_style('lemon-theme-home-styles', lemon_get_style_home($_GET['home']), [], THEME_VERSION);
	}
	
	wp_enqueue_style('app-styles', lemon_get_assets('theme', 'css'), [], THEME_VERSION);

	if( is_shop() || is_product_category() ) {
		wp_enqueue_style( 'select2' );
		wp_enqueue_script( 'select2' );
		wp_enqueue_script('lemon-woocommerce', THEME_URI . '/resources/assets/js/components/woocommerce.js', ['jquery'], THEME_VERSION, true);

	}
	// wp_enqueue_script('manifest-scripts', lemon_get_assets('manifest', 'js'), ['jquery'], THEME_VERSION, true);
	wp_enqueue_script('vendor-scripts', lemon_get_assets('vendor', 'js'), ['jquery'], THEME_VERSION, true);
	wp_enqueue_script('app-scripts', lemon_get_assets('theme', 'js'), ['jquery'], THEME_VERSION, true);

	wp_localize_script('app-scripts', 'php_data', [
		'admin_logged' => in_array('administrator', wp_get_current_user()->roles) ? 'yes' : 'no',
		'ajax_url'     => admin_url('admin-ajax.php')
	]);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
});




if (!function_exists('lemon_get_style_home')) {
	function lemon_get_style_home($home_name)
	{
		return THEME_URI . '/dist/css/' . $home_name . '.css';
	}
}
