<?php
/**
 * The template for displaying search results.
 *
 * @package LemonElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="site-main" role="main">
	<?php if ( apply_filters( 'lemon_elementor_page_title', true ) ) : ?>
		<div class="page-header">
			<h1 class="entry-title">
				<?php esc_html_e( 'Search results for: ', 'lemon-main' ); ?>
				<span><?php echo get_search_query(); ?></span>
			</h1>
		</div>
	<?php endif; ?>
	<div class="page-content">
		<?php if ( have_posts() ) : ?>
			<div class="posts">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/posts/content','search' );

			endwhile;
			?>
			</div>

			<?php do_action('lemon_hook_blog_posts_navigation'); ?>

		<?php else : ?>
			<div class="not-found">
				<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'lemon-main' ); ?></p>
				<?php echo get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>
</main>
