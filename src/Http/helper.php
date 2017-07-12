<?php

/*
*	get country data from IPDB
*/


if (!function_exists('countryData')) {
	
	function countryData($el,$d,$r){
		/*
			$el = element findet
			$d  = data like $el 
			$r  = result item
		*/

		$countryDB = json_decode(file_get_contents(root.'/database/IPDB/country.json')); 
 	 	$data = "";

 	 	foreach ($countryDB as $key => $value) {
 	 		if ($value->$el == $d) {
 	 			$data = $value->$r;
 	 		}
 	 	}

 	 	return $data;

	}

}

/*
*	compare 2 array data key by key
*/


if (!function_exists('isDiff')) {
	
	function isDiff($old,$new){ 

		foreach ($old as $oldK => $oldV) {
			foreach ($new as $newK => $newV) {  
				if ($oldK == $newK) {
					if ($oldV != $newV) {  
						return true ;
					}
				}
			}
		} 
 
		return false;

	}

}

/*
*	get web page title
*/


if (!function_exists('pageTitle')) {
	
	function pageTitle($page_url){  
		
		$pg = $page_url;
	    if (!empty($page_url)) {
	    	$read_page=file_get_contents($page_url,true);
		    preg_match("/<title.*?>[\n\r\s]*(.*)[\n\r\s]*<\/title>/", $read_page, $page_title);
		    if (isset($page_title[1])){
				if ($page_title[1] == ''){
		            return $page_url;
		        }
		        $page_title = $page_title[1];
		        return trim($page_title);
		    } 
	    }
	    return $pg;

	}

}
