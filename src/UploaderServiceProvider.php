<?php

namespace Laravision\Uploader;  
use Session;
use Illuminate\Support\ServiceProvider;

class UploaderServiceProvider extends ServiceProvider
{  
    public function boot() {
        /* include routes */
        require __DIR__ . '/Http/routes.php';  
        /* include helper */
        require __DIR__ . '/Http/helper.php';  

    } 

    public function register(){

    	/* get config file */
        //$this->mergeConfigFrom(__DIR__ . '/config.php', 'laravision');
        /* load views */
        $this->loadViewsFrom(__DIR__ . '/views', 'Laravision-uploader');

        /* publishe migrations files */
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')]); 
        /* publishe media model */
        $this->publishes([__DIR__ . '/Http/Models/' => base_path('app/Models')]); 
 

        $this->app->singleton('Luploader', function ($app) {
              return new Uploader();
          });

    }
}
