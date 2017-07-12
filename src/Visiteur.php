<?php

namespace Laravision\Visiteur; 

use Laravision\Visiteur\Http\Ip\IpAdress as IpData;
use Laravision\Visiteur\Http\Browser\BrowserDetection as Browser;
use Carbon\Carbon; 
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
 
    protected $table = "visiteur"; 


    /*
	*	Run Visiteur script
    */

    public static function run(){

    	$data = [];

		$data['ip'] 		= \Request::ip();/*196.177.46.8*/
		$data['browser'] 	= \Request::header('User-Agent');
		$data['url'] 		= \Request::url();
		$data['ref'] 		= \Request::header('referer');  
		return self::session((object)$data);
    }

    

    /*
	*	save data visiteur in session
    */

    public static function session($data){ 
    	 
    	$saveNew = true; 
		if (\Session::has('logVisiteur')) {
			if (!isDiff(\Session::get('logVisiteur'),$data)) {
				$saveNew = false;
			}
		} 
		if ($saveNew) { 
			\Session::put('logVisiteur',$data);  
			self::log();
		}

		return \Session::get('logVisiteur');
    }

    

    /*
	*	log new visiteur
    */

    public static function log(){

    	$log = \Session::get('logVisiteur');  

		$visteur 			=  new Visiteur();
		$visteur->ip 		=  IpData::log($log->ip);
		$visteur->browser 	=  $log->browser;
		$visteur->url  		=  json_encode(self::urlPage()); 
		$visteur->ref  		=  $log->ref; 
		$visteur->user  	=  json_encode(self::_user());   
		$visteur->save();

    }

    

    /*
	*	get user data
    */

    public static function _user(){

    	$user = [];  
		if (!\Session::has('os_data')) {
			exec("wmic /node:$_SERVER[REMOTE_ADDR] COMPUTERSYSTEM Get UserName", $os);
			\Session::put('os_data',$os);
		}

		$os 					= \Session::get('os_data'); 
		$user['login'] 			= \Auth::check();
		$user['auth']			= \Auth::user(); 
		$user['pc']['name']		=  gethostname(); 
		$user['pc']['session']	=  (!empty($os[1])&&!empty(explode('\\', $os[1])[1]))?explode('\\', $os[1])[1]:'unknown'; 
		$user['pc']['info']		=  $os; 
		$user['os']				=  php_uname(); 
		
		return (object)$user;

    }

    

    /*
	*	get visiteur activity log
    */

    public static function activity(){

    	return Visiteur::orderBy('id','desc')->get();

    }


    /*
	*	get item visiteur ip data
    */

    public function ip($item=null){

    	$data = IpData::find($this->ip);
    	if (!empty($item)) {
    		if (!empty($data)&&!empty($data->$item)) {
	    		return $data->$item;
	    	}else{
	    		return "unknown";
	    	}
    	}else{
    		return $data;
    	}


    }


    /*
	*	get item visiteur url data
    */

    public function url(){

    	return json_decode($this->url);

    }


    /*
	*	get item visiteur browser data
    */

    public function browser(){

    	return Browser::find($this->browser);

    }


    /*
	*	get item visiteur user data
    */

    public function user(){

    	return json_decode($this->user);

    }


    /*
	*	get item visiteur auth user data
    */

    public function auth(){

    	if ($this->user()->login) { 
    		if ($auth = config('laravision.user')::find($this->user()->auth->id)) {
    			return $auth;
    		}else{
    			return $this->user()->auth;
    		}
    	}

    }
 


 	/*
 	*	Run Visiteur script
 	*/
/*
	public static function run(){
		$data = [];
		$data->ip = \Request::ip();
		$data->ipdata = IpData::find("196.177.46.8");
		$data->browser = Browser::find($_SERVER['HTTP_USER_AGENT']);
		 
		 
		$data['ip'] 		= \Request::ip();
		$data['browser'] 	= \Request::header('User-Agent');
		$data['url'] 		= \Request::url();
		$data['ref'] 		= \Request::header('referer'); 
		return self::session((object)$data);
		 
	} 



 
  

	public static function log(){ 
 
 
		$log = \Session::get('logVisiteur'); 

		$visteur = new Visiteur();
		$visteur->ip 			= json_encode(IpData::find($log->ip));
		$visteur->browser 		= $log->browser;
		$visteur->url  			= json_encode(self::urlPage()); 
		$visteur->ref  			= $log->ref; 
		$visteur->user  		= json_encode(self::user());   
		$visteur->save();
 

	}

 
*/


	/*
	*	Visited page data
	*/

	public static function urlPage(){
		$page = []; 

		$page['url'] 					= \Request::url(); 
		$page['route']['name']			= \Route::currentRouteName();
		$page['route']['middleware']	= \Route::getCurrentRoute()->getAction()['middleware'];
		$page['route']['controller']	= (!empty(explode('@', \Route::getCurrentRoute()->getActionName())[1]))?explode('@', \Route::getCurrentRoute()->getActionName())[0]:"";
		$page['route']['function']		= (!empty(explode('@', \Route::getCurrentRoute()->getActionName())[1]))?explode('@', \Route::getCurrentRoute()->getActionName())[1]:'';
		$page['route']['namespace']		= \Route::getCurrentRoute()->getAction()['namespace'];
		$page['route']['prefix']		= \Route::getCurrentRoute()->getAction()['prefix'];  

		return (object)$page;
	}


	/*
	*	Referer web page data
	*/

	public static function refPage($url=null){
		$url = (!empty($url))?$url:\Request::header('referer');
		$page = []; 

		$page['url'] 	= $url; 
		$page['title']  = (!empty(pageTitle($url)))?pageTitle($url):"unknown"; 
		$page['domain']	= (object)parse_url($url);
		
		return (object)$page;
	} 
 
 
}