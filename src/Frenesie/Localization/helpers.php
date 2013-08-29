<?php

if ( ! function_exists('link_to_language'))
{
	/**
	 * Generate a HTML link.
	 *
	 * @param  string  $url
	 * @param  string  $title
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return string
	 */
	function link_to_language($locale, $title = null, $attributes = array(), $secure = null)
	{
		return app('html')->link(app('url')->language($locale), $title, $attributes, $secure);
	}
}