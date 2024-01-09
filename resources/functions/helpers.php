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
