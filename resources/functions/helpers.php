<?php

/**
 * Check sidebar exists
 */
if (!function_exists('lemon_check_sidebars_widgets_exists')) {
	function lemon_check_sidebars_widgets_exists( $name = '' ){

		$sidebars_widgets = wp_get_sidebars_widgets();
	
		if( isset( $sidebars_widgets[$name] ) && !empty( $sidebars_widgets[$name] ) ){
			return true;
		}

		return false;
	}
}

// the blog posts navigation
if (!function_exists('lemon_blog_posts_navigation')) {
	function lemon_blog_posts_navigation()
	{
		global $wp_query;

		if ($wp_query->max_num_pages > 1) {
		?>
			<div class="navigation paging-navigation">
				<?php

				$animation = 'data-aos="fade-up" data-aos-duration="1000"';

				$pre_text = '← <strong>Newer</strong>';
				$next_text = '<strong>Older</strong> →</i>';

				$args = array(
					'format' => 'page/%#%',
					'current' => max(1, get_query_var('paged')),
					'total' => $wp_query->max_num_pages,
					'prev_next'          => false,
				);

				$pre_button = '<a href="javascript:void(0)" class="prev page-button disabled">' . __($pre_text, 'lemon') . '</a>';
				$next_button = '<a href="javascript:void(0)" class="next page-button disabled">' . __($next_text, 'lemon') . '</a>';

				$html = get_previous_posts_link($pre_text);
				$html .= '<div class="pagination-numbers-wrap">' . paginate_links($args) . '</div>';
				$html .= get_next_posts_link($next_text);

				$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;

				if (1 === $paged) {
					$html = $pre_button . $html;
				}

				if ($wp_query->max_num_pages ==  $paged) {
					$html = $html . $next_button;
				}

				echo '<div class="pagination loop-pagination" ' . $animation . '>';
				echo    $html;
				echo '</div>';

				?>
			</div>
		<?php

		}
	}
}

// the single posts navigation
if (!function_exists('lemon_single_post_navigation')) {
	function lemon_single_post_navigation()
	{
		// previous single post
		$prev_post = get_previous_post();

		// next single post
		$next_post = get_next_post();

		?>
		<div class="single-post-navigation post-navigation-skin--<?php echo get_post_type(); ?>">
			<div class="previous-next-link flex-sm-nowrap flex-wrap">
				<div class="previous">
				<?php if (!empty($prev_post)) : ?>
					<?php
						$prev_id = $prev_post->ID;
						$permalink_prev = get_permalink($prev_id);
					?>
					<a href="<?php echo esc_url($permalink_prev); ?>" class="post-nav-link" rel="prev">
						<div class="post-nav-thumbnail">
							<?php echo get_the_post_thumbnail($prev_id, 'thumbnail'); ?>
						</div>
						<div class="post-nav-title-box">
							<span class="meta-nav" aria-hidden="true">Previous Post</span>
							<div class="post-title">
								<?php echo get_the_title($prev_id); ?>
							</div>
						</div>
					</a>
					<?php endif; ?>
				</div>

				<div class="next">
				<?php if (!empty($next_post)) : ?>
					<?php
						$next_id = $next_post->ID;
						$permalink_next = get_permalink($next_id);
					?>
					<a href="<?php echo esc_url($permalink_next); ?>" class="post-nav-link" rel="next">
						<div class="post-nav-title-box">
							<span class="meta-nav" aria-hidden="true">Next Post</span>
							<div class="post-title">
								<?php echo get_the_title($next_id); ?>
							</div>
						</div>
						<div class="post-nav-thumbnail">
							<?php echo get_the_post_thumbnail($next_id, 'thumbnail'); ?>
						</div>
					</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}

// the single posts related
if (!function_exists('lemon_single_post_related')) {
	function lemon_single_post_related()
	{
		global $post;
		$post_type = get_post_type($post);

		$taxonomies = get_object_taxonomies($post_type);
		$taxs_query = array();
		$taxs_query['relation'] = 'OR';
		if (!empty($taxonomies)) {
			foreach ($taxonomies as $key => $taxonomy) {
				$terms = get_the_terms($post->ID, $taxonomy);
				if (!empty($terms)) {
					$term_ids = array();
					foreach ($terms as $i => $term) {
						array_push($term_ids, $term->term_id);
					}
					$item = array(
						'taxonomy' => $taxonomy,
						'field' => 'term_id',
						'terms' => $term_ids,
					);
					array_push($taxs_query, $item);
				}
			}
		}

		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => 3,
			'post_status' => 'publish',
			'post__not_in' => array($post->ID),
			'tax_query' => $taxs_query,
		);

		$article_query = new WP_Query($args);

		if ($article_query->have_posts()) {
		?>
			<div class="single-post-related">
				<div class="post-related-wrapper">
					<h3 class="post-related-title"><?php echo __('Related Articles', 'goza'); ?></h3>
					<div class="post-related-list">
						<?php
						while ($article_query->have_posts()) {
							$article_query->the_post();

							$post_date   = get_the_date( );
							$post_author_id = get_post_field( 'post_author', get_the_ID() );
							$post_author_name = get_the_author_meta( 'display_name', $post_author_id );
							$post_author_url = get_author_posts_url( $post_author_id );
						?>
							<div class="post-related-item">
								<a class="post-related-item__thumbnail" href="<?php echo esc_url(get_the_permalink()); ?>">
									<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
								</a>
								<div class="post-related-item__content">
									<a href="<?php echo esc_url(get_the_permalink()); ?>" class="post-related-item__title-link">
										<h3 class="post-related-item__title"><?php echo get_the_title(); ?></h3>
									</a>
									<div class="post-related-item__extra-meta">
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
								</div>

							</div>
						<?php

						}

						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		<?php
		}
	}
}

if (!function_exists('lemon_custom_social_share')) {
	function lemon_custom_social_share() {
		// Get current page URL
		$url = urlencode(get_permalink());
		// Get current page title
		$title = str_replace(' ', '%20', get_the_title());
		// Get post thumbnail
		$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
		// Get social media sharing links
		$twitter_url = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title;
		$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
		$whatsapp_url = 'whatsapp://send?text=' . $title . ' ' . $url;
		$instagram_url = 'https://www.instagram.com/myprograming?url=' . $url;
		$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title;
		$pinterest_url = 'https://www.pinterest.com/pin/create/button/?url=' . $url . '&media=' . $thumbnail[0] . '&description=' . $title;
		// Output social media share links
		echo '<div class="social-share-post">';
		echo '<div class="label">'.__('Share', 'lemon').'</div>';
		echo '<div class="share-post-wrap">';
		echo '<a class="share-post-item" href="' . $twitter_url . '" target="_blank"><i class="fa fa-twitter"></i></a>';
		echo '<a class="share-post-item" href="' . $facebook_url . '" target="_blank"><i class="fa fa-facebook"></i></a>';
		echo '<a class="share-post-item" href="' . $whatsapp_url . '" target="_blank"><i class="fa fa-whatsapp"></i></a>';
		echo '<a class="share-post-item" href="' . $instagram_url . '" target="_blank"><i class="fa fa-instagram"></i></a>';
		echo '<a class="share-post-item" href="' . $linkedin_url . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
		echo '<a class="share-post-item" href="' . $pinterest_url . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
		echo '</div>';
		echo '</div>';
	}
}