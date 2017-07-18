<?php 

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
*	convert rules to array
*/


if (!function_exists('RulesArray')) {
	
	function RulesArray($rules){ 
		$data = [];
		$rules = explode('|', $rules);
		foreach ($rules as $key => $rule) {
			$r = explode(':', $rule);
			if (!empty($r[1])) {
				$op = explode(',', $r[1]);
				if (!empty($op[1])) {
					$data[$r[0]] = $op;
				}else{
					$data[$r[0]] = $r[1];
				}
			}else{
				$data[$r[0]] = true;
			}
		}
		return $data;

	}

} 
