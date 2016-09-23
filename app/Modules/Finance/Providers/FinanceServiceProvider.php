<?php

namespace App\Modules\Finance\Providers;

use App;
use Config;
use Lang;
use View;
use Caffeinated\Modules\Support\ServiceProvider;

class FinanceServiceProvider extends ServiceProvider
{
	/**
	 * Register the Finance module service provider.
	 *
	 * This service provider is a convenient place to register your modules
	 * services in the IoC container. If you wish, you may make additional
	 * methods or service providers to keep the code more focused and granular.
	 *
	 * @return void
	 */
	public function register()
	{
		App::register('App\Modules\Finance\Providers\RouteServiceProvider');

		Lang::addNamespace('finance', realpath(__DIR__.'/../Resources/Lang'));
		View::addNamespace('finance', base_path('resources/views/vendor/finance'));
		View::addNamespace('finance', realpath(__DIR__.'/../Resources/Views'));
	}

	/**
	 * Bootstrap the application events.
	 *
	 * Here you may register any additional middleware provided with your
	 * module with the following addMiddleware() method. You may pass in
	 * either an array or a string.
	 *
	 * @return void
	 */
	public function boot()
	{
		// $this->addMiddleware('');
	}

	/**
	 * Additional Compiled Module Classes
	 *
	 * Here you may specify additional classes to include in the compiled file
	 * generated by the `artisan optimize` command. These should be classes
	 * that are included on basically every request into the application.
	 *
	 * @return array
	 */
	public static function compiles()
	{
		$basePath = realpath(__DIR__.'/../');

		return [
			// $basePath.'/example.php',
		];
	}
}
