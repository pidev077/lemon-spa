<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package LemonElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="site-main" role="main">
	<div class="error-404">
		<?php if ( apply_filters( 'lemon_elementor_page_title', true ) ) : ?>
			<header class="page-header">
				<div class="container">
					<h1 class="entry-title"><?php esc_html_e( '404', 'lemon-main' ); ?></h1>
				</div>
			</header>
		<?php endif; ?>
		<div class="page-content">
			<h3><?php esc_html_e( 'Ohh! Page not found', 'lemon-main' ); ?></h3>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'lemon-main' ); ?></p>
			<div class="back-to-home">
				<a class="btn-go" href="/">Back To Home</a>
			</div>
			<?php echo get_search_form(); ?>
		</div>
	</div>
</main>
