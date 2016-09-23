<?php
namespace App\Modules\Exams\Providers;

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
        foreach(glob(app_path().'/Modules/Exams/Helpers/*.php') as $filename){
            require_once($filename);
        }
    }
}