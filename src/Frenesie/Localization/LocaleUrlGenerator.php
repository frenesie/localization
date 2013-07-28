<?php namespace Frenesie\Localization;

class LocaleUrlGenerator extends \Illuminate\Routing\UrlGenerator {

	/**
	 * The global prefix for the generator.
	 * 
	 * @var  string
	 */
	protected $prefix;

	/**
	 * Generate a absolute URL to the given path.
	 *
	 * @param  string  $path
	 * @param  mixed   $parameters
	 * @param  bool    $secure
	 * @return string
	 */
	public function to($path, $parameters = array(), $secure = null)
	{
		if ($this->isValidUrl($path)) return $path;

		$scheme = $this->getScheme($secure);

		// Once we have the scheme we will compile the "tail" by collapsing the values
		// into a single string delimited by slashes. This just makes it convenient
		// for passing the array of parameters to this URL as a list of segments.
		$tail = implode('/', (array) $parameters);

		$root = $this->getRootUrl($scheme);

		return trim($root.$this->getPrefix().'/'.trim($path.'/'.$tail, '/'), '/');
	}

	/**
	 * Get the URL to a named route.
	 *
	 * @param  string  $name
	 * @param  mixed   $parameters
	 * @param  bool    $absolute
	 * @return string
	 */
	public function route($name, $parameters = array(), $absolute = true)
	{
		$route = $this->routes->get($name);

		$parameters = (array) $parameters;

		if (isset($route) and $this->usingQuickParameters($parameters))
		{
			$parameters = $this->buildParameterList($route, $parameters);
		}

		// This is where we set the language prefix to the route.
		$route->setPath($this->getPrefix().$route->getPath());

		return $this->generator->generate($name, $parameters, $absolute);
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