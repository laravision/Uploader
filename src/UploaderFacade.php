<?php

namespace Laravision\Uploader;   

use Illuminate\Support\Facades\Facade;

class UploaderFacade extends Facade 
{  

    protected static function getFacadeAccessor(){
        return 'Luploader';
    }
}
