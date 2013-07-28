<?php namespace Frenesie\Localization;

use Illuminate\Support\ServiceProvider;

class LocalizationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('frenesie/localization');

		$this->bootLocaleHandler();
	}


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerLocaleRequest();
		$this->registerLocaleUrlGenerator();
	}

	/**
	 * Register locale request.
	 * 
	 * @return void
	 */
	protected function registerLocaleRequest()
	{
		$this->app['request'] = $this->app->share(function($app)
		{
			return LocaleRequest::createFromGlobals();
		});
	}

	/**
	 * Register the locale url generator.
	 * 
	 * @return void
	 */
	protected function registerLocaleUrlGenerator()
	{
		$this->app['url'] = $this->app->share(function($app)
		{
			$routes = $app['router']->getRoutes();

			return new LocaleUrlGenerator($routes, $app['request']);
		});
	}

	/**
	 * Boot locale handler.
	 * 
	 * @return void
	 */
	protected function bootLocaleHandler()
	{
		$locales = $this->app['config']->get('localization::localization.locales', array());

		// Here, we will check to see if the incoming request begins with any of the
		// supported locales. If it does, we will set that locale as this default
	    // for an application and remove it from the current request path info.
	    $locale = $this->app['request']->segment(1);

	    if (array_key_exists($locale, $locales))
	    {
	    	$this->app->setLocale($locale);

	    	$this->app['url']->setPrefix($locale);

	    	$this->app['request']->handleUriLocales(array_keys($locales));
	    }
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}