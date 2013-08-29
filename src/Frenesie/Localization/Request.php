<?php namespace Frenesie\Localization;

class Request extends \Illuminate\Http\Request {

	/**
	 * The global prefix for the request.
	 * 
	 * @var  string
	 */
	protected $prefix;

	/**
	 * Get the global prefix from the generator.
	 * 
	 * @return string
	 */
	public function getPrefix()
	{
		return isset($this->prefix) ? '/'.$this->prefix : '';
	}

	/**
	 * Set a global prefix on the generator.
	 * 
	 * @param  string  $prefix
	 * @return void
	 */
	public function setPrefix($prefix)
	{
		$this->prefix = $prefix;
	}

	/**
	 * Setup the path info for a locale based URI.
	 * 
	 * @param  array  $locales
	 * @return string
	 */
	public function handleUriLocales($locale)
	{
		$this->setPrefix($locale);

		return $this->removeLocaleFromUri($locale);
	}

	/**
	 * Remove the given locale from the URI.
	 * 
	 * @param  string $locale
	 * @return string
	 */
	public function removeLocaleFromUri($locale)
	{
		$this->pathInfo = '/'.ltrim(substr($this->getPathInfo(), strlen($locale) + 1), '/');

		return $locale;
	}

	/**
	 * Get the root URL for the application.
	 *
	 * @return string
	 */
	public function root($trueRoot = false)
	{
		$root = $this->getSchemeAndHttpHost().$this->getBaseUrl();

		if ( ! $trueRoot)
		{
			$root .= $this->getPrefix();
		}

		return rtrim($root, '/');
	}
}