<?php

if ( ! function_exists('switch_language'))
{
	/**
	 * Generate a HTML link to swich language.
	 *
	 * @param  string  $locale
	 * @param  string  $title
	 * @param  array   $attributes
	 * @param  bool    $secure
	 * @return string
	 */
	function switch_language($locale, $title = null, $attributes = array(), $secure = null)
	{
		return app('html')->link(app('url')->switchLanguage($locale), $title, $attributes, $secure);
	}
}