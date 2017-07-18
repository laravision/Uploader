<?php

namespace Laravision\Uploader\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravision\Uploader\Uploader;
use Illuminate\Http\Request;

class AppController extends Controller 
{

	public function index(){  
		return view('Laravision-uploader::dashboard');
	}

	public function picture(){  
		return view('Laravision-uploader::upload.picture');
	}

	public function storePicture(Request $img){   

		$uploader = Uploader::run($img->file('picture')); 
		
		return redirect()->back();
	}
}