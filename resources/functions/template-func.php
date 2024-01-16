<?php

if (!function_exists('lemon_single_template')) {
	/**
	 * Single template
	 */
	function lemon_single_template()
	{
		get_template_part('template-parts/single/single');
	}
}