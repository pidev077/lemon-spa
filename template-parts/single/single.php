
<?php if ( apply_filters( 'lemon_elementor_page_title', true ) ) : ?>
    <div class="page-header">
        <div class="container">
            <h1 class="entry-title"><?php echo get_the_archive_title(); ?></h1>
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
    </div>
<?php endif; ?>
<div class="lemon-single content-area">
    <div class="post-container">
        <?php if ( is_active_sidebar('blog-sidebar') ):?>
        <div class="posts-flex-box has-sidebar">
        <?php endif;?>

            <div class="post-content">
                <?php
                    $title       = get_the_title( );
                    $post_thumbnail = get_the_post_thumbnail( get_the_ID(), 'full' );
                    $post_date   = get_the_date( );

                    $post_author_id = get_post_field( 'post_author', get_the_ID() );
                    $post_author_name = get_the_author_meta( 'display_name', $post_author_id );
                    $post_author_url = get_author_posts_url( $post_author_id );

                    $taxonomies = get_object_taxonomies( get_post_type( get_the_ID() ) );
                    $taxonomies = array_diff($taxonomies, array(
                        'post_format',
                    ));
                
                    $tax_eles = '';

                    if (!empty($taxonomies)) {
                        $tax_eles .= '<div class="entry-taxonomies">';
                        foreach ($taxonomies as $key => $taxonomy) {
                            $terms = get_the_terms( get_the_ID(), $taxonomy );
                            $tax = get_taxonomy( $taxonomy );
                            $tax_label = $tax->label;
                            
                            if (!empty($terms)) {
                                $tax_eles .= '<div class="entry-taxonomy '.$taxonomy.'">';
                                    $tax_eles .= '<h4 class="entry-taxonomy-title">'.esc_attr( $tax_label ).':</h4>';
                                    foreach ( $terms as $i => $term ) {
                                        $term_link = get_term_link( $term );
                                        $tax_eles .= '<a href="'.esc_url( $term_link ).'">'.__($term->name, 'lemon').'</a>';
                                    }
                                $tax_eles .= '</div>';
                            }
                        }
                        $tax_eles .= '</div>';
                    }
                ?>
                <article id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>> 
                    <div class="single-entry-header">
                        <div class="featured-image"><?php echo $post_thumbnail; ?></div>
                        <?php do_action( 'lemon_hook_custom_social_share' ); ?>
                        <h2 class="post-title"><?php echo $title; ?></h2>
                        <div class="extra-meta">
                            <div class="post-author meta" titile="Post by">
                                <span><i class="fa fa-user"></i>By </span>
                                <a href="<?php echo esc_url( $post_author_url ); ?>" class="post-item__author-link link">
                                    <?php echo $post_author_name; ?>
                                </a>
                            </div>
                            <div class="post-date meta" title="Post date">
                                <span><i class="fa fa-calendar"></i></span>
                                <?php echo $post_date; ?>
                            </div>
                            <div class="post-total-comment meta" title="Comment">
                                <span><i class="fa fa-comments" aria-hidden="true"></i></span>
                                <?php echo get_comments_number().' Comments'; ?>
                            </div>
                        </div>
                        <?php echo $tax_eles; ?>
                    </div>
                    <div class="entry-content"> 
                        <?php the_content(); ?>
                    </div>
                </article>

                <?php do_action( 'lemon_hook_single_post_navigation' ); ?>

                <?php do_action( 'lemon_hook_single_post_related' ); ?>

                <?php comments_template(); ?>

            </div>

        <?php if ( is_active_sidebar('blog-sidebar') ):?>
            <div class="post-sidebar">
                <div class="post-sidebar-wrap">
                    <?php get_sidebar( 'blog' ); ?>
                </div>
            </div>
        </div>
        <?php endif;?>

    </div>
</div>
