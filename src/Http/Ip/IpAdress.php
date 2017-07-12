<?php

namespace Laravision\Visiteur\Http\Ip; 
use Laravision\Visiteur\Http\Ip\Drivers\IpInfo;
use Laravision\Visiteur\Http\Ip\Drivers\FreeGeoIp;
use Laravision\Visiteur\Http\Ip\Drivers\GeoPlugin;
use Laravision\Visiteur\Http\Ip\Drivers\IPDB;

class IpAdress
{
 
 	public static function find($ip){
 
 		/*
			find in your session
			find in ipRegister
			find in drivers
 		*/
		if (\Session::has('ip_register')&&(\Session::get('ip_register')->ip == $ip)) { 
				return \Session::get('ip_register'); 
		}else{
			$ipRegister = self::getIpRegister();

			if (!empty($ipRegister->$ip)) {
				return $ipRegister->$ip;
			}else{
				$newIp = self::exec($ip);
				self::setIpRegister($ip,$newIp);
				\Session::put('ip_register',$newIp); 
			}
		} 

 	}
 
 	public static function log($ip){
		if ((\Session::has('ip_register'))&&(\Session::get('ip_register')->ip == $ip)) {   
		}else{
			$ipRegister = self::getIpRegister();

			if (empty($ipRegister->$ip)) { 
				$newIp = self::exec($ip);
				self::setIpRegister($ip,$newIp);
				\Session::put('ip_register',$newIp);  
			}
		}  
		return $ip;
 	}


 	public static function exec($ip){

 		$drivers = ['IpInfo','FreeGeoIp','GeoPlugin','IPDB'];

 		foreach ($drivers as $key => $item) {
 			$data = self::get($item,$ip); 
 			if (!empty($data)) { 
 				return $data;
 			}
 		}


 	}


 	public static function get($class,$ip){  

 		return self::filter(call_user_func_array(array("Laravision\Visiteur\Http\Ip\Drivers\\".$class, 'find'), array($ip)),$class,$ip); 
 	}


 	public static function filter($data,$class,$ip){


 		$filter = new IpAdress();
 		$filter->ip 			= $ip;
 		$filter->countryName 	= self::getCountryName($data,$class);
 		$filter->countryCode 	= self::getCountryCode($data,$class);
 		$filter->io 		 	= self::getIO($data,$class); 
 		$filter->map    	 	= self::getLocation($data,$class);
 		$filter->countryRegion 	= self::getCountryRegion($data,$class); 
 		$filter->countryCity 	= self::getCountryCity($data,$class); 

 		return $filter;
 		

 	}



 	public static function getCountryName($data,$class){ 
 		$countryName = ""; 
 			switch ($class) {
			    case 'IpInfo':
			        $countryName = (!empty($data['country']))? countryData('code',$data['country'],'name'): $countryName ; 
			        break;
			    case 'FreeGeoIp':
			        $countryName = (!empty($data['country_name']))?$data['country_name']:$countryName;
			        break;
			    case 'GeoPlugin':
			        $countryName = (!empty($data['geoplugin_countryName']))?$data['geoplugin_countryName']:$countryName;
			        break;
			    case 'IPDB':
			        $countryName = (!empty($data->countryName))?$data->countryName:$countryName;
			        break;  
			} 

		return $countryName;

 	}

 	public static function getCountryCode($data,$class){
 		$countryCode = "";
 		switch ($class) {
		    case 'IpInfo':
		        $countryCode = (!empty($data['country']))?$data['country']:$countryCode;
		        break;
		    case 'FreeGeoIp':
		        $countryCode = (!empty($data['country_code']))?$data['country_code']:$countryCode;
		        break;
		    case 'GeoPlugin':
		        $countryCode = (!empty($data['geoplugin_countryCode']))?$data['geoplugin_countryCode']:$countryCode;
		        break;
		    case 'IPDB':
		        $countryCode = (!empty($data->countryCode))?$data->countryCode:$countryCode;
		        break;  
		}

		return $countryCode;

 	}

 	public static function getCountryRegion($data,$class){
 		$countryRegion = "";
 		switch ($class) {
		    case 'IpInfo':
		        $countryRegion = (!empty($data['region']))?$data['region']:$countryRegion;
		        break;
		    case 'FreeGeoIp':
		        $countryRegion = (!empty($data['region_name']))?$data['region_name']:$countryRegion;
		        break;
		    case 'GeoPlugin':
		        $countryRegion = (!empty($data['geoplugin_regionName']))? $data['geoplugin_regionName']: $data['geoplugin_region'] ;
		        break;
		    case 'IPDB':
		        $countryRegion = "";
		        break;  
		}

		return $countryRegion;

 	}

 	public static function getCountryCity($data,$class){
 		$countryCity = "";
 		switch ($class) {
		    case 'IpInfo':
		        $countryCity = (!empty($data['city']))?$data['city']:$countryCity;
		        break;
		    case 'FreeGeoIp':
		        $countryCity = (!empty($data['city']))?$data['city']:$countryCity;
		        break;
		    case 'GeoPlugin':
		        $countryCity = (!empty($data['geoplugin_city']))?$data['geoplugin_city']:$countryCity;
		        break;
		    case 'IPDB':
		        $countryCity = "";
		        break;  
		}

		return $countryCity;

 	}

 	public static function getIO($data,$class){
 		/* Internet operators */
 		$io = "unknown";
 		switch ($class) {
		    case 'IpInfo':
		        $io = (!empty($data['org']))?$data['org']:$io;
		        break;
		    case 'FreeGeoIp':
		        $io = "unknown";
		        break;
		    case 'GeoPlugin':
		        $io = "unknown";
		        break;
		    case 'IPDB':
		        $io = "unknown";
		        break;  
		}

		return $io;

 	}

 	public static function getLocation($data,$class){ 

 		$location['x'] = '0';
 		$location['y'] = '0';
 		switch ($class) {
		    case 'IpInfo':
		    	if(!empty($data['loc'])&&!empty(explode(',', $data['loc'])[1])){
			        $location['x'] = explode(',', $data['loc'])[0];
			        $location['y'] = explode(',', $data['loc'])[1];
		        break;
		    	}
		    case 'FreeGeoIp':
		        $location['x'] = (!empty($data['latitude']))?$data['latitude']:$location['x'];
		        $location['y'] = (!empty($data['longitude']))?$data['longitude']:$location['y'];
		        break;
		    case 'GeoPlugin':
		        $location['x'] = (!empty($data['geoplugin_latitude']))?$data['geoplugin_latitude']:$location['x'];
		        $location['y'] = (!empty($data['geoplugin_longitude']))?$data['geoplugin_longitude']:$location['y'];
		        break;
		    case 'IPDB':
		        $location['x'] = "0";
		        $location['y'] = "0";
		        break;  
		}

		return json_decode(json_encode($location));

 	}

 	public static function getIpRegister(){  
 		$register = json_encode(array());
 		$registerDir = database_path('log');
 		$registerFile = $registerDir.'/ip_register.log';
 		\File::isDirectory($registerDir) or \File::makeDirectory($registerDir,0775,true,true); 
 		if (!file_exists($registerFile)) { 
 			file_put_contents($registerFile, $register);
 		}else{ 
 			$register = json_decode(file_get_contents($registerFile));
 		}

 		return $register;
 	}

 	public static function setIpRegister($ip,$data){ 
 		$registerFile = database_path('log/ip_register.log');
 		$register = (array)self::getIpRegister();
 		if (empty($register[$ip])) {
 			$register[$ip] = $data;
 			file_put_contents($registerFile, json_encode($register));
 		} 
 		return true;
 	}









}