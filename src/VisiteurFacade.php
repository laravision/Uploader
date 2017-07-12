<?php

namespace Laravision\Visiteur;   

use Illuminate\Support\Facades\Facade;

class VisiteurFacade extends Facade 
{  

    protected static function getFacadeAccessor(){
        return 'Lvisiteur';
    }
}
