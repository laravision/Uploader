<?php

namespace Laravision\Visiteur\Http\Ip\Drivers; 

class GeoPlugin
{
 
 	 public static $curl = "http://www.geoplugin.net/";
 	 public static $format = 'json.gp?ip=';
	
 	 public static function find($ip){
 

 	 	try {
            return json_decode(file_get_contents(self::$curl.self::$format.$ip),true); 
        } catch (\Exception $e) {
            return false;
        }

 	 }



}