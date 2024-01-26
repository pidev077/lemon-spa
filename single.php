<?php
/**
 * The template for displaying all single posts.
 *
 * @package goza
 */
?>
<?php get_header();?>
<main id="primary" class="site-main">
    <?php if ( have_posts() ) : ?>
        <?php do_action( 'lemon_hook_single' ); ?>
    <?php endif;?>       
</main>    
<?php get_footer(); ?>