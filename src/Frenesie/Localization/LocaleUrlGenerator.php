<?php namespace Frenesie\Localization;

class LocaleUrlGenerator extends \Illuminate\Routing\UrlGenerator {

	/**
	 * The global prefix for the generator.
	 * 
	 * @var  string
	 */
	protected $prefix;

	/**
	 * Format the given URL segments into a single URL.
	 *
	 * @param  string  $root
	 * @param  string  $path
	 * @param  string  $tail
	 * @return string
	 */
	protected function trimUrl($root, $path, $tail = '')
	{
		return trim($root.$this->getPrefix().'/'.trim($path.'/'.$tail, '/'), '/');
	}

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

}
