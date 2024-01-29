<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( );

$has_sidebar = lemon_check_sidebars_widgets_exists('shop-sidebar');
$classes = $has_sidebar ? 'column-left': '';

?>


<?php
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action( 'woocommerce_before_main_content' );
?>
	<?php if ( apply_filters( 'lemon_elementor_page_title', true ) ) : ?>
		<div class="page-header">
            <div class="container">
                <div class="entry-icon">
                    <svg aria-hidden="true" class="e-font-icon-svg e-fas-leaf" viewBox="0 0 576 512" xmlns="http://www.w3.org/2000/svg"><path d="M546.2 9.7c-5.6-12.5-21.6-13-28.3-1.2C486.9 62.4 431.4 96 368 96h-80C182 96 96 182 96 288c0 7 .8 13.7 1.5 20.5C161.3 262.8 253.4 224 384 224c8.8 0 16 7.2 16 16s-7.2 16-16 16C132.6 256 26 410.1 2.4 468c-6.6 16.3 1.2 34.9 17.5 41.6 16.4 6.8 35-1.1 41.8-17.3 1.5-3.6 20.9-47.9 71.9-90.6 32.4 43.9 94 85.8 174.9 77.2C465.5 467.5 576 326.7 576 154.3c0-50.2-10.8-102.2-29.8-144.6z"></path></svg>			
                </div>
                <h1 class="entry-title"><?php echo get_the_archive_title(); ?></h1>
                <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<div id="breadcrumbs" class="breadcrumbs">','</div>' );
                }else{
                    woocommerce_breadcrumb();
                }
                
                ?>
            </div>
		</div>
	<?php endif; ?>
    <section class="main-woocommerce bt-section-space <?php echo $has_sidebar ? 'has-sidebar' : ''; ?>" role="main" itemprop="mainEntity" itemscope="itemscope" itemtype="http://schema.org/Blog">
        <div class="container">
            <div class="row">
                <div class="bt-content-area <?php echo esc_attr($classes); ?>">
                    <div class="bt-col-inner">
                            <?php
                                /**
                                 * woocommerce_archive_description hook.
                                 *
                                 * @hooked woocommerce_taxonomy_archive_description - 10
                                 * @hooked woocommerce_product_archive_description - 10
                                 */
                                do_action( 'woocommerce_archive_description' );
                            ?>

                            <?php if ( have_posts() ) : ?>
                                
                            <div class="woocommerce-toolbar">
                            <?php
                                /**
                                 * woocommerce_before_shop_loop hook.
                                 *
                                 * @hooked woocommerce_result_count - 20
                                 * @hooked woocommerce_catalog_ordering - 30
                                 */
                                do_action( 'woocommerce_before_shop_loop' );
                            ?>
                            </div>

                            <?php woocommerce_product_loop_start(); ?>
                    
                                <?php while ( have_posts() ) : the_post();?>
                            
                                    <?php wc_get_template_part( 'content', 'product' ); ?>
                        
                                <?php endwhile; // end of the loop. ?>
                            
                            <?php woocommerce_product_loop_end(); ?>

                            <?php
                                /**
                                 * woocommerce_after_shop_loop hook.
                                 *
                                 * @hooked woocommerce_pagination - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop' );
                            ?>

                        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

                            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

                        <?php endif; ?>
                    </div>
                </div><!-- /.bt-content-area-->
                <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked woocommerce_get_sidebar - 10
                     */
                    do_action( 'woocommerce_sidebar' );
                ?>
            </div><!-- /.row-->
        </div><!-- /.container-->
    </section>
<?php
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action( 'woocommerce_after_main_content' );
?>


<?php get_footer( ); ?>
