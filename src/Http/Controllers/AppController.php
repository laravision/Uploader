<?php

namespace Laravision\Visiteur\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravision\Visiteur\Visiteur;
use Illuminate\Http\Request;

class AppController extends Controller 
{

	public function index(Request $req){  
		$data = Visiteur::all();  
		return view('Laravision-visiteur::dashboard',compact('data'));
	}
}