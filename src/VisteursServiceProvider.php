<?php

namespace Laravision\Visiteur;  
use Session;
use Illuminate\Support\ServiceProvider;

class VisiteurServiceProvider extends ServiceProvider
{  
    public function boot() {
        define('root',__DIR__);
        /* include routes */
        require __DIR__ . '/Http/routes.php';  
        /* include helper */
        require __DIR__ . '/Http/helper.php';  

    } 

    public function register(){

    	/* get config file */
        $this->mergeConfigFrom(__DIR__ . '/config.php', 'laravision');
        /* load views */
        $this->loadViewsFrom(__DIR__ . '/views', 'Laravision-visiteur');

        /* publishe migrations files */
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')]); 
 

        $this->app->singleton('Lvisiteur', function ($app) {
              return new Visiteur();
          });

    }
}
