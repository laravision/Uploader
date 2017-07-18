<?php

namespace Laravision\Uploader; 
 
use Carbon\Carbon; 
use App\Models\Media;

class Uploader
{ 
	
 	public static function run($file,$options=[]){  
 		$dist = (!empty($options['dist']))?$options['dist']:'';
 		$name = (!empty($options['name']))?$options['name']:'';
 		$type = (!empty($options['type']))?$options['type']:'image';
 		$rules = (!empty($options['rules']))?$options['rules']:[];

 		$dist = self::dist($dist);
 		$validate = self::validate($file,$type,$rules); 
 		if ($validate->done) {
 			$copie = self::move($file,$dist,$name);
 			// save in database
 			$media = new Media;
 			$media->url 	= $copie->url;
 			$media->name 	= $copie->name;
 			$media->type 	= $type;
 			if(\Auth::check()){
 				$media->by  = \Auth::user()->id; 
 			} 
 			$media->save();

 			return $media;
 		}

 	}
	
	/*
	*	Directory of upload
	*/
 	public static function dist($folder=""){
 		$default = date('Y/m/d/');
 		$folder = (!empty($folder))? $folder:$default;
 		$folder = 'upload/'.$folder;
 		\File::isDirectory($folder) or \File::makeDirectory($folder,0777,true,true);
 		return $folder;

 	}
	
	/*
	*	Upload file (move file to host)
	*/
 	public static function move($file,$dist,$name=''){
 		$default = time().md5($file->getClientOriginalName());
 		$name = (!empty($name)) ? $name : $default ;
 		$fileName = $name.'.'.$file->getClientOriginalExtension();
 		$file->move($dist,$fileName);

 		$data['name'] = $name;
 		$data['filename'] = $fileName;
 		$data['url'] = $dist.'/'.$fileName;

 		return (object)$data; 

 	}
	
	/*
	*	Validate file
	*/
 	public static function validate($file,$type,$rules){  
 		if (!empty($rules)) {
 			$result = self::validateRules($file,$rules);
 		}else{
 			switch ($type) {
	 			case 'video':
	 				$result = self::validateRules($file,'video|max:2000000');/*2mo*/
	 				break;
	 			
	 			default:/*image*/
	 				$result = self::validateRules($file,'image|mimes:jpg,png,gif|max:2000000');/*2mo*/
	 				break;
	 		}
 		}

 		return $result;

 	} 
	
	/*
	*	Validate file
	*/
 	public static function validateRules($file,$rules){ 
 		$result = [];
 		$valide = true;
 		$rules = (is_array($rules))?$rules:RulesArray($rules); 
 		foreach ($rules as $rule => $value) {
 			/* type rule */
 			if ($value == 'true') { 
 				if(explode('/', $file->getMimeType())[0] != $rule){ 
 					$valide = false; 
 				}
 				$result[$rule] = $valide;
 			}
 			/* size limit */
 			/*
			* 	size by oct
 			*/
 			/** max size **/
 			if ($rule == "max") {
 				if ($file->getClientSize() > $value) {
 					$valide = false; 
 				}
 				$result[$rule] = $valide;
 			}
 			/** min size **/
 			if ($rule == "min") {
 				if (($file->getClientSize() < $value)OR($file->getClientSize() < 0)) {
 					$valide = false; 
 				}
 				$result[$rule] = $valide;
 			}
 			/* extension of file*/
 			if ($rule == "mimes") { 
 				$extensions = (is_array($value))?$value:array($value);
 				if(!in_array($file->getClientOriginalExtension(), $extensions)){ 
 					$valide = false;
 				}
 				$result[$rule] = $valide;
 			}
 		}
 		$result['done'] = $valide;  
 		return (object)$result;

 	} 


 
}