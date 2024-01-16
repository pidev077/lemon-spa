<?php

/**
 * Hooks.
 */
function add_file_types_to_uploads($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$new_filetypes['json'] = 'application/json';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

// woocommerce sidebar
add_action('wp', function () {
	remove_action('woocommerce_sidebar', 'generate_construct_sidebars');

	if( !is_product() ){
		add_action('woocommerce_sidebar', function () {
			get_sidebar('woocommerce');
		});
	}

});

// customize the archive title
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = get_the_author();
	} elseif (is_tax()) { //for custom post types
		$title = sprintf(__('%1$s'), single_term_title('', false));
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});

/**
 * navigation template
 * @return void
 */
add_action('lemon_hook_blog_posts_navigation', 'lemon_blog_posts_navigation');

add_filter('next_posts_link_attributes', 'lemon_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'lemon_posts_link_attributes');

function lemon_posts_link_attributes() {
  return 'class="page-button"';
}

// Remove the default content product part
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// Add the default content product part
add_action( 'woocommerce_before_shop_loop_item', 'lemon_woocommerce_before_shop_loop_item_func', 9 );
function lemon_woocommerce_before_shop_loop_item_func() {
	global $product;
	$product_id = $product->get_id();
	?>
	<div class="woocommerce-loop-product__header" data-product-id="<?php echo $product_id; ?>">
		<div class="woocommerce-loop-product__overlay"></div>
	<?php
		the_post_thumbnail();
		woocommerce_template_loop_add_to_cart();
	?>
	</div>
	<?php
}
add_action( 'woocommerce_after_shop_loop_item', 'lemon_woocommerce_after_shop_loop_item_func', 20 );
function lemon_woocommerce_after_shop_loop_item_func() {
	?>
	<div class="woocommerce-loop-product__bottom">
	<?php
		woocommerce_template_loop_rating();
		woocommerce_template_loop_price();
	?>
	</div>
	<?php
}

// woocommerce loop add to cart link
add_filter( 'woocommerce_loop_add_to_cart_link', 'lemon_woocommerce_loop_add_to_cart_link_func', 10, 3 );
function lemon_woocommerce_loop_add_to_cart_link_func( $add_to_cart_html, $product, $args ){

	$icon = '<span class="icon">
		<svg class="svg-icon" width="16" height="16" fill="#FFFFFF" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="-35 0 512 512.00102">
			<path d="m443.054688 495.171875-38.914063-370.574219c-.816406-7.757812-7.355469-13.648437-15.15625-13.648437h-73.140625v-16.675781c0-51.980469-42.292969-94.273438-94.273438-94.273438-51.984374 0-94.277343 42.292969-94.277343 94.273438v16.675781h-73.140625c-7.800782 0-14.339844 5.890625-15.15625 13.648437l-38.9140628 370.574219c-.4492192 4.292969.9453128 8.578125 3.8320308 11.789063 2.890626 3.207031 7.007813 5.039062 11.324219 5.039062h412.65625c4.320313 0 8.4375-1.832031 11.324219-5.039062 2.894531-3.210938 4.285156-7.496094 3.835938-11.789063zm-285.285157-400.898437c0-35.175782 28.621094-63.796876 63.800781-63.796876 35.175782 0 63.796876 28.621094 63.796876 63.796876v16.675781h-127.597657zm-125.609375 387.25 35.714844-340.097657h59.417969v33.582031c0 8.414063 6.824219 15.238282 15.238281 15.238282s15.238281-6.824219 15.238281-15.238282v-33.582031h127.597657v33.582031c0 8.414063 6.824218 15.238282 15.238281 15.238282 8.414062 0 15.238281-6.824219 15.238281-15.238282v-33.582031h59.417969l35.714843 340.097657zm0 0"></path>
		</svg>
	</span>';

	$icon_readmore = '<span class="icon">
		<svg class="svg-icon" width="16" height="16" fill="#FFFFFF" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.005 512.005" style="enable-background:new 0 0 512.005 512.005;" xml:space="preserve">
			<path d="M234.672,181.399V42.668c0-4.309-2.603-8.213-6.592-9.835c-3.989-1.685-8.576-0.747-11.627,2.304L3.12,248.471    c-4.16,4.16-4.16,10.923,0,15.083l213.333,213.333c2.048,2.027,4.779,3.115,7.552,3.115c1.365,0,2.752-0.256,4.075-0.811    c3.989-1.643,6.592-5.547,6.592-9.856V331.052c46.208,2.304,226.496,17.835,256.427,119.957c1.515,5.077,6.549,8.363,11.755,7.552    c5.248-0.768,9.152-5.248,9.152-10.56C512.005,203.287,284.635,182.913,234.672,181.399z M224.091,309.335    c-3.243,0.427-5.568,1.088-7.595,3.093c-2.027,2.005-3.157,4.736-3.157,7.573v123.584L25.755,256.001L213.339,68.418v123.584    c0,2.901,1.173,5.653,3.264,7.68c2.069,2.005,4.736,3.328,7.765,2.987l3.349-0.043c40.661,0,231.488,10.133,259.499,197.099    C414.619,312.236,232.923,309.42,224.091,309.335z"></path>
			</svg>
	</span>';

	$button_text = '<span class="text">'.$product->add_to_cart_text().'</span>';
	$button = ( ( ! $product->is_in_stock() )? $icon_readmore : $icon ) . $button_text;
	return sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		__( $button, 'lemon' )
	);
}

// single template
add_action('lemon_hook_single', 'lemon_single_template');

// single post navigation
add_action('lemon_hook_single_post_navigation', 'lemon_single_post_navigation');

// single post related
add_action('lemon_hook_single_post_related', 'lemon_single_post_related');

// single post related
add_action('lemon_hook_custom_social_share', 'lemon_custom_social_share');


