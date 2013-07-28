<?php namespace Frenesie\Localization;

class Request extends \Illuminate\Http\Request {

	/**
	 * Setup the path info for a locale based URI.
	 * 
	 * @param  array  $locales
	 * @return string
	 */
	public function handleUriLocales(array $locales)
	{
		$locale = $this->segment(1);

		if (in_array($locale, $locales)) return $this->removeLocaleFromUri($locale);
	}

	/**
	 * Remove the given locale from the URI.
	 * 
	 * @param  string $locale
	 * @return string
	 */
	protected function removeLocaleFromUri($locale)
	{
		$this->pathInfo = '/'.ltrim(substr($this->getPathInfo(), strlen($locale) + 1), '/');

		return $locale;
	}
}