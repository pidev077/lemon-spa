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
