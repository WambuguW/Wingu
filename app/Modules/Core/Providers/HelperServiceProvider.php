<?php
namespace App\Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services
     * @return void
     */
    public function boot()
    {
        
    }
    
    /**
     * Register the application services
     * @return void
     */
    public function register()
    {
        foreach(glob(app_path().'/Modules/Core/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}
