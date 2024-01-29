<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package LemonElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
	?>

<main id="content" <?php post_class( 'site-main' ); ?> role="main">
	<div class="container">
		<?php if ( apply_filters( 'lemon_elementor_page_title', true ) ) : ?>
			<header class="page-header">
				<div class="container">
					<div class="entry-icon">
						<svg aria-hidden="true" class="e-font-icon-svg e-fas-leaf" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M546.2 9.7c-5.6-12.5-21.6-13-28.3-1.2C486.9 62.4 431.4 96 368 96h-80C182 96 96 182 96 288c0 7 .8 13.7 1.5 20.5C161.3 262.8 253.4 224 384 224c8.8 0 16 7.2 16 16s-7.2 16-16 16C132.6 256 26 410.1 2.4 468c-6.6 16.3 1.2 34.9 17.5 41.6 16.4 6.8 35-1.1 41.8-17.3 1.5-3.6 20.9-47.9 71.9-90.6 32.4 43.9 94 85.8 174.9 77.2C465.5 467.5 576 326.7 576 154.3c0-50.2-10.8-102.2-29.8-144.6z"></path></svg>			
					</div>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<div id="breadcrumbs" class="breadcrumbs">','</div>' );
					}else{
						if ( class_exists( 'woocommerce' ) ){
							woocommerce_breadcrumb();
						}
					}
					?>
				</div>
			</header>
		<?php endif; ?>
		<div class="page-content">
			<?php the_content(); ?>
			<div class="post-tags">
				<?php the_tags( '<span class="tag-links">' . __( 'Tagged ', 'lemon-main' ), null, '</span>' ); ?>
			</div>
			<?php wp_link_pages(); ?>
		</div>

		<?php comments_template(); ?>
	</div>
</main>

	<?php
endwhile;
