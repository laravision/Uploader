<?php

namespace Laravision\Visiteur\Http\Ip\Drivers; 

class IpInfo
{
 
 	 public static $curl = "https://ipinfo.io/";
 	 public static $format = '/json';
	
 	 public static function find($ip){
 

 	 	try {
            return json_decode(file_get_contents(self::$curl.$ip.self::$format),true);
 
        } catch (\Exception $e) {
            return false;
        }

 	 }



}