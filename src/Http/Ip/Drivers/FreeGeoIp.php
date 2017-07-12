<?php

namespace Laravision\Visiteur\Http\Ip\Drivers; 

class FreeGeoIp
{
 
 	 public static $curl = "http://freegeoip.net/";
 	 public static $format = 'json/';/*csv,xml,json*/
	
 	 public static function find($ip){ 

 	 	try {
            return json_decode(file_get_contents(self::$curl.self::$format.$ip),true); 
        } catch (\Exception $e) {
            return false;
        }

 	 }



}