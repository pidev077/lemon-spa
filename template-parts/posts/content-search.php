<?php
    /**
     * Template part for displaying content post
     * @package goza
     */


	$animation = 'data-aos="fade-up" data-aos-duration="1000"';

    $post_id     = get_the_ID();
    $post_type     = get_post_type( );
    $title       = get_the_title( );
    $post_date   = get_the_date( );
    $post_link = get_the_permalink();
    $excerpt = get_the_excerpt();

    $post_author_id = get_post_field( 'post_author', $post_id );
    $post_author_name = get_the_author_meta( 'display_name', $post_author_id );
    $post_author_url = get_author_posts_url( $post_author_id );
?>

<article <?php post_class('post-item'); ?>>
    <div class="post-item__content">
        <div class="post-item__post-type"><?php echo __( $post_type, 'lemon-main'); ?></div>
        <a href="<?php echo esc_url( $post_link ); ?>" class="post-item__title-link">
            <h3 class="post-item__title"><?php echo __( $title, 'lemon-main'); ?></h3>
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
    </div>
</article>