<?php namespace Frenesie\Localization;

class LocaleUrlGenerator extends \Illuminate\Routing\UrlGenerator {

	/**
	 * Default locale of the application.
	 * 
	 * @var  string
	 */
	protected $defautLocale;

	/**
	 * Set the application default locale.
	 * 
	 * @param  string  $locale
	 * @return void
	 */
	public function setDefaultLocale($locale)
	{
		$this->defaultLocale = $locale;
	}

	/**
	 * Get the url with a new language.
	 * 
	 * @param  string  $locale
	 * @return string
	 */
	public function language($locale, $parameters = array(), $secure = null)
	{
		// Get the root without the locale.
		$root = $this->request->root(true);

		$root .= ($this->defaultLocale != $locale) ? '/'.$locale : '';

		return $this->to($root.$this->request->getPathInfo(), $parameters, $secure);
	}

}
