<?php

namespace Laravision\Visiteur\Http;

use Closure;
use Laravision\Visiteur\Visiteur as Log;

class LaravisionVisiteurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('LOG_TIME')) {
            $timestart=microtime(true); 
        }
            
            Log::run(); 
         
        if (env('LOG_TIME')) {
            //Fin du code PHP
            $timeend=microtime(true);
            $time=$timeend-$timestart;
             
            //Afficher le temps d'éxecution
            $page_load_time = number_format($time, 3);
            echo "<div style='background-color:red;color:white;position:fixed;bottom:0;width: 100%;padding: 1% 2%;font-size: 2em;'>";
            echo "Debut du script: ".date("H:i:s", $timestart);
            echo "<br>Fin du script: ".date("H:i:s", $timeend);
            echo "<br>Script execute en " . $page_load_time . " sec";
            echo "</div>"; 
        }
        return $next($request);
    }
}
