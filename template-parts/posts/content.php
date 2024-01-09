<?php
    /**
     * Template part for displaying content post
     * @package goza
     */


	$animation = 'data-aos="fade-up" data-aos-duration="1000"';

    $post_id     = get_the_ID();
    $thumbnail   = get_the_post_thumbnail( );
    $title       = get_the_title( );
    $post_date   = get_the_date( );
    $post_categories = get_the_category( );
    $post_link = get_the_permalink();
    $excerpt = get_the_excerpt();

    $post_author_id = get_post_field( 'post_author', $post_id );
    $post_author_name = get_the_author_meta( 'display_name', $post_author_id );
    $post_author_url = get_author_posts_url( $post_author_id );
?>

<article <?php echo $animation; ?> <?php post_class('post-item'); ?>>
    <?php if( !empty( $thumbnail ) ): ?>
    <a href="<?php echo esc_url( $post_link ); ?>" class="post-item__featured-thumbnail">
        <div class="thumbnail-overlay"></div>
        <?php echo $thumbnail; ?>
    </a>
    <?php endif; ?>
    <div class="post-item__content">
        <?php if( !empty($post_categories ) ){ ?>
        <div class="post-item__cats-meta meta">
            <?php
            echo '<div class="post-item__extra-meta-cats">';
            foreach ( $post_categories as $key => $cat) {
                $cat_id = $cat->term_id;
                $cat_link = get_term_link( $cat, 'category' );
                $cat_name = $cat->name;
                echo '<a href="'.esc_url( $cat_link ).'" class="category link">'.__( $cat_name, 'goza' ).'</a>';
                if ( $key < count($post_categories) - 1 ) {
                    echo ',';
                }
            }
            echo '</div>';
            ?>
        </div>
        <?php } ?>
        <a href="<?php echo esc_url( $post_link ); ?>" class="post-item__title-link">
            <h3 class="post-item__title"><?php echo __( $title, 'goza'); ?></h3>
        </a>
        <div class="post-item__extra-meta">
            <div class="post-item__date meta">
                <?php echo $post_date; ?>
            </div>
            <div class="post-item__author meta">
                <span>by </span>
                <a href="<?php echo esc_url( $post_author_url ); ?>" class="post-item__author-link link"><?php echo $post_author_name; ?></a>
            </div>
        </div>
        <?php if ( $excerpt ) {
            ?><div class="post-item__excerpt"><?php echo $excerpt; ?></div><?php
        } ?>
        
        <a href="<?php echo esc_url( $post_link ); ?>" class="post-item__readmore-btn"><?php echo __('Read More', 'goza'); ?></a>
    </div>
</article>