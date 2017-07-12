<?php

namespace Laravision\Visiteur\Http\Ip\Drivers;  

class IPDB
{
 
	
 	 public static function find($ip){ 
 	 		$file = intval((round(intval($ip / 5), 0, PHP_ROUND_HALF_ODD) * 5) + 5);
			ini_set("memory_limit",-1); 
			$database = json_decode(file_get_contents(root.'/database/IPDB/dbip-'.$file.'.json')); 
			foreach ($database as $key => $value) {
				$minIp = $value[0];
				$maxIp = $value[1];
				if (
						(intval($minIp) <= explode('.', $ip)[0])
						&&
						(intval($maxIp) >= explode('.', $ip)[0])
						&&
						(explode('.', $minIp)[1] <= explode('.', $ip)[1])
						&&
						(explode('.', $maxIp)[1] >= explode('.', $ip)[1])
						&&
						(explode('.', $minIp)[2] <= explode('.', $ip)[2])
						&&
						(explode('.', $maxIp)[2] >= explode('.', $ip)[2])
						&&
						(explode('.', $minIp)[3] <= explode('.', $ip)[3])
						&&
						(explode('.', $maxIp)[3] >= explode('.', $ip)[3])
					) {
					return self::ipdata($value,$ip);
				}
			} 

 	 }


 	 public static function ipdata($v,$i){


 	 	$data = new IPDB();
 	 	$data->ip =  $i;
 	 	$data->countryCode = $v[2];
 	 	$data->countryName = countryData('code',$v[2],'name');

 	 	return $data;
 	 }
 



}