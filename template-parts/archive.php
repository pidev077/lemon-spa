<?php
/**
 * The template for displaying archive pages.
 *
 * @package LemonElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$has_sidebar = lemon_check_sidebars_widgets_exists('blog-sidebar');
$classes = $has_sidebar ? 'column-left': '';

?>
<main id="content" class="site-main" role="main">
	<?php if ( apply_filters( 'lemon_elementor_page_title', true ) ) : ?>
		<header class="page-header">
			<div class="container">
				<?php
				$page_for_posts_id = get_option( 'page_for_posts' );
				$page_for_posts_obj = get_post( $page_for_posts_id );
				$blog_heading = ( is_archive() )? get_the_archive_title() : $page_for_posts_obj->post_title;
				?>
				<div class="entry-icon">
                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-leaf" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M546.2 9.7c-5.6-12.5-21.6-13-28.3-1.2C486.9 62.4 431.4 96 368 96h-80C182 96 96 182 96 288c0 7 .8 13.7 1.5 20.5C161.3 262.8 253.4 224 384 224c8.8 0 16 7.2 16 16s-7.2 16-16 16C132.6 256 26 410.1 2.4 468c-6.6 16.3 1.2 34.9 17.5 41.6 16.4 6.8 35-1.1 41.8-17.3 1.5-3.6 20.9-47.9 71.9-90.6 32.4 43.9 94 85.8 174.9 77.2C465.5 467.5 576 326.7 576 154.3c0-50.2-10.8-102.2-29.8-144.6z"></path></svg>			
                </div>
				<h1 class="entry-title"><?php echo $blog_heading; ?></h2>
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

	<div class="page-content <?php echo $has_sidebar ? 'has-sidebar' : ''; ?>">
		<div class="row">
			<div class="bt-content-area <?php echo esc_attr($classes); ?>">
				<div class="posts">
					<?php
					while ( have_posts() ) {
						the_post();

						get_template_part( 'template-parts/posts/content' );

						?>
					<?php } ?>
				</div>

				<?php do_action('lemon_hook_blog_posts_navigation'); ?>
				
			</div>
			<?php if( $has_sidebar ): ?>
			<div class="column-right sidebar blog-sidebar">
				<?php get_sidebar('blog'); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>	
</main>
